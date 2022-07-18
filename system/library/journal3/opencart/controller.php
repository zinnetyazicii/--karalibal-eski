<?php

namespace Journal3\Opencart;

use Journal3\Utils\Arr;

class Controller extends \Controller implements Autocomplete {

	const GET = 'GET';
	const POST = 'POST';
	const FILE = 'FILE';

	const SUCCESS = 'success';
	const ERROR = 'error';

	public $_cache_key;
	private $_cache_data;

	public function __construct($registry) {
		parent::__construct($registry);

		if (!defined('JOURNAL3_INSTALLED')) {
			echo "
				<style>
					.content {
						margin: 0 auto;
						max-width: 1024px;
						margin-top: 200px;
						text-align: center;
					}
				</style>
				<div class=\"content\">
					<h2>Journal Theme Installation Error</h2>
					<hr/>
					<p>Make sure you have refreshed Opencart Modifications.</p>
				</div>
			";
			exit;
		}

		$data = json_decode(file_get_contents('php://input'), true);

		if (is_array($data)) {
			foreach ($data as $key => $value) {
				// do not clean if admin
				if (Arr::get($this->registry->get('session')->data, 'user_id')) {
					$this->request->post[$key] = $value;
				} else {
					$this->request->post[$this->request->clean($key)] = $this->request->clean($value);
				}
			}
		}
	}

	protected function renderGrid($data, $grid = true) {
		$module_args = array();

		if (Arr::get($data, 'link.type') === 'category') {
			$module_args['category_prefix'] = Arr::get($data, 'link.id');
		}

		if (isset($data['rows'])) {
			foreach ($data['rows'] as $rk => &$row) {
				foreach ($row['columns'] as $ck => &$column) {
					foreach ($column['items'] as $ik => &$item) {
						$id = Arr::get($item, 'item.id');
						$type = Arr::get($item, 'item.type');

						$item['item'] = null;

						if ($id) {
							switch ($type) {
								case 'opencart':
									$part = explode('/', $id);

									if ($this->journal3->isOC2()) {
										if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
											$item['item'] = $this->load->controller('extension/module/' . $part[0]);
										}

										if (isset($part[1])) {
											$this->load->model('extension/module');
											$setting_info = $this->model_extension_module->getModule($part[1]);

											if ($setting_info && $setting_info['status']) {
												$item['item'] = $this->load->controller('extension/module/' . $part[0], $setting_info);
											}
										}
									} else {
										if (isset($part[0]) && $this->config->get('module_' . $part[0] . '_status')) {
											$item['item'] = $this->load->controller('extension/module/' . $part[0]);
										}

										if (isset($part[1])) {
											$this->load->model('setting/module');
											$setting_info = $this->model_setting_module->getModule($part[1]);

											if ($setting_info && $setting_info['status']) {
												$item['item'] = $this->load->controller('extension/module/' . $part[0], $setting_info);
											}
										}
									}

									break;

								default:
									$item['item'] = $this->load->controller('journal3/' . $type, array(
										'module_id'   => $id,
										'module_type' => $type,
										'module_args' => $module_args
									));

									if (!$item['item']) {
										unset($column['items'][$ik]);
									}

							}
						}
					}

					if (!$column['items']) {
						unset($row['columns'][$ck]);
					}
				}

				if (!$row['columns']) {
					unset($data['rows'][$rk]);
				}
			}
		}

		if (!$data['rows']) {
			return null;
		}

		if ($grid) {
			return $this->renderView('journal3/layout', $data);
		}

		return $data;
	}

	protected function renderView($tpl, $data = array()) {
		$result = $this->load->view($tpl, $data);

		$result = $this->journal3->cache->update($result);

		return $result;
	}

	protected function renderOutput($tpl, $data = array()) {
		$this->response->setOutput($this->renderView($tpl, $data));
	}

	protected function renderJson($status, $data = array()) {
		$output = json_encode(array(
			'status'   => $status,
			'response' => $data,
			'request'  => array(
				'url'  => $this->request->server['REQUEST_URI'],
				'get'  => $this->request->get,
				'post' => $this->request->post,
			),
		));

		$output = str_replace('&amp;', '&', $output);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput($output);
	}

	protected function input($method, $variable, $default = null) {
		$value = null;

		if ($method === self::GET) {
			$value = Arr::get($this->request->get, $variable);
		}

		if ($method === self::POST) {
			$value = Arr::get($this->request->post, $variable);
		}

		if ($method === self::FILE) {
			$value = Arr::get($this->request->files, $variable);
		}

		if ($value === null && $default !== null) {
			$value = $default;
		}

		if ($value === null) {
			throw new \Exception(sprintf($this->language->get('error_input_not_found'), $method, $variable));
		}

		return $value;
	}

	protected function getAdminToken() {
		if (version_compare(VERSION, '3', '>=')) {
			$token = 'user_token=' . $this->session->data['user_token'];
		} else {
			$token = 'token=' . $this->session->data['token'];
		}

		return $token;
	}

	protected function adminUrl($route, $args = '') {
		return $this->url->link($route, $this->getAdminToken() . $args, true);
	}

	public function __get($key) {
		if ($key === '_cache') {

			if ($this->_cache_key !== null) {
				if ($this->_cache_data === null) {
					$this->_cache_data = $this->journal3->cache->get($this->_cache_key);
				}

				return $this->_cache_data;
			}

			return false;
		}

		return parent::__get($key);
	}

	public function __set($key, $value) {
		if ($key === '_cache') {
			$this->_cache_data = $value;

			if ($this->_cache_key !== null) {
				$this->journal3->cache->set($this->_cache_key, $this->_cache_data);
			}
		} else {
			parent::__set($key, $value);
		}
	}

}

