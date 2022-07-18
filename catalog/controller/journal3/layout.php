<?php

use Journal3\Opencart\Controller;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3Layout extends Controller {

	private static $MODULES = array(
		'popup',
		'notification',
		'header_notice',
		'bottom_menu',
		'side_menu',
		'fullscreen_slider',
		'background_slider',
	);

	private static $POSITIONS = array(
		'column_left',
		'column_right',
		'content_top',
		'content_bottom',
		'top',
		'bottom',
		'header_top',
		'footer_top',
		'footer_bottom',
	);

	private static $layout;

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/layout');
		$this->load->model('journal3/module');
	}

	public function index($position) {
		if ($this->config->get('config_maintenance') && !$this->journal3->isAdmin()) {
			return null;
		}

		if (static::$layout === null) {
			$layout_id = $this->model_journal3_layout->getCurrentLayoutId();

			$this->journal3->document->addClass('layout-' . $layout_id);

			$this->journal3->document->setLayoutId($layout_id);

			if ($this->journal3->document->isPopup()) {
				self::$layout = false;

				return null;
			}

			$this->_cache_key = 'layout.' . $layout_id;

			if ($this->_cache === false) {
				$layout_data = $this->model_journal3_layout->get($layout_id);

				$layout_positions = Arr::get($layout_data, 'enabledPositions', array());

				$cache = array(
					'settings' => array(),
					'php'      => array(),
					'js'       => array(),
					'fonts'    => array(),
					'css'      => '',
				);

				$parser = new Parser('layout/general', Arr::get($layout_data, 'general'), null, array($layout_id));

				$cache['php'] += $parser->getPhp();
				$cache['css'] .= $parser->getCss();

				foreach (static::$POSITIONS as $POSITION) {
					$data = array(
						'rows'         => array(),
						'grid_classes' => array('grid-rows'),
					);

					$cache['settings'][$POSITION] = $data;

					if (!in_array($POSITION, $layout_positions)) {
						continue;
					}

					$prefix = str_replace('_', '-', $POSITION);

					$row_id = 0;

					foreach (Arr::get($layout_data, 'positions.' . $POSITION . '.rows', array()) as $row) {
						$row_id++;

						$parser = new Parser('layout/row', Arr::get($row, 'options'), null, Arr::trim(array($prefix, $row_id)));

						if ($parser->getSetting('status') === false) {
							continue;
						}

						$cache['css'] .= $parser->getCss();
						$fonts = $parser->getFonts();
						$cache['fonts'] = Arr::merge($cache['fonts'], $fonts);

						$data['rows'][$row_id] = array_merge_recursive(
							$parser->getPhp(),
							array(
								'classes' => array('grid-row', 'grid-row-' . $prefix . '-' . $row_id),
								'columns' => array(),
							)
						);

						$column_id = 0;

						foreach (Arr::get($row, 'columns', array()) as $column) {
							$column_id++;

							$parser = new Parser('layout/column', Arr::get($column, 'options'), null, Arr::trim(array($prefix, $row_id, $column_id)));

							if ($parser->getSetting('status') === false) {
								continue;
							}

							$cache['css'] .= $parser->getCss();
							$fonts = $parser->getFonts();
							$cache['fonts'] = Arr::merge($cache['fonts'], $fonts);

							$data['rows'][$row_id]['columns'][$column_id] = array_merge_recursive(
								$parser->getPhp(),
								array(
									'classes' => array('grid-col', 'grid-col-' . $prefix . '-' . $row_id . '-' . $column_id),
									'items'   => array(),
								)
							);

							$module_id = 0;

							foreach (Arr::get($column, 'items', array()) as $module) {
								// disable columns on mobile but allow filter module
								if ($this->journal3->document->isTablet()) {
									if ($POSITION === 'column_left' && !$this->journal3->settings->get('globalPageColumnLeftTabletStatus')) {
										if (Arr::get($module, 'item.type') !== 'filter') {
											continue;
										}
									}

									if ($POSITION === 'column_right' && !$this->journal3->settings->get('globalPageColumnRightTabletStatus')) {
										if (Arr::get($module, 'item.type') !== 'filter') {
											continue;
										}
									}
								}

								if ($this->journal3->document->isPhone() && ($POSITION === 'column_left' || $position === 'column_right')) {
									if (Arr::get($module, 'item.type') !== 'filter') {
										continue;
									}
								}

								$module_id++;

								$parser = new Parser('layout/module', Arr::get($module, 'options'), null, Arr::trim(array($prefix, $row_id, $column_id, $module_id)));

								$cache['css'] .= $parser->getCss();
								$fonts = $parser->getFonts();
								$cache['fonts'] = Arr::merge($cache['fonts'], $fonts);

								$data['rows'][$row_id]['columns'][$column_id]['items'][$module_id] = array_merge_recursive(
									$parser->getPhp(),
									array(
										'classes' => array('grid-item', 'grid-item-' . $prefix . '-' . $row_id . '-' . $column_id . '-' . $module_id),
										'item'    => Arr::get($module, 'item'),
									)
								);
							}
						}

					}

					$cache['settings'][$POSITION] = $data;
				}

				foreach (static::$MODULES as $MODULE) {
					if (Arr::get($layout_data, 'positions.absolute.' . $MODULE)) {
						$module_id = Arr::get($layout_data, 'positions.absolute.' . $MODULE);

						if ($module_id) {
							$cache['settings']['absolute'][] = array(
								'module_id'   => $module_id,
								'module_type' => $MODULE,
							);
						}
					} else {
						$module_id = Arr::get($layout_data, 'positions.global.' . $MODULE);

						if ($module_id) {
							$cache['settings']['global'][] = array(
								'module_id'   => $module_id,
								'module_type' => $MODULE,
							);
						}
					}
				}

				$this->_cache = $cache;
			}

			switch (Arr::get($this->_cache['php'], 'pageStyleBoxedLayout')) {
				case 'boxed':
					$this->journal3->document->addClass('boxed-layout');
					break;

				case 'fullwidth':
					$this->journal3->document->removeClass('boxed-layout');
					break;
			}

			$this->journal3->document->addCss($this->_cache['css']);
			$this->journal3->document->addFonts($this->_cache['fonts']);

			foreach (static::$POSITIONS as $POSITION) {
				$data = $this->_cache['settings'][$POSITION];

				$grid = $this->renderGrid($data, !in_array($POSITION, array()));

				$data['modules'] = array();

				if ($grid) {
					$data['modules'][] = $grid;
				}

//				$modules = $this->model_design_layout->getLayoutModules($layout_id, $POSITION);
//
//				$this->load->model('setting/module');
//
//				foreach ($modules as $module) {
//					$part = explode('.', $module['code']);
//
//					if (isset($part[0]) && $this->config->get('module_' . $part[0] . '_status')) {
//						$module_data = $this->load->controller('extension/module/' . $part[0]);
//
//						if ($module_data) {
//							$data['modules'][] = $module_data;
//						}
//					}
//
//					if (isset($part[1])) {
//						$setting_info = $this->model_setting_module->getModule($part[1]);
//
//						if ($setting_info && $setting_info['status']) {
//							$output = $this->load->controller('extension/module/' . $part[0], $setting_info);
//
//							if ($output) {
//								$data['modules'][] = $output;
//							}
//						}
//					}
//				}

				if ($data['modules']) {
					self::$layout[$POSITION] = $this->renderView('common/' . $POSITION, $data);
				} else {
					self::$layout[$POSITION] = null;
				}
			}

			foreach (Arr::get($this->_cache['settings'], 'global', array()) as $module) {
				$result = $this->load->controller('journal3/' . $module['module_type'], $module);

				if ($result) {
					self::$layout[$module['module_type']] = $result;
				}
			}

			foreach (Arr::get($this->_cache['settings'], 'absolute', array()) as $module) {
				$result = $this->load->controller('journal3/' . $module['module_type'], $module);

				if ($result) {
					self::$layout[$module['module_type']] = $result;
				}
			}

			if (self::$layout['column_left'] && self::$layout['column_right']) {
				$this->journal3->document->addClass('two-column');
				$this->journal3->document->addJs(array('columnsCount' => 2));
				$this->journal3->settings->set('columnsCount', 2);
			} else if (self::$layout['column_left'] || self::$layout['column_right']) {
				$this->journal3->document->addClass('one-column');
				$this->journal3->document->addJs(array('columnsCount' => 1));
			} else {
				$this->journal3->document->addJs(array('columnsCount' => 0));
			}

			if (self::$layout['column_left'] && self::$layout['column_right']) {
				$this->journal3->document->addClass('column-left column-right');
			} else if (self::$layout['column_left']) {
				$this->journal3->document->addClass('column-left');
			} else if (self::$layout['column_right']) {
				$this->journal3->document->addClass('column-right');
			}

		}

		return Arr::get(self::$layout, $position);
	}

	public function header() {
		$desktop_module_id = null;
		$desktop_module_type = null;

		if ($data = $this->journal3->settings->get('headerDesktop')) {
			list ($desktop_module_id, $desktop_module_type) = explode('/', $data);
		}

		if ($data = Arr::get($this->model_journal3_layout->get($this->model_journal3_layout->getCurrentLayoutId()), 'headerDesktop')) {
			list ($desktop_module_id, $desktop_module_type) = explode('/', $data);
		}

		$mobile_module_id = null;
		$mobile_module_type = null;

		if ($data = $this->journal3->settings->get('headerMobile')) {
			list ($mobile_module_id, $mobile_module_type) = explode('/', $data);
		}

		if ($data = Arr::get($this->model_journal3_layout->get($this->model_journal3_layout->getCurrentLayoutId()), 'headerMobile')) {
			list ($mobile_module_id, $mobile_module_type) = explode('/', $data);
		}

		$this->_cache_key = 'header.' . $desktop_module_id . '.' . $mobile_module_id;

		if ($this->_cache === false) {
			$cache = array(
				'php'   => array(),
				'js'    => array(),
				'fonts' => array(),
				'css'   => '',
			);

			if ($desktop_module_id && $desktop_module_type) {
				$settings = $this->model_journal3_module->get($desktop_module_id, $desktop_module_type);

				if ($settings) {
					$files = glob(DIR_SYSTEM . 'library/journal3/data/settings/module/header_desktop/{*,*/*}.json', GLOB_BRACE);

					foreach ($files as &$file) {
						$file = str_replace(DIR_SYSTEM . 'library/journal3/data/settings/', '', $file);
						$file = str_replace('.json', '', $file);
					}

					$parser = new Parser($files, $settings['general']);

					$cache['php']['headerType'] = str_replace('header_desktop_', '', $desktop_module_type);
					$cache['php'] += $parser->getPhp();
					$cache['js'] += $parser->getJs();
					$cache['js']['headerType'] = $cache['php']['headerType'];
					$fonts = $parser->getFonts();
					$cache['fonts'] = Arr::merge($cache['fonts'], $fonts);
					$cache['css'] .= $parser->getCss();
				}

			}

			if ($mobile_module_id && $mobile_module_type) {
				$settings = $this->model_journal3_module->get($mobile_module_id, $mobile_module_type);

				if ($settings) {
					$files = glob(DIR_SYSTEM . 'library/journal3/data/settings/module/header_mobile/{*,*/*}.json', GLOB_BRACE);

					foreach ($files as &$file) {
						$file = str_replace(DIR_SYSTEM . 'library/journal3/data/settings/', '', $file);
						$file = str_replace('.json', '', $file);
					}

					$parser = new Parser($files, $settings['general']);

					$cache['php']['mobileHeaderType'] = str_replace('header_mobile_', '', $mobile_module_type);
					$cache['php'] += $parser->getPhp();
					$cache['js'] += $parser->getJs();
					$fonts = $parser->getFonts();
					$cache['fonts'] = Arr::merge($cache['fonts'], $fonts);
					$cache['css'] .= $parser->getCss();
				}
			}

			$this->_cache = $cache;
		}

		$this->journal3->settings->load($this->_cache['php']);
		$this->journal3->document->addJs($this->_cache['js']);
		$this->journal3->document->addFonts($this->_cache['fonts']);
		$this->journal3->document->addCss($this->_cache['css']);
	}

	public function footer() {
		if ($data = Arr::get($this->model_journal3_layout->get($this->model_journal3_layout->getCurrentLayoutId()), 'footerMenu')) {
			$this->journal3->settings->set('footerMenu', $data);
		}

		if ($this->journal3->document->isMobile()) {
			if ($data = Arr::get($this->model_journal3_layout->get($this->model_journal3_layout->getCurrentLayoutId()), 'footerMenuPhone')) {
				$this->journal3->settings->set('footerMenu', $data);
			}
		}
	}

}
