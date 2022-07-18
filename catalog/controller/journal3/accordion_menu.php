<?php

use Journal3\Opencart\MenuController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3AccordionMenu extends MenuController {

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

	protected function beforeRender() {
		if (isset($this->request->get['path'])) {
			$category_ids = explode('_', $this->request->get['path']);

			if ($category_ids) {
				$this->parse($category_ids, $this->settings['items'], 0);
			}
		}
	}

	private function parse($category_ids, &$items, $index) {
		if (isset($category_ids[$index])) {
			foreach ($items as &$item) {
				if ($index === 0) {
					$category_id = Arr::get($item, 'link.id');
				} else {
					$category_id = Arr::get($item, 'category_id');
				}

				if ($category_id === $category_ids[$index]) {
					$item['classes'][] = 'open active';
					$item['isOpen'] = true;
				}

				if (isset($item['items'])) {
					$this->parse($category_ids, $item['items'], $index + 1);
				}
			}
		}
	}

}
