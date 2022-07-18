<?php

use Journal3\Opencart\Controller;
use Journal3\Utils\Arr;

class ControllerJournal3Startup extends Controller {

	public function index() {
		if ($this->config->get('config_theme') === 'journal3' || $this->config->get('config_theme') === 'theme_journal3' || $this->config->get('config_template') === 'journal3') {
			// redirect wrong hostname to avoid cors
//			if (Request::isGet()) {
//				$current_url = Request::getCurrentUrl();
//				$correct_url = $this->url->link('');
//
//				$current_host = parse_url($current_url, PHP_URL_SCHEME) . '://' . parse_url($current_url, PHP_URL_HOST);
//				$correct_host = parse_url($correct_url, PHP_URL_SCHEME) . '://' . parse_url($correct_url, PHP_URL_HOST);
//
//				if ($current_host !== $correct_host) {
//					$url = str_replace($current_host, $correct_host, $current_url);
//
//					if (!headers_sent()) {
//						header('Location: ' . $url);
//					} else {
//						echo '<script>location = "' . $url . '";</script>';
//					}
//
//					exit;
//				}
//			}

			define('JOURNAL3_CATALOG', true);
			define('JOURNAL3_ACTIVE', true);

			$this->registry->set('journal3', new Journal3($this->registry));

			if (defined('J3_ENABLE_PROFILER') && J3_ENABLE_PROFILER && $this->journal3->isAdmin() && isset($this->request->get['j3pr'])) {
				Clockwork\Support\Vanilla\Clockwork::init([
					'api'                => parse_url(HTTP_SERVER, PHP_URL_PATH) . 'index.php?route=journal3/profiler/clockwork&j3pr=1&request=',
					'storage_files_path' => DIR_LOGS . 'clockwork',
					'register_helpers'   => true,
				]);

				$this->event->register('controller/*/before', new Action('journal3/profiler/before_controller'));
				$this->event->register('controller/*/after', new Action('journal3/profiler/after_controller'));
				$this->event->register('view/*/before', new Action('journal3/profiler/before_view'));
				$this->event->register('view/*/after', new Action('journal3/profiler/after_view'));
			}

			// models
			$this->load->model('journal3/settings');
			$this->load->model('journal3/module');
			$this->load->model('journal3/image');

			// php version check
			if (version_compare(VERSION, '3.0.3.6', '<=') && version_compare(phpversion(), '7.4', '>=')) {
				$this->print_error(
					'Unsupported PHP Version',
					'Opencart <b>' . VERSION . '</b> does not fully support PHP <b>' . phpversion() . '</b> version!',
					'Consult with your hosting provider for more information regarding how to downgrade PHP to 7.3 (or lower).'
				);
			}

			// skins check
			if (!$this->model_journal3_settings->haveSkins()) {
				$this->print_error(
					'No Skins Found',
					'You can import demo content by following the documentation on: <a href="https://docs.journal-theme.com/docs/demos/demo" target="_blank">Demo Import</a>.'
				);
			}

			// assets folder writable
			if (!is_writable($this->journal3->minifier->getAssetsPath())) {
				$this->print_error(
					'Not Writable',
					$this->journal3->minifier->getAssetsPath() . ' is not writable!',
					'Consult with your hosting provider for more information.'
				);
			}

			// document classes
			if ($this->journal3->isAdmin()) {
				$this->journal3->document->addClass('is-admin');
			}

			if ($this->journal3->isCustomer()) {
				$this->journal3->document->addClass('is-customer');
			} else {
				$this->journal3->document->addClass('is-guest');
			}

			if ($this->config->get('config_maintenance') && !$this->journal3->isAdmin()) {
				$this->journal3->document->addClass('maintenance-page');
			}

			// settings
			$this->load->controller('journal3/settings');

			// modernizr
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/modernizr/modernizr-custom.js');

			// jquery
			if ($this->journal3->isOC31()) {
				$this->journal3->document->addScript('catalog/view/theme/journal3/lib/jquery/jquery-3.3.1.min.js');
			} else {
				$this->journal3->document->addScript('catalog/view/theme/journal3/lib/jquery/jquery-2.1.1.min.js');
			}

			// bootstrap
			$this->journal3->document->addStyle('catalog/view/javascript/bootstrap/css/bootstrap.min.css');
			$this->journal3->document->addStyle('catalog/view/javascript/font-awesome/css/font-awesome.min.css');

			if ($this->journal3->isOC31()) {
				$this->journal3->document->addScript('catalog/view/javascript/bootstrap/js/popper.min.js');
			}

			$this->journal3->document->addScript('catalog/view/javascript/bootstrap/js/bootstrap.min.js');

			// bootstrap rtl
			if ($this->language->get('direction') === 'rtl') {
				$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/bootstrap-rtl/bootstrap-rtl.min.css');
			}

			// icons
			if (is_file(DIR_TEMPLATE . 'journal3/icons_custom/style.css')) {
				$icons = 'icons_custom';
			} else {
				$icons = 'icons';
			}

			if (is_file(DIR_TEMPLATE . 'journal3/' . $icons . '/style.minimal.css')) {
				$this->journal3->document->addStyle('catalog/view/theme/journal3/' . $icons . '/style.minimal.css');
			} else {
				$this->journal3->document->addStyle('catalog/view/theme/journal3/' . $icons . '/style.css');
			}

			// common.js
			$this->journal3->document->addScript('catalog/view/javascript/common.js');

			// anime
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/anime/anime.min.js', 'footer');

			// lazyload
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/vanilla-lazyload/lazyload.min.js', 'footer');

			// countdown
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/countdown/jquery.countdown.min.js', 'footer');

			// inobounce
			if ($this->journal3->document->isMobile()) {
				$this->journal3->document->addScript('catalog/view/theme/journal3/lib/inobounce/inobounce.js', 'footer');
			}

			// typeahead
			if ($this->journal3->settings->get('searchStyleSearchAutoSuggestStatus')) {
				$this->journal3->document->addScript('catalog/view/theme/journal3/lib/typeahead/typeahead.jquery.min.js', 'footer');
			}

			// hover intent
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/hoverintent/jquery.hoverIntent.min.js', 'footer');

			// sticky
			//$this->journal3->document->addScript('catalog/view/theme/journal3/lib/sticky/sticky.min.js', 'footer');

			// infinite scroll
			if (in_array(Arr::get($this->request->get, 'route', ''), array(
				'product/catalog',
				'product/category',
				'product/manufacturer/info',
				'product/search',
				'product/special',
			))) {
				$this->journal3->document->addScript('catalog/view/theme/journal3/lib/ias/jquery-ias.min.js', 'footer');
			}

			// cookie
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/cjs/cjs.js', 'footer');

			// admin
			if ($this->journal3->isAdmin()) {
				$this->journal3->document->addScript('catalog/view/theme/journal3/js/admin.js', 'footer');
			}

			// product extras
			$this->load->controller('journal3/product/extras', array('module_type' => 'product_label'));
			$this->load->controller('journal3/product/extras', array('module_type' => 'product_exclude_button'));
			$this->load->controller('journal3/product/extras', array('module_type' => 'product_extra_button'));
			$this->load->controller('journal3/product/extras', array('module_type' => 'product_blocks'));
			$this->load->controller('journal3/product/extras', array('module_type' => 'product_tabs'));
			$this->load->controller('journal3/product/second_image');
			$this->load->controller('journal3/product/countdown');

			// mega menu info blocks
			if ($this->journal3->settings->get('headerType') === 'mega' && $this->journal3->settings->get('infoBlocksModule')) {
				$this->journal3->settings->set('headerInfoBlocks', $this->load->controller('journal3/info_blocks', array(
					'module_id'   => $this->journal3->settings->get('infoBlocksModule'),
					'module_type' => 'info_blocks',
				)));
			}
		}
	}

	public function error() {
		if (!defined('JOURNAL3_INSTALLED')) {
			return;
		}

		if (
			($this->config->get('config_theme') === 'theme_default' || $this->config->get('config_theme') === 'default') &&
			($this->config->get('config_template') === 'journal3' || $this->config->get('theme_default_directory') === 'journal3')
		) {
			$this->print_error(
				'Journal Installation Error',
				'Journal3 must be activated from System > Settings > Your Store > General > Theme and not from Extension > Extension > Themes (like in Journal2).
			');
		}

		$this->response->redirect($this->url->link('common/home'));
	}

	public function print_error($title, $error, $footer = '') {
		echo "
			<style>
				body {
					font-family: sans-serif;
					padding: 30px;
				}
				b {
					color: red;
				}
			</style>
			<div class=\"content\">
				<p><h2>{$title}</h2></p>
				<p>{$error}</p>
				<p><b>{$footer}</b></p>
			</div>
		";

		exit;
	}
}
