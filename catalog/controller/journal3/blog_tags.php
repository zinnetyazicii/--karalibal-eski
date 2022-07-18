<?php

use Journal3\Opencart\ModuleController;

class ControllerJournal3BlogTags extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/blog');
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		$results = $this->model_journal3_blog->getTags($parser ->getSetting('limit'));

		$items = array();

		foreach ($results as $result) {
			$items[] = array(
				'name' => $result,
				'href' => $this->url->link('journal3/blog', 'journal_blog_tag=' . $result),
			);
		}

		return array(
			'items' => $items,
		);
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

}
