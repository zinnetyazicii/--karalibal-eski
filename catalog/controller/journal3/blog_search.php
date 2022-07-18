<?php

use Journal3\Opencart\ModuleController;

class ControllerJournal3BlogSearch extends ModuleController {

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
		return array(
			'search' => \Journal3\Utils\Arr::get($this->request->get, 'journal_blog_search'),
			'url'    => $this->url->link('journal3/blog', 'journal_blog_search='),
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
