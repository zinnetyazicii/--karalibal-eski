<?php

use Journal3\Opencart\Controller;

class ControllerJournal3Setting extends Controller {

	private static $SETTING_GROUP = array(
		'general',
		'active_skin',
		'seo',
		'performance',
		'custom_code',
	);

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/setting');
		$this->load->language('error/permission');
	}

	public function get() {
		try {
			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_setting->get($id, static::$SETTING_GROUP));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function edit() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/setting')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');
			$data = $this->input(self::POST, 'data');

			$this->renderJson(self::SUCCESS, $this->model_journal3_setting->edit($id, $data));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function check_indexes() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/setting')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$this->renderJson(self::SUCCESS, $this->model_journal3_setting->indexes());
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function add_indexes() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/setting')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$this->renderJson(self::SUCCESS, $this->model_journal3_setting->indexes(true));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

}
