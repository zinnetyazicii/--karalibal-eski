<?php

namespace Journal3\Opencart;

use Journal3\Options\Parser;
use Journal3\Options\Range;
use Journal3\Utils\Arr;

abstract class ModuleController extends Controller {

	protected $item_id;
	protected $subitem_id;
	protected $module_id;
	protected $module_type;
	protected $module_data;
	protected $module_args;
	protected $settings;
	protected $css;
	protected $fonts = array();

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/image');
		$this->load->model('journal3/links');
		$this->load->model('journal3/module');
	}

	public function index($args) {
		$this->module_id = (int)Arr::get($args, 'module_id');
		$this->module_type = Arr::get($args, 'module_type');
		$this->module_args = Arr::get($args, 'module_args');
		$this->_cache_key = $this->module_type . '.' . $this->module_id;

		if ($this->_cache === false) {
			$this->module_data = $this->model_journal3_module->get($this->module_id, $this->module_type);

			if (!$this->module_data) {
				return null;
			}

			$parser = new Parser('module/' . $this->module_type . '/general', Arr::get($this->module_data, 'general'), null, array($this->module_id));

			$this->css = $parser->getCss();
			$this->fonts = $parser->getFonts();

			$this->settings = array_merge_recursive(
				$parser->getPhp(),
				array(
					'status'    => $parser->getSetting('status'),
					'id'        => uniqid($this->module_type . '-'),
					'module_id' => $this->module_id,
					'classes'   => array('module', 'module-' . $this->module_type, 'module-' . $this->module_type . '-' . $this->module_id),
				),
				$this->parseGeneralSettings($parser, $this->module_id)
			);

			if ($parser->getSetting('status') !== false && Arr::get($this->settings, 'items') === null) {
				$this->settings['items'] = array();

				$items = Arr::get($this->module_data, 'items', array());

				foreach ($items as $item) {
					$this->item_id++;

					$parser = new Parser('module/' . $this->module_type . '/item', $item, null, array($this->module_id, $this->item_id));

					if ($parser->getSetting('status') === false) {
						continue;
					}

					$item_settings = $this->parseItemSettings($parser, $this->item_id);

					if ($item_settings === null) {
						continue;
					}

					$this->css .= $parser->getCss();
					$fonts = $parser->getFonts();
					$this->fonts = Arr::merge($this->fonts, $fonts);

					$this->settings['items'][$this->item_id] = array_merge_recursive(
						$parser->getPhp(),
						array(
							'id'      => $this->module_id . '-' . $this->item_id,
							'classes' => array('module-item', 'module-item-' . $this->item_id),
						),
						$item_settings
					);

					if (Arr::get($this->settings['items'][$this->item_id], 'items') === null) {
						$this->settings['items'][$this->item_id]['items'] = array();

						$subitems = Arr::get($item, 'items', array());

						$this->subitem_id = 0;

						foreach ($subitems as $subitem) {
							$this->subitem_id++;

							$parser = new Parser('module/' . $this->module_type . '/subitem', $subitem, null, array($this->module_id, $this->item_id, $this->subitem_id));

							if ($parser->getSetting('status') === false) {
								continue;
							}

							$subitem_settings = $this->parseSubitemSettings($parser, $this->item_id);

							if ($subitem_settings === null) {
								continue;
							}

							$this->css .= $parser->getCss();
							$fonts = $parser->getFonts();
							$this->fonts = Arr::merge($this->fonts, $fonts);

							$this->settings['items'][$this->item_id]['items'][$this->subitem_id] = array_merge_recursive(
								$parser->getPhp(),
								array(
									'id'      => $this->module_id . '-' . $this->item_id . '-' . $this->subitem_id,
									'classes' => array('module-subitem', 'module-subitem-' . $this->subitem_id),
								),
								$subitem_settings
							);
						}
					}
				}
			}

			$this->_cache = array(
				'css'         => $this->css,
				'fonts'       => $this->fonts,
				'settings'    => $this->settings,
			);
		} else {
			$this->css = $this->_cache['css'];
			$this->fonts = $this->_cache['fonts'];
			$this->settings = $this->_cache['settings'];
		}

		if ($this->settings['status'] === false) {
			return null;
		}

		if (!Range::inRange(Arr::get($this->settings, 'schedule'))) {
			return null;
		}

		$this->beforeRender();

		if ($this->settings === null) {
			return null;
		}

		$output = $this->renderView('journal3/module/' . $this->module_type, $this->settings);

		if (!$output) {
			return null;
		}

		$this->afterRender();

		if ($this->css) {
			$this->journal3->document->addCss($this->css, "{$this->module_type}-{$this->module_id}");
		}

		if ($this->fonts) {
			$this->journal3->document->addFonts($this->fonts);
		}

		return $output;
	}

	/**
	 * @param Parser $parser
	 * @param $module_id
	 * @return array
	 */
	protected abstract function parseGeneralSettings($parser, $module_id);

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected abstract function parseItemSettings($parser, $index);

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected abstract function parseSubitemSettings($parser, $index);


	/**
	 * Called before view is rendered
	 */
	protected function beforeRender() {
	}

	/**
	 * Called after view is rendered,
	 */
	protected function afterRender() {
	}

}

