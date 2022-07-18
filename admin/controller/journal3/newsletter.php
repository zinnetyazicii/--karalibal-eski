<?php

use Journal3\Opencart\Controller;

class ControllerJournal3Newsletter extends Controller {

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/newsletter');
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

			$this->renderJson(self::SUCCESS, $this->model_journal3_newsletter->all($filters));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function remove() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/newsletter')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$email = $this->input(self::GET, 'email');

			$this->renderJson(self::SUCCESS, $this->model_journal3_newsletter->unsubscribe($email));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function export() {
		header('Pragma: public');
		header('Expires: 0');
		header('Content-Description: File Transfer');
		header('Content-Type: text/plain');
		header('Content-Disposition: attachment; filename=' . date('Y-m-d_H-i-s', time()) . '_newsletter_list.csv');
		header('Content-Transfer-Encoding: binary');

		echo 'Name,Customer,Store' . PHP_EOL;

		$subscribers = $this->model_journal3_newsletter->all();

		foreach ($subscribers['items'] as $subscriber) {
			echo "{$subscriber['name']},{$subscriber['email']},{$subscriber['store_id']}" . PHP_EOL;
		}

		exit();
	}

}
