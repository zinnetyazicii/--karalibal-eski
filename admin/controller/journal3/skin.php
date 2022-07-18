<?php

use Journal3\Opencart\Controller;

class ControllerJournal3Skin extends Controller {

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/skin');
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

			$this->renderJson(self::SUCCESS, $this->model_journal3_skin->all($filters));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function get() {
		try {
			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_skin->get($id));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function add() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/skin')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$data = $this->input(self::POST, 'data');

			$this->renderJson(self::SUCCESS, $this->model_journal3_skin->add($data));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function edit() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/skin')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');
			$data = $this->input(self::POST, 'data');

			$this->renderJson(self::SUCCESS, $this->model_journal3_skin->edit($id, $data));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function copy() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/skin')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_skin->copy($id));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function remove() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/skin')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_skin->remove($id));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function load() {
		$this->renderJson(self::SUCCESS, $this->model_journal3_skin->load());
	}

	public function save() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/skin')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$data = $this->input(self::POST, 'data');

			$this->renderJson(self::SUCCESS, $this->model_journal3_skin->save($data));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function reset() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/skin')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_skin->reset($id));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

}
