<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3ProductTabs extends ModuleController {

	private static $PRODUCT_INFO;

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/filter');
	}

	public function index($args) {
		$this->module_id = (int)Arr::get($args, 'module_id');
		$this->module_type = Arr::get($args, 'module_type');

		$this->_cache_key = $this->module_type . '.' . $this->module_id;

		if ($this->_cache === false) {
			$this->module_data = $this->model_journal3_module->get($this->module_id, $this->module_type);

			if (!$this->module_data) {
				return null;
			}

			$parser = new Parser('module/' . $this->module_type . '/general', Arr::get($this->module_data, 'general'), null, array($this->module_id));

			$this->css = $parser->getCss();

			$this->settings = array_merge_recursive(
				$parser->getPhp(),
				array(
					'status' => $parser->getSetting('status'),
					'id'     => uniqid($this->module_type . '-'),
				),
				$this->parseGeneralSettings($parser, $this->module_id)
			);
		}

		if ($this->settings['status'] === false) {
			return null;
		}

		if (Arr::get($this->settings, 'scheduledStatus') === false) {
			return null;
		}

		// dynamic
		if (Arr::get($this->settings, 'contentType') === 'dynamic' && Arr::get($this->settings, 'dynamic')) {
			$this->settings['content'] = $this->load->controller(Arr::get($this->settings, 'dynamic'), array(
				'module_id' => $this->module_id,
				'settings'  => $this->settings,
			));
		}

		if ($this->css) {
			$this->journal3->document->addCss($this->css);
		}

		return $this->settings;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		$data = array(
			'tab_classes'   => array(),
			'panel_classes' => array(
				'panel-collapse',
				'collapse',
			),
			'classes'       => array(
				'product_extra-' . $this->module_id,
				'tab-pane' => $parser->getSetting('display') === 'tabs',
				'panel'    => $parser->getSetting('display') === 'accordion',
			),
		);

		switch ($parser->getSetting('contentType')) {
			case 'description':
			case 'short_description':
			case 'attributes':
			case 'reviews':
				$data['content'] = $this->productContent($parser->getSetting('contentType'), $parser->getSetting('shortDescriptionLimit'));
				break;

			default:
				if ($parser->getSetting('tabType') === 'link') {
					$data['content'] = true;
				} else {
					$data['content'] = $parser->getSetting('content');
				}
		}

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		return array();
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		return array();
	}

	private function productContent($type, $short_description_limit) {
		if (static::$PRODUCT_INFO === null) {
			$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);

			// desc
			static::$PRODUCT_INFO['description'] = html_entity_decode(Arr::get($product_info, 'description'), ENT_QUOTES, 'UTF-8');

			if (!trim(strip_tags(static::$PRODUCT_INFO['description'], '<img><iframe>'))) {
				static::$PRODUCT_INFO['description'] = '';
			}

			static::$PRODUCT_INFO['short_description'] = utf8_substr(strip_tags(html_entity_decode(static::$PRODUCT_INFO['description'], ENT_QUOTES, 'UTF-8')), 0, (int)$short_description_limit) . '..';

			// attrs
			$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
			static::$PRODUCT_INFO['attributes'] = $this->renderView('journal3/module/product_blocks_attributes', $data);

			// reviews
			$this->load->language('product/product');

			$data['text_write'] = $this->language->get('text_write');
			$data['entry_name'] = $this->language->get('entry_name');
			$data['entry_review'] = $this->language->get('entry_review');
			$data['text_note'] = $this->language->get('text_note');
			$data['entry_rating'] = $this->language->get('entry_rating');
			$data['entry_bad'] = $this->language->get('entry_bad');
			$data['entry_good'] = $this->language->get('entry_good');
			$data['text_loading'] = $this->language->get('text_loading');
			$data['button_continue'] = $this->language->get('button_continue');

			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', true), $this->url->link('account/register', '', true));
			$data['tab_review'] = sprintf($this->language->get('tab_review'), Arr::get($product_info, 'reviews'));

			$data['review_status'] = $this->config->get('config_review_status');

			if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
				$data['review_guest'] = true;
			} else {
				$data['review_guest'] = false;
			}

			if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}

			$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)Arr::get($product_info, 'reviews'));
			$data['rating'] = (int)$product_info['rating'];

			// Captcha
			if ($this->journal3->isOC2()) {
				if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
					$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
				} else {
					$data['captcha'] = '';
				}
			} else {
				if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('review', (array)$this->config->get('config_captcha_page'))) {
					$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
				} else {
					$data['captcha'] = '';
				}
			}

			static::$PRODUCT_INFO['reviews'] = $this->renderView('journal3/module/product_blocks_reviews', $data);
		}

		return static::$PRODUCT_INFO[$type];
	}

	public function tabs($data) {
		$data['items'] = array_filter(Arr::get($data, 'items'), function ($item) {
			return (bool)trim($item['content']);
		});

		if (!$data['items']) {
			return null;
		}

		$sort_order = array();

		foreach ($data['items'] as $key => $value) {
			$sort_order[$key] = $value['sort'];
		}

		array_multisort($sort_order, SORT_ASC, $data['items']);

		$data['display'] = $data['items']['0']['display'];

		$data['classes'] = array(
			'product_extra',
			'product_' . $data['display'],
			'product_' . $data['display'] . '-' . $data['position'],
		);

		switch ($data['display']) {
			case 'tabs':
				$data['items']['0']['tab_classes'][] = 'active';
				$data['items']['0']['classes'][] = 'active';

				break;

			case 'accordion':
				$data['items']['0']['panel_classes'][] = 'in';
				$data['items']['0']['classes'][] = 'panel-active';
				break;
		}

		return $this->renderView('journal3/module/product_tabs', $data);
	}

}
