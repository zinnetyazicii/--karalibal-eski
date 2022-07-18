<?php

use Journal3\Opencart\Controller;
use Journal3\Utils\Arr;
use Journal3\Utils\Profiler;
use Journal3\Utils\Request;
use Journal3\Utils\Str;

class ControllerJournal3AdminBar extends Controller {

	public function index() {
		if (!$this->journal3->isAdmin() || Request::isAjax() || Request::isPost()) {
			return;
		}

		if (Request::hasRequestHeader('CONTENT_TYPE', 'application/json') || Request::hasResponseHeader('Content-Type', 'application/json')) {
			return;
		}

		if (Request::hasRequestHeader('CONTENT_TYPE', 'application/rss+xml') || Request::hasResponseHeader('Content-Type', 'application/rss+xml')) {
			return;
		}

		$route = Arr::get($this->request->get, 'route');

		if (Str::startsWith($route, 'extension/') || Str::startsWith($route, 'api/') || Str::startsWith($route, 'feed/') || Str::startsWith($route, 'extension/') || Str::startsWith($route, 'journal3/journal3/')) {
			return;
		}

		Profiler::end('journal3/admin_bar');

		$data['stats'] = Profiler::getStats();

		$data['ttfb'] = number_format(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3) * 1000;

		echo $this->renderView('journal3/admin_profiler', $data);

		if (!$this->journal3->settings->get('adminBar')) {
			return;
		}

//		$data['total_time'] = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
//		$data['query_time'] = \DB::$time;
//		$data['query_count'] = count(\DB::$log);
//		$data['queries'] = \DB::$log;

		$token = Arr::get($this->session->data, 'user_token');

		$data['edit_layout'] = 'admin/index.php?route=journal3/journal3&user_token=' . $token . '#/layout/edit/' . $this->journal3->document->getLayoutId();
		$data['edit_skin'] = 'admin/index.php?route=journal3/journal3&user_token=' . $token . '#/skin/edit/' . $this->journal3->settings->get('active_skin');

		$header_desktop = Arr::get(explode('/', $this->journal3->settings->get('headerDesktop')), 0);
		$header_mobile = Arr::get(explode('/', $this->journal3->settings->get('headerMobile')), 0);

		$data['desktop_headers'] = array();

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "journal3_module` WHERE `module_type` LIKE 'header_desktop_%' ORDER BY module_name ASC");

		foreach ($query->rows as $row) {
			$data['desktop_headers'][] = array(
				'name'     => 'Desktop: ' . $row['module_name'],
				'value'    => $row['module_id'] . '/' . $row['module_type'],
				'selected' => $header_desktop === $row['module_id'],
			);
		}

		$data['mobile_headers'] = array();

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "journal3_module` WHERE `module_type` LIKE 'header_mobile%' ORDER BY module_name ASC");

		foreach ($query->rows as $row) {
			$data['mobile_headers'][] = array(
				'name'     => 'Mobile: ' . $row['module_name'],
				'value'    => $row['module_id'] . '/' . $row['module_type'],
				'selected' => $header_mobile === $row['module_id'],
			);
		}

		echo $this->renderView('journal3/admin_bar', $data);
	}

	public function save() {
		if (!$this->journal3->isAdmin()) {
			return;
		}

		if ($value = Arr::get($this->request->post, 'headerDesktop')) {
			$this->model_journal3_settings->updateSetting('headerDesktop', $value);
		}

		if ($value = Arr::get($this->request->post, 'headerMobile')) {
			$this->model_journal3_settings->updateSetting('headerMobile', $value);
		}

		return $this->renderJson('success');
	}

}
