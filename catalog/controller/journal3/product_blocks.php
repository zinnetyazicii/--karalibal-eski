<?php

use Journal3\Opencart\MenuController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3ProductBlocks extends MenuController {

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

			if (Arr::get($this->module_data, 'general.blockType') === 'custom') {
				return $this->load->controller('journal3/blocks', array(
					'module_id'   => $this->module_id,
					'module_type' => $this->module_type,
				));
			}

			$parser = new Parser('module/' . $this->module_type . '/' . $this->module_type, Arr::get($this->module_data, 'general'), null, array($this->module_id));

			$this->css = $parser->getCss();

			$rows = array();
			$row_id = 0;

			$this->settings = array_merge_recursive(
				$parser->getPhp(),
				array(
					'status'       => $parser->getSetting('status'),
					'grid_classes' => array(
						'product-blocks-' . $this->module_data['general']['position'],
						'product-blocks-' . $this->module_id,
						'grid-rows',
					),
					'rows'         => $rows,
				),
				$this->parseGeneralSettings($parser, $this->module_id)
			);

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
							'grid-row-' . $this->module_id . '-' . $row_id,
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
								'grid-col-' . $this->module_id . '-' . $row_id . '-' . $column_id,
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
								'grid-item-' . $this->module_id . '-' . $row_id . '-' . $column_id . '-' . $module_id,
							),
							'item'    => Arr::get($module, 'item'),
						);
					}
				}

			}

			$this->settings['rows'] = $rows;
		}

		if ($this->settings['status'] === false) {
			return null;
		}

		if (Arr::get($this->settings, 'scheduledStatus') === false) {
			return null;
		}

		if ($this->css) {
			$this->journal3->document->addCss($this->css);
		}

		$output = $this->renderGrid($this->settings);

		if (!$output) {
			return null;
		}

		return $output;
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
		return array();
	}

}
