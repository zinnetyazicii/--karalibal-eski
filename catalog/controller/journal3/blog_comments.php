<?php

use Journal3\Opencart\ModuleController;

class ControllerJournal3BlogComments extends ModuleController {

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
		$results = $this->model_journal3_blog->getLatestComments();

		$items = array();

		foreach ($results as $result) {
			$items[] = array(
				'classes'  => array(
					'module-item',
				),
				'title'    => $result['post'],
				'avatar'   => md5(strtolower(trim($result['email']))),
				'href'     => $this->url->link('journal3/blog/post', 'journal_blog_post_id=' . $result['post_id']) . '#c' . $result['comment_id'],
				'subtitle' => $result['name'],
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
