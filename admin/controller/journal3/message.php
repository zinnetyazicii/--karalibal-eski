<?php

use Journal3\Opencart\Controller;
use Journal3\Utils\Arr;

class ControllerJournal3Message extends Controller {

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/message');
		$this->load->model('tool/upload');
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

			$this->renderJson(self::SUCCESS, $this->model_journal3_message->all($filters));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function get() {
		try {
			$id = $this->input(self::GET, 'id');

			$message = $this->model_journal3_message->get($id);

			if (is_array(Arr::get($message, 'fields'))) {
				foreach ($message['fields'] as &$field) {
					if ($field['type'] === 'file') {
						$field['code'] = Arr::get($field, 'code');

						// Prior to v.3.0.46, this field was not saved
						if (!$field['code']) {
							parse_str(htmlspecialchars_decode($field['url'], PHP_URL_QUERY), $results);
							$field['code'] = Arr::get($results, 'code');
						}

						$upload_info = $this->model_tool_upload->getUploadByCode($field['code']);

						$field['value'] = $upload_info['name'];

						if ($this->journal3->isOC3()) {
							$field['url'] = $this->url->link('tool/upload/download', 'user_token=' . $this->session->data['user_token'] . '&code=' . $upload_info['code'], true);
						} else {
							$field['url'] = $this->url->link('tool/upload/download', 'token=' . $this->session->data['token'] . '&code=' . $upload_info['code'], true);
						}
					}
				}
			}

			$this->renderJson(self::SUCCESS, $message);
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function remove() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/message')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$id = $this->input(self::GET, 'id');

			$this->renderJson(self::SUCCESS, $this->model_journal3_message->remove($id));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

}
