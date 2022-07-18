<?php

use Journal3\Opencart\MenuController;
use Journal3\Options\Parser;

class ControllerJournal3BottomMenu extends MenuController {

	public function index($args) {
		$data = parent::index($args);

		if (!$data) {
			return null;
		}

		$this->journal3->document->addClass('has-bottom-menu');

		return $data;
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
