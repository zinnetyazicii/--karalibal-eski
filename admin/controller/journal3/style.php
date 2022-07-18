<?php

use Journal3\Opencart\Controller;

class ControllerJournal3Style extends Controller {

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/style');
		$this->load->language('error/permission');
	}

	public function all() {
		try {
			$filters = array(
				'type'   => $this->input(self::GET, 'type'),
				'filter' => $this->input(self::GET, 'filter', ''),
				'sort'   => $this->input(self::GET, 'sort', ''),
				'order'  => $this->input(self::GET, 'order', ''),
				'page'   => $this->input(self::GET, 'page', '1'),
				'limit'  => $this->input(self::GET, 'limit', '10'),
			);

			$this->renderJson(self::SUCCESS, $this->model_journal3_style->all($filters));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function get() {
		try {
			$id = urldecode($this->input(self::GET, 'id'));
			$type = $this->input(self::GET, 'type');

			$this->renderJson(self::SUCCESS, $this->model_journal3_style->get($id, $type));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function add() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/style')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$type = $this->input(self::GET, 'type');
			$data = $this->input(self::POST, 'data');

			$this->renderJson(self::SUCCESS, $this->model_journal3_style->add($type, $data));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function edit() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/style')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = urldecode($this->input(self::GET, 'id'));
			$type = $this->input(self::GET, 'type');
			$data = $this->input(self::POST, 'data');

			$this->renderJson(self::SUCCESS, $this->model_journal3_style->edit($id, $type, $data));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function copy() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/style')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = urldecode($this->input(self::GET, 'id'));
			$type = $this->input(self::GET, 'type');

			$this->renderJson(self::SUCCESS, $this->model_journal3_style->copy($id, $type));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function remove() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/style')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = urldecode($this->input(self::GET, 'id'));
			$type = $this->input(self::GET, 'type');

			$this->renderJson(self::SUCCESS, $this->model_journal3_style->remove($id, $type));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}


}
