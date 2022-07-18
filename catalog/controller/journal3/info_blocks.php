<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;

class ControllerJournal3InfoBlocks extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);
	}

	/**
	 * @param Parser $parser
	 * @param $module_id
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $module_id) {
		return array();
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		$data = array(
			'classes' => array(
				'info-blocks',
				'info-blocks-' . $parser->getSetting('type'),
			),
		);

		if ($parser->getSetting('type') === 'image') {
			$data['image'] = $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']);
			$data['image2x'] = $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['imageDimensions']['width'] * 2, $this->settings['imageDimensions']['height'] * 2, $this->settings['imageDimensions']['resize']);
		}

		return $data;
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
