<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;
use Journal3\Utils\Request;

class ControllerJournal3Form extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('tool/upload');
	}

	public function index($args) {
		$data = parent::index($args);

		if (!$data) {
			return null;
		}

		foreach ($this->settings['items'] as $index => $item) {
			if (in_array($item['type'], array('date', 'time', 'datetime'))) {
				if ($this->journal3->isOC2()) {
					$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
					$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
					$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
				} else {
					$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment.min.js');
					$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment/moment-with-locales.min.js');
					$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
					$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
				}
				break;
			}
		}

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		$data['text_select'] = $this->language->get('text_select');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['button_submit'] = $this->language->get('button_submit');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['datepicker'] = $this->language->get('datepicker');

		$data['action'] = $this->model_journal3_links->url('journal3/form/send', 'module_id=' . $this->module_id);

		$data['agree_data'] = $this->model_journal3_links->getInformation($parser->getSetting('agree'));

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		return array();
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		return array();
	}

	protected function beforeRender() {
		if (!isset($this->request->get['route'])) {
			$this->request->get['route'] = 'common/home';
		}

		if ($this->journal3->isOC2()) {
			if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
				$this->settings['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
			} else {
				$this->settings['captcha'] = '';
			}
		} else {
			if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
				$this->settings['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
			} else {
				$this->settings['captcha'] = '';
			}
		}

		foreach ($this->settings['items'] as &$item) {
			if (!$item['placeholder']) {
				if ($item['type'] === 'select') {
					$item['placeholder'] = $this->settings['text_select'];
				} else {
					$item['placeholder'] = $item['label'];
				}
			}
		}
	}

	public function send() {
		if (defined('JOURNAL3_FORM_LOG') && JOURNAL3_FORM_LOG) {
			$file = DIR_LOGS . 'journal3_form/' . date('Y/m/d') . '.log';
			$dir = pathinfo($file, PATHINFO_DIRNAME);

			if (!is_dir($dir)) {
				@mkdir($dir, 0777, true);
			}

			$data = array(
				'date'   => date('Y-m-d H:i:s'),
				'id'     => $this->session->getId(),
				'SERVER' => $_SERVER,
				'GET'    => $_GET,
				'POST'   => $_POST,
			);

			file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL . PHP_EOL, FILE_APPEND);
		}

		try {
			if (!Request::isAjax()) {
				$this->renderJson(self::SUCCESS, array(
					'message' => 'Success!',
				));

				return;
			}

			$module_id = (int)$this->input('GET', 'module_id');
			$agree = $this->input('POST', 'agree', '');

			if (!$this->index(array('module_id' => $module_id, 'module_type' => 'form',))) {
				throw new \Exception('Invalid module id!');
			}

			$this->load->language('account/register');

			$errors = array();
			$data = array();

			$data['title'] = $this->settings['title'];
			$data['sentEmailTitle'] = $this->settings['sentEmailTitle'];
			$data['sentEmailField'] = $this->settings['sentEmailField'];
			$data['sentEmailValue'] = $this->settings['sentEmailValue'];
			$data['sentEmailUsingModule'] = $this->settings['sentEmailUsingModule'];
			$data['sentEmailFrom'] = $this->settings['sentEmailFrom'];
			$data['sentEmailIPAddress'] = $this->settings['sentEmailIPAddress'];

			$data['url'] = htmlspecialchars_decode($this->input('POST', 'url', ''));

			if (!$data['url']) {
				$data['url'] = $this->config->get(Request::isHttps() ? 'config_ssl' : 'config_url');
			}

			$data['ip'] = $this->request->server['REMOTE_ADDR'];

			if (isset($this->settings['agree'])) {
				$agree_data = $this->model_journal3_links->getInformation($this->settings['agree']);

				if ($agree_data && !$agree) {
					$errors['agree'] = $agree_data['error'];
				}
			}

			foreach ($this->settings['items'] as $index => $item) {
				$value = Arr::get($this->request->post, 'item.' . $index);

				if ($item['type'] !== 'legend') {
					if ($item['required'] && empty($value)) {
						$errors['item[' . $index . ']'] = sprintf($this->language->get('error_custom_field'), $item['label']);
					}
				}

				if ($item['type'] === 'name') {
					$data['name'] = $value;
				} else if ($item['type'] === 'email') {
					$data['email'] = $value;

					if ($value && !isset($errors['item[' . $index . ']']) && ((utf8_strlen($value) > 96) || !filter_var($value, FILTER_VALIDATE_EMAIL))) {
						$errors['item[' . $index . ']'] = $this->language->get('error_email');
					}
				}

				$data['items'][$index] = array(
					'type'  => $item['type'],
					'label' => $item['label'],
					'value' => $value,
				);

				if ($item['type'] === 'file') {
					$upload_info = $this->model_tool_upload->getUploadByCode($value);

					if ($upload_info) {
						$data['items'][$index]['code'] = $upload_info['code'];
						$data['items'][$index]['value'] = $upload_info['name'];
						$data['items'][$index]['url'] = $this->url->link('journal3/form/download', 'code=' . $upload_info['code']);
					}
				}
			}

			if (!isset($this->request->post['g-recaptcha-response'])) {
				$this->request->post['g-recaptcha-response'] = '';
			}

			if (!isset($this->request->post['captcha'])) {
				$this->request->post['captcha'] = '';
			}

			if ($this->journal3->isOC2()) {
				if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
					$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

					if ($captcha) {
						$errors['captcha'] = $captcha;
					}
				}
			} else {
				if ($this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('contact', (array)$this->config->get('config_captcha_page'))) {
					$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

					if ($captcha) {
						$errors['captcha'] = $captcha;
					}
				}
			}

			if ($errors) {
				$this->renderJson(self::ERROR, array('errors' => $errors));
			} else {
				unset($this->session->data['gcapcha']);

				$this->load->model('journal3/message');
				$this->load->model('journal3/image');

				$email_data = array(
					'title'      => $this->config->get('config_name'),
					'logo'       => $this->settings['sentEmailLogo'] && $this->config->get('config_logo') ? $this->model_journal3_image->resize($this->config->get('config_logo')) : false,
					'store_name' => $this->config->get('config_name'),
					'store_url'  => $this->config->get(Request::isHttps() ? 'config_ssl' : 'config_url'),
					'data'       => $data,
				);

				$this->model_journal3_message->addMessage($data);

				$replace_keys = array(
					'{{ $store }}',
					'{{ $email }}',
				);

				$replace_values = array(
					$this->config->get('config_name'),
					Arr::get($data, 'email'),
				);

				foreach ($data['items'] as $key => $value) {
					if (is_scalar($v = Arr::get($value, 'value'))) {
						$replace_keys[] = '{{ $field' . $key . ' }}';
						$replace_values[] = $v;
					}
				}

				$params = array(
					'to'      => $this->settings['sentEmailTo'] ? $this->settings['sentEmailTo'] : $this->config->get('config_email'),
					'subject' => str_replace($replace_keys, $replace_values, $this->settings['sentEmailSubject']),
					'message' => $this->load->view('journal3/module/form_email', $email_data),
				);

				if (Arr::get($data, 'email')) {
					$params['reply_to'] = $data['email'];
				}

				$this->load->controller('journal3/mail/send', $params);

				$this->renderJson(self::SUCCESS, array('message' => $this->settings['sentText']));
			}
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function download() {
		if (isset($this->request->get['code'])) {
			$code = $this->request->get['code'];
		} else {
			$code = 0;
		}

		$upload_info = $this->model_tool_upload->getUploadByCode($code);

		if ($upload_info) {
			$file = DIR_UPLOAD . $upload_info['filename'];
			$mask = basename($upload_info['name']);

			if (!headers_sent()) {
				if (is_file($file)) {
					header('Content-Type: application/octet-stream');
					header('Content-Description: File Transfer');
					header('Content-Disposition: attachment; filename="' . ($mask ? $mask : basename($file)) . '"');
					header('Content-Transfer-Encoding: binary');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));

					readfile($file, 'rb');
					exit;
				} else {
					exit('Error: Could not find file ' . $file . '!');
				}
			} else {
				exit('Error: Headers already sent out!');
			}
		} else {
			$this->load->language('error/not_found');

			$this->document->setTitle($this->language->get('heading_title'));

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_not_found'] = $this->language->get('text_not_found');

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], true),
			);

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

}
