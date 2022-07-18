<?php

use Journal3\Utils\Arr;

class ControllerJournal3Mail extends Controller {

	public function index() {
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if ($this->journal3->isAdmin()) {
			$this->load->language('information/contact');

			$data['error_warning'] = '';
			$data['heading_title'] = 'Mail Test';
		} else {
			$data['error_warning'] = 'You must be logged in as admin to view this page!';
		}

		$this->response->setOutput($this->load->view('journal3/mail', $data));
	}

	public function test() {
		$data['data'] = $this->request->post;

		if ($this->journal3->isAdmin()) {
			$to = $this->request->post['email'];
			$message = $this->request->post['enquiry'];

			if (!$to) {
				$data['error'] = 'Empty email address!';
			} else if (!$message) {
				$data['error'] = 'Empty message!';
			} else {
				$data['status'] = 'success';
				$this->send(array(
					'to'         => $to,
					'subject'    => 'Test E-Mail',
					'message'    => $message,
					'additional' => false,
				));
			}
		} else {
			$data['error'] = 'You must be logged in as admin to view this page!';
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($data));
	}

	public function send($data) {
		if (version_compare(VERSION, '3', '>=')) {
			$mail = new Mail($this->config->get('config_mail_engine'));
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
		} else if (version_compare(VERSION, '2.0.3.1', '>=')) {
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
		} else if (version_compare(VERSION, '2.0.2.0', '>=')) {
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
		} else if (version_compare(VERSION, '2', '>=')) {
			$mail = new Mail($this->config->get('config_mail'));
		} else {
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');
		}

		$mail->setTo($data['to']);

		if (isset($data['reply_to']) && $data['reply_to']) {
			$mail->setReplyTo($data['reply_to']);
		}

		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
		$mail->setSubject(html_entity_decode($data['subject'], ENT_QUOTES, 'UTF-8'));
		$mail->setText(strip_tags($data['message']));
		$mail->setHtml(html_entity_decode($data['message'], ENT_QUOTES, 'UTF-8'));
		$mail->send();

		if (Arr::get($data, 'additional', true)) {
			if (version_compare(VERSION, '3', '>=')) {
				$emails = explode(',', $this->config->get('config_mail_alert_email'));
			} else {
				$emails = explode(',', $this->config->get('config_alert_email'));
			}

			foreach ($emails as $email) {
				$email = trim($email);
				if (utf8_strlen($email) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}
	}

}
