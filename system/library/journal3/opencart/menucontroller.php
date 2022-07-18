<?php

namespace Journal3\Opencart;

use Journal3\Options\Parser;
use Journal3\Utils\Arr;

abstract class MenuController extends Controller {

	protected $item_id;
	protected $module_id;
	protected $module_type;
	protected $module_data;
	protected $settings;
	protected $css;
	protected $fonts = array();

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/image');
		$this->load->model('journal3/module');
		$this->load->model('journal3/links');
		$this->load->model('journal3/category');
	}

	public function index($args) {
		$this->module_id = (int)Arr::get($args, 'module_id');
		$this->module_type = Arr::get($args, 'module_type');
		$this->item_id = 1;

		$this->_cache_key = $this->module_type . '.' . $this->module_id;

		if ($this->_cache === false) {
			$this->module_data = $this->model_journal3_module->get($this->module_id, $this->module_type);

			if (!$this->module_data) {
				return null;
			}

			$parser = new Parser('module/' . $this->module_type . '/general', Arr::get($this->module_data, 'general'), null, array($this->module_id));

			$this->css = $parser->getCss();
			$this->fonts = $parser->getFonts();

			$module_type = str_replace('_', '-', $this->module_type);

			$this->settings = array_merge_recursive(
				$parser->getPhp(),
				array(
					'status'    => $parser->getSetting('status'),
					'id'        => Arr::get($args, 'id', uniqid($module_type . '-')),
					'module_id' => $this->module_id,
					'classes'   => array(
						$module_type,
						$module_type . '-' . $this->module_id,
					),
				),
				$this->parseGeneralSettings($parser, $this->module_id)
			);

			if ($parser->getSetting('status') !== false && Arr::get($this->settings, 'items') === null) {
				$this->settings['items'] = array();

				$items = Arr::get($this->module_data, 'items', array());

				foreach ($items as $item_index => $item) {
					$item_id = $this->item_id++;

					$parser = new Parser('module/' . $this->module_type . '/item', $item, null, array($this->module_id, $item_id));

					if ($parser->getSetting('status') === false) {
						continue;
					}

					$this->css .= $parser->getCss();
					$fonts = $parser->getFonts();
					$this->fonts = Arr::merge($this->fonts, $fonts);

					switch ($parser->getSetting('type')) {
						case 'megamenu':
							$item_data = array(
								'classes'      => array(
									'dropdown',
									'mega-menu',
								),
								'grid_classes' => array(
									'grid-rows',
								),
								'rows'         => $this->generateMegaMenu($item, $item_id),
							);

							break;

						case 'flyout':
							$item_data['items'] = $parser->getSetting('flyout');

							$item_data['classes'] = array(
								'dropdown',
								'flyout',
							);

							break;

						default:
							$item_data = $this->generateMultiLevelMenu($item, $parser);

							$item_data['classes'] = array(
								'multi-level' => ($this->module_type === 'main_menu') || ($this->module_type === 'flyout_menu'),
								'dropdown'    => (bool)$item_data['items'],
								'drop-menu'   => (bool)$item_data['items'] && ($this->module_type === 'top_menu'),
							);

							if (($this->module_type === 'main_menu') || ($this->module_type === 'flyout_menu')) {
								// none in main menu and flyout menu ignores possible subitems
								if ($parser->getSetting('type') === '') {
									$item_data['items'] = array();
								}
							}
					}

					$this->settings['items'][$item_id] = array_merge_recursive(
						$parser->getPhp(),
						array(
							'classes' => array(
								'menu-item',
								$module_type . '-item',
								$module_type . '-item-' . $item_id,
							),
						),
						$item_data,
						$this->parseItemSettings($parser, $item_id)
					);
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

		if (Arr::get($this->settings, 'scheduledStatus') === false) {
			return null;
		}

		if (isset($this->settings['items']) && in_array($this->module_type, array('main_menu', 'flyout_menu'))) {
			foreach ($this->settings['items'] as &$setting) {
				switch (Arr::get($setting, 'type')) {
					case 'megamenu':
						$setting['items'] = $this->renderGrid($setting);
						break;

					case 'flyout':
						$setting['items'] = $this->load->controller('journal3/flyout_menu', array(
							'module_id'   => $setting['items'],
							'module_type' => 'flyout_menu',
						));
						break;
				}
			}
		}

		$this->beforeRender();

		if ($this->settings === null) {
			return null;
		}

		$output = $this->renderView('journal3/module/' . ($this->module_type === 'flyout_menu' ? 'main_menu' : $this->module_type), $this->settings);

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
	 * @param array $item
	 * @param number $item_id
	 * @return array
	 */
	protected final function generateMegaMenu($item, $item_id) {
		$rows = array();
		$row_id = 0;

		foreach (Arr::get($item, 'rows', array()) as $row) {
			$row_id++;

			$parser = new Parser('module/' . $this->module_type . '/row', Arr::get($row, 'options'), null, array($this->module_id, $item_id, $row_id));

			if ($parser->getSetting('status') === false) {
				continue;
			}

			$this->css .= $parser->getCss();
			$fonts = $parser->getFonts();
			$this->fonts = Arr::merge($this->fonts, $fonts);

			$rows[$row_id] = array_merge_recursive(
				$parser->getPhp(),
				array(
					'classes' => array(
						'grid-row',
						'grid-row-' . $row_id,
					),
					'columns' => array(),
				)
			);

			$column_id = 0;

			foreach (Arr::get($row, 'columns', array()) as $column) {
				$column_id++;

				$parser = new Parser('module/' . $this->module_type . '/column', Arr::get($column, 'options'), null, array($this->module_id, $item_id, $row_id, $column_id));

				if ($parser->getSetting('status') === false) {
					continue;
				}

				$this->css .= $parser->getCss();
				$fonts = $parser->getFonts();
				$this->fonts = Arr::merge($this->fonts, $fonts);

				$rows[$row_id]['columns'][$column_id] = array_merge_recursive(
					$parser->getPhp(),
					array(
						'classes' => array(
							'grid-col',
							'grid-col-' . $column_id,
						),
						'items'   => array(),
					)
				);

				$module_id = 0;

				foreach (Arr::get($column, 'items', array()) as $module) {
					$module_id++;

					$rows[$row_id]['columns'][$column_id]['items'][$module_id] = array(
						'classes' => array(
							'grid-item',
							'grid-item-' . $module_id,
						),
						'item'    => Arr::get($module, 'item'),
					);
				}
			}

		}

		return $rows;
	}

	/**
	 * @param array $item
	 * @param Parser $parser
	 * @return array
	 */
	protected final function generateMultiLevelMenu($item, $parser) {
		$module_type = str_replace('_', '-', $this->module_type);

		$items = array();

		$link = $this->model_journal3_links->link($parser->getSetting('link'));

		if ($link['type'] === 'category' && $parser->getSetting('subcategories')) {
			$categories = $this->model_journal3_category->getSubcategories($link['id']);

			$items = Arr::get($categories, 'items', array());

			$link['total'] = Arr::get($categories, 'link.total');
		} else {
			$subitems = Arr::get($item, 'items', array());

			foreach ($subitems as $subitem) {
				$subitem_id = $this->item_id++;

				$parser = new Parser('module/' . $this->module_type . '/subitem', $subitem, null, array($this->module_id, $subitem_id));

				if ($parser->getSetting('status') === false) {
					continue;
				}

				$this->css .= $parser->getCss();
				$fonts = $parser->getFonts();
				$this->fonts = Arr::merge($this->fonts, $fonts);

				$item_data = $this->generateMultiLevelMenu($subitem, $parser);

				$items[$subitem_id] = array_merge_recursive(
					$parser->getPhp(),
					array(
						'classes' => array(
							'menu-item',
							$module_type . '-item-' . $subitem_id,
							'dropdown' => (bool)$item_data['items'],
						),
					),
					$item_data,
					$this->parseSubitemSettings($parser, $subitem_id)
				);
			}
		}

		return array(
			'items' => $items,
		);
	}

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

