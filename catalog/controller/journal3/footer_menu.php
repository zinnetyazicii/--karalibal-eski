<?php

use Journal3\Opencart\MenuController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3FooterMenu extends MenuController {

	public function index($args) {
		$this->module_id = (int)Arr::get($args, 'module_id');
		$this->module_type = Arr::get($args, 'module_type');

		$this->_cache_key = $this->module_type . '.' . $this->module_id;

		if ($this->_cache === false) {
			$this->module_data = $this->model_journal3_module->get($this->module_id, $this->module_type);

			if (!$this->module_data) {
				return null;
			}

			$parser = new Parser('module/' . $this->module_type . '/general', Arr::get($this->module_data, 'general'), null, array());

			if ($parser->getSetting('status') === false) {
				return null;
			}

			$this->settings = array_merge_recursive(
				$parser->getPhp(),
				array(
					'grid_classes' => array('grid-rows'),
				),
				$this->parseGeneralSettings($parser, $this->module_id)
			);

			$this->css = $parser->getCss();
			$this->fonts = $parser->getFonts();

			$rows = array();
			$row_id = 0;

			foreach (Arr::get($this->module_data, 'rows', array()) as $row) {
				$row_id++;

				$parser = new Parser('module/' . $this->module_type . '/row', Arr::get($row, 'options'), null, array($row_id));

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

					$parser = new Parser('module/' . $this->module_type . '/column', Arr::get($column, 'options'), null, array($row_id, $column_id));

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

			$this->settings['rows'] = $rows;

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

		if ($this->css) {
			$this->journal3->document->addCss($this->css);
		}

		if ($this->fonts) {
			$this->journal3->document->addFonts($this->fonts);
		}

		if ($this->settings['footerType'] === 'reveal') {
			$this->journal3->document->addClass('footer-reveal');
		}

		return $this->renderGrid($this->settings);
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		return array();
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
		return $this->parseItemSettings($parser, $index);
	}

}
