<?php

class ControllerExtensionThemeJournal3 extends Controller {
	public function index() {
		if (version_compare(VERSION, '3', '>=')) {
			$this->response->redirect($this->url->link('journal3/journal3', 'user_token=' . $this->session->data['user_token'], true) . '#/dashboard');
		} else {
			$this->response->redirect($this->url->link('journal3/journal3', 'token=' . $this->session->data['token'], true) . '#/dashboard');
		}
	}

	public function install() {
		$this->load->model('journal3/journal3');
		$this->load->model('setting/setting');

		$this->model_journal3_journal3->install();

		$this->model_setting_setting->editSetting('theme_journal3', array(
			'theme_journal3_status'    => '1',
		), 0);

		$this->config->set('theme_journal3_status', '1');
	}

	public function uninstall() {
		$this->load->model('journal3/journal3');

		$this->model_journal3_journal3->uninstall();
	}
}
