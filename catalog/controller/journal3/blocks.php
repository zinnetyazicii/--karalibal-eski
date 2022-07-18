<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3Blocks extends ModuleController {

	private static $PRODUCT_INFO;
	private static $CATEGORY_INFO;

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/links');
	}

	public function index($args) {
		$data = parent::index($args);

		if (!$data) {
			return null;
		}

		if ($this->settings['carousel']) {
			$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/swiper/swiper.min.css');
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/swiper/swiper.min.js', 'footer');
		}

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		$default = $parser->getSetting('default');

		$data = array(
			'classes'         => array(
				'blocks-' . $parser->getSetting('display'),
				'carousel-mode' => $parser->getSetting('carousel'),
			),
			'carouselOptions' => $this->journal3->carousel($parser->getJs(), 'carouselStyle'),
		);

		if ($this->journal3->settings->get('performanceLazyLoadImagesStatus') && $parser->getSetting('lazyLoad')) {
			$data['dummy_image'] = $this->model_journal3_image->transparent($parser->getSetting('imageDimensions.width'), $parser->getSetting('imageDimensions.height'));
		}

		$data['default_index'] = $parser->getSetting('display') === 'tabs' ? 1 : 0;

		if ($default) {
			foreach (Arr::get($this->module_data, 'items') as $index => $item) {
				if ($default === Arr::get($item, 'id')) {
					$data['default_index'] = $index + 1;
					break;
				}
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
		$title = $parser->getSetting('title');

		switch ($parser->getSetting('contentType')) {
			case 'description':
			case 'attributes':
			case 'reviews':
			case 'dynamic':
				$content = '';
				break;

			default:
				$content = $parser->getSetting('content');
		}

		return array(
			'tab_classes'   => array(
				'tab-' . $this->item_id,
				'active' => ($this->settings['display'] === 'tabs') && ($index === $this->settings['default_index']),
			),
			'panel_classes' => array(
				'panel-collapse',
				'collapse',
				'in' => ($this->settings['display'] === 'accordion') && ($index === $this->settings['default_index']),
			),
			'classes'       => array(
				'tab-pane'     => $this->settings['display'] === 'tabs',
				'active'       => ($this->settings['display'] === 'tabs') && ($index === $this->settings['default_index']),
				'panel'        => $this->settings['display'] === 'accordion',
				'panel-active' => ($this->settings['display'] === 'accordion') && ($index === $this->settings['default_index']),
				'swiper-slide' => ($this->settings['display'] === 'grid') && $this->settings['carousel'],
			),
			'image'         => $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']),
			'image2x'       => $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['imageDimensions']['width'] * 2, $this->settings['imageDimensions']['height'] * 2, $this->settings['imageDimensions']['resize']),
			'title'         => $title,
			'content'       => $content,
		);
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		return array();
	}

	protected function beforeRender() {
		foreach ($this->settings['items'] as $key => &$item) {
			// product tabs
			if (isset($this->request->get['product_id'])) {
				if (in_array($item['contentType'], array('image', 'description', 'short_description', 'attributes', 'reviews'))) {
					$item['content'] = $this->productContent($item['contentType'], $item['shortDescriptionLimit']);
				}
			} else if (isset($this->request->get['path'])) {
				if (in_array($item['contentType'], array('image', 'description', 'short_description'))) {
					$item['content'] = $this->categoryContent($item['contentType'], $item['shortDescriptionLimit']);
				}
			}

			// dynamic
			if ($item['contentType'] === 'dynamic' && $item['dynamic']) {
				$item['content'] = $this->load->controller($item['dynamic'], array(
					'module_id' => $this->module_id,
					'item'      => $item,
					'settings'  => $this->settings,
				));
			}

			$limit = (int)$this->journal3->settings->get('globalExpandCharactersLimit');

			if ($limit > 0 && (utf8_strlen(strip_tags($item['content'])) <= $limit)) {
				$item['classes'][] = 'no-expand';
			}

			if (!$item['content']) {
				// force update default_index before render if current item is default
				if ($key === $this->settings['default_index']) {
					$this->settings['default_index'] = -1;
				}

				unset($this->settings['items'][$key]);

				continue;
			}
		}

		if (!$this->settings['items']) {
			$this->settings = null;

			return;
		}

		if ($this->settings['display'] === 'tabs') {
			if ($this->settings['default_index'] === -1) {
				reset($this->settings['items']);
				$key = key($this->settings['items']);

				$this->settings['items'][$key]['tab_classes'][] = 'active';
				$this->settings['items'][$key]['classes'][] = 'active';
			}
		}

		if ($this->settings['display'] === 'accordion') {
			if ($this->settings['default_index'] === -1) {
				reset($this->settings['items']);
				$key = key($this->settings['items']);

				$this->settings['items'][$key]['panel_classes'][] = 'in';
				$this->settings['items'][$key]['classes'][] = 'active';
			}
		}
	}

	private function productContent($type, $short_description_limit) {
		if (static::$PRODUCT_INFO === null) {
			$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);

			// image
			if (Arr::get($product_info, 'image')) {
				$width = $this->journal3->settings->get('image_dimensions_thumb.width');
				$height = $this->journal3->settings->get('image_dimensions_thumb.height');

				$image = $this->model_journal3_image->resize($product_info['image'], $width, $height, $this->journal3->settings->get('image_dimensions_thumb.resize'));
				$image2x = $this->model_journal3_image->resize($product_info['image'], $width * 2, $height * 2, $this->journal3->settings->get('image_dimensions_thumb.resize'));

				static::$PRODUCT_INFO['image'] = '<img src="' . $image . '" srcset="' . $image . ' 1x, ' . $image2x . ' 2x" width="' . $width . '" height="' . $height . '" />';

			} else {
				static::$PRODUCT_INFO['image'] = '';
			}

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

	private function categoryContent($type, $short_description_limit) {
		if (static::$CATEGORY_INFO === null) {
			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			$category_info = $this->model_catalog_category->getCategory($category_id);

			// image
			if (Arr::get($category_info, 'image')) {
				$width = $this->journal3->settings->get('image_dimensions_category.width');
				$height = $this->journal3->settings->get('image_dimensions_category.height');

				$image = $this->model_journal3_image->resize($category_info['image'], $width, $height, $this->journal3->settings->get('image_dimensions_category.resize'));
				$image2x = $this->model_journal3_image->resize($category_info['image'], $width * 2, $height * 2, $this->journal3->settings->get('image_dimensions_category.resize'));

				static::$CATEGORY_INFO['image'] = '<img src="' . $image . '" srcset="' . $image . ' 1x, ' . $image2x . ' 2x" width="' . $width . '" height="' . $height . '" />';

			} else {
				static::$CATEGORY_INFO['image'] = '';
			}

			// desc
			static::$CATEGORY_INFO['description'] = html_entity_decode(Arr::get($category_info, 'description'), ENT_QUOTES, 'UTF-8');

			if (!trim(strip_tags(static::$CATEGORY_INFO['description'], '<img><iframe>'))) {
				static::$CATEGORY_INFO['description'] = '';
			}

			static::$CATEGORY_INFO['short_description'] = utf8_substr(strip_tags(html_entity_decode(static::$CATEGORY_INFO['description'], ENT_QUOTES, 'UTF-8')), 0, (int)$short_description_limit) . '..';
		}

		return static::$CATEGORY_INFO[$type];
	}

}
