<?php

use Journal3\Opencart\Controller;

class ControllerJournal3System extends Controller {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/module');
		$this->load->model('journal3/setting');
		$this->load->language('error/permission');
	}

	public function get() {
		try {
			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_setting->get($id, array('system')));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function edit() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/system')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');
			$data = $this->input(self::POST, 'data');

			$this->renderJson(self::SUCCESS, $this->model_journal3_setting->edit($id, array('system' => $data['system'])));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function attributes() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/system')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$separator = $this->input(self::GET, 'separator');

			$this->model_journal3_module->explodeAttributeValues($separator);

			$this->renderJson(self::SUCCESS);
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

}
