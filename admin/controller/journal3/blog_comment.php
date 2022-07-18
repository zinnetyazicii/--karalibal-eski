<?php

use Journal3\Opencart\Controller;

class ControllerJournal3BlogComment extends Controller {

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/blog_comment');
		$this->load->language('error/permission');
	}

	public function all() {
		try {
			$filters = array(
				'filter' => $this->input(self::GET, 'filter', ''),
				'sort'   => $this->input(self::GET, 'sort', ''),
				'order'  => $this->input(self::GET, 'order', ''),
				'page'   => $this->input(self::GET, 'page', '1'),
				'limit'  => $this->input(self::GET, 'limit', '10'),
			);

			$this->renderJson(self::SUCCESS, $this->model_journal3_blog_comment->all($filters));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function get() {
		try {
			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_blog_comment->get($id));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function add() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/blog_comment')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$data = $this->input(self::POST, 'data');

			$this->renderJson(self::SUCCESS, $this->model_journal3_blog_comment->add($data));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function edit() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/blog_comment')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');
			$data = $this->input(self::POST, 'data');

			$this->renderJson(self::SUCCESS, $this->model_journal3_blog_comment->edit($id, $data));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function copy() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/blog_comment')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_blog_comment->copy($id));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function remove() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/blog_comment')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_blog_comment->remove($id));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

}
