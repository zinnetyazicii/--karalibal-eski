<?php

use Journal3\Opencart\MenuController;
use Journal3\Options\Parser;
use Journal3\Options\Range;
use Journal3\Utils\Arr;

class ControllerJournal3Popup extends MenuController {

	private $ajax = false;

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

			$rows = array();
			$row_id = 0;

			$this->settings = array_merge_recursive(
				$parser->getPhp(),
				array(
					'status'       => $parser->getSetting('status'),
					'id'           => uniqid($this->module_type . '-'),
					'module_id'    => $this->module_id,
					'classes'      => array(
						'module',
						'module-' . $this->module_type,
						'module-' . $this->module_type . '-' . $this->module_id,
						'popup-iframe' => $this->ajax,
					),
					'grid_classes' => array('grid-rows'),
				),
				$this->parseGeneralSettings($parser, $this->module_id)
			);

			if ($parser->getSetting('contentType') === 'grid') {
				foreach (Arr::get($this->module_data, 'rows', array()) as $row) {
					$row_id++;

					$parser = new Parser('module/' . $this->module_type . '/row', Arr::get($row, 'options'), null, array($this->module_id, $row_id));

					if ($parser->getSetting('status') === false) {
						continue;
					}

					$this->css .= $parser->getCss();

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

						$parser = new Parser('module/' . $this->module_type . '/column', Arr::get($column, 'options'), null, array($this->module_id, $row_id, $column_id));

						if ($parser->getSetting('status') === false) {
							continue;
						}

						$this->css .= $parser->getCss();

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

				$this->settings['rows'] = $rows;
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

		if (Arr::get($this->settings, 'scheduledStatus') === false) {
			return null;
		}

		if ($this->css) {
			$this->journal3->document->addCss($this->css);
		}

		if (!(int)$this->settings['showAfter']) {
			$this->journal3->document->addJs(array('popup' => array(array(
				'm' => $this->module_id,
				'c' => $this->settings['cookie'],
			))));
		}

		if ($this->settings['contentType'] === 'grid') {
			$this->settings['content'] = $this->renderGrid($this->settings);
		}

		$this->settings['iframe'] = Arr::get($args, 'iframe');

		if ($this->settings['iframe']) {
			$this->journal3->document->addClass('module-popup-' . $this->module_id);
			$this->journal3->document->addJs(array(
				'modulePopupId' => $this->module_id,
			));
		}

		return $this->renderView('journal3/module/popup', $this->settings);
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		$data = array(
			'ajax'    => $this->ajax,
			'options' => $parser->getJs(),
		);

		if ($parser->getSetting('contentType') === 'image') {
			$data['image'] = $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']);
		}

		return $data;
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		return array();
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		return array();
	}

	public function get() {
		try {
			$this->ajax = true;

			$module_id = (int)$this->input('GET', 'module_id');

			$data['content'] = $this->index(array('module_id' => $module_id, 'module_type' => 'popup',));
			$data['css'] = $this->css;

			$this->response->setOutput($this->load->view('journal3/module/popup_page', $data));
		} catch (Exception $e) {
			die('Invalid module_id!');
		}
	}

	public function page() {
		try {
			$module_id = (int)$this->input('GET', 'module_id');

			$this->journal3->document->addJs(array('popupModuleId' => $module_id));

			$data['content'] = $this->load->controller('journal3/popup', array('module_id' => $module_id, 'module_type' => 'popup', 'iframe' => true));
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('journal3/module/popup_content', $data));
		} catch (Exception $e) {
			die('Invalid module_id!');
		}
	}

}
