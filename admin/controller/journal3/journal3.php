<?php

use Journal3\Opencart\Controller;
use Journal3\Utils\Arr;

class ControllerJournal3Journal3 extends Controller {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/journal3');
		$this->load->model('journal3/module');

		$this->load->language('error/permission');
	}

	public function index() {
		if (!$this->model_journal3_journal3->isInstalled()) {
			$this->model_journal3_journal3->install();
		} else {
			$this->model_journal3_journal3->database();
		}

		// language
		$this->load->language('journal3/journal3');

		// title
		$this->document->setTitle($this->language->get('Journal'));

		// modernizr
		$this->document->addScript('../catalog/view/theme/journal3/lib/modernizr/modernizr-custom.js');

		// summernote / ckeditor
		// define('JOURNAL3_CKEDITOR', '//cdn.ckeditor.com/4.10.0/standard/ckeditor.js');
		// define('JOURNAL3_CKEDITOR', '//cdn.ckeditor.com/4.10.0/basic/ckeditor.js');
		// define('JOURNAL3_CKEDITOR', '//cdn.ckeditor.com/4.10.0/full/ckeditor.js');
		if (defined('JOURNAL3_CKEDITOR')) {
			$this->document->addScript(JOURNAL3_CKEDITOR);
		} else if ($this->journal3->isOC31()) {
			$this->document->addScript('view/javascript/ckeditor/ckeditor.js');
			$this->document->addScript('view/javascript/ckeditor/adapters/jquery.js');
		} else {
			$this->document->addStyle('view/javascript/summernote/summernote.css');
			$this->document->addScript('view/javascript/summernote/summernote.js');
			if ($this->journal3->isOC3()) {
				$this->document->addScript('view/javascript/summernote/summernote-image-attributes.js');
			}
			$this->document->addScript('view/javascript/summernote/opencart.js');
		}

		// font loader
		$this->document->addScript('https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js');
		$this->document->addStyle('https://fonts.googleapis.com/css?family=Montserrat:300,400,600');


		// icons
		if (is_file(DIR_CATALOG . 'view/theme/journal3/icons_custom/style.css')) {
			$icons = 'icons_custom';
		} else {
			$icons = 'icons';
		}

		$this->document->addStyle('../catalog/view/theme/journal3/' . $icons . '/style.css');

		// journal3 assets
		$this->document->addScript($this->adminUrl('journal3/journal3/js'));

		if ($this->journal3->isDev()) {
			$this->document->addScript('//' . parse_url(HTTP_SERVER, PHP_URL_HOST) . ':35729/livereload.js?snipver=1');
			$this->document->addScript('//' . parse_url(HTTP_SERVER, PHP_URL_HOST) . ':' . (defined('PORT') ? PORT : 4444) . '/vendor.js?t=' . time());
			$this->document->addScript('//' . parse_url(HTTP_SERVER, PHP_URL_HOST) . ':' . (defined('PORT') ? PORT : 4444) . '/main.js?t=' . time());

			$this->document->addStyle('view/javascript/journal3/dist/vendor.css?t=' . time());
			$this->document->addStyle('view/javascript/journal3/dist/style.css?t=' . time());
		} else {
			$this->document->addScript('view/javascript/journal3/dist/vendor.js?v=' . (defined('JOURNAL3_BUILD') ? JOURNAL3_BUILD : JOURNAL3_VERSION));
			$this->document->addScript('view/javascript/journal3/dist/main.js?v=' . (defined('JOURNAL3_BUILD') ? JOURNAL3_BUILD : JOURNAL3_VERSION));

			$this->document->addStyle('view/javascript/journal3/dist/vendor.css?v=' . (defined('JOURNAL3_BUILD') ? JOURNAL3_BUILD : JOURNAL3_VERSION));
			$this->document->addStyle('view/javascript/journal3/dist/style.css?v=' . (defined('JOURNAL3_BUILD') ? JOURNAL3_BUILD : JOURNAL3_VERSION));
		}

		// version
		$data['j3v'] = JOURNAL3_VERSION;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->renderOutput('journal3/journal3', $data);
	}

	public function menu() {
		if (!$this->user->hasPermission('access', 'journal3/journal3') || !$this->config->get('theme_journal3_status')) {
			return null;
		}

		$journal = array();

//		// dashboard
//		$journal[] = array(
//			'name'     => $this->language->get('Dashboard'),
//			'href'     => $this->adminUrl('journal3/journal3') . '#/dashboard',
//			'children' => array(),
//		);

		// variables
		if ($this->user->hasPermission('access', 'journal3/variable')) {
			$journal[] = array(
				'name'     => $this->language->get('Variables'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/variable/color',
				'children' => array(),
			);
		}

		// styles
		if ($this->user->hasPermission('access', 'journal3/style')) {
			$journal[] = array(
				'name'     => $this->language->get('Styles'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/style/page',
				'children' => array(),
			);
		}

		// skins
		if ($this->user->hasPermission('access', 'journal3/skin')) {
			$journal[] = array(
				'name'     => $this->language->get('Skins'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/skin',
				'children' => array(),
			);
		}

		// header modules
		if ($this->user->hasPermission('access', 'journal3/module_header')) {
			$journal[] = array(
				'name'     => $this->language->get('Header'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/module_header/main_menu',
				'children' => array(),
			);
		}

		// footer modules
		if ($this->user->hasPermission('access', 'journal3/module_footer')) {
			$journal[] = array(
				'name'     => $this->language->get('Footer'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/module_footer/footer_menu',
				'children' => array(),
			);
		}

		// layout
		if ($this->user->hasPermission('access', 'journal3/layout')) {
			$journal[] = array(
				'name'     => $this->language->get('Layouts'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/layout',
				'children' => array(),
			);
		}

		// layout modules
		if ($this->user->hasPermission('access', 'journal3/module_layout')) {
			$journal[] = array(
				'name'     => $this->language->get('Modules'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/module_layout/banners',
				'children' => array(),
			);
		}

		// product modules
		if ($this->user->hasPermission('access', 'journal3/module_product')) {
			$journal[] = array(
				'name'     => $this->language->get('Product Extras'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/module_product/product_label',
				'children' => array(),
			);
		}

		// blog
		$children = array();

		if ($this->user->hasPermission('access', 'journal3/blog_setting')) {
			$children[] = array(
				'name'     => $this->language->get('Settings'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/blog_setting',
				'children' => array(),
			);
		}

		if ($this->user->hasPermission('access', 'journal3/blog_category')) {
			$children[] = array(
				'name'     => $this->language->get('Categories'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/blog_category',
				'children' => array(),
			);
		}

		if ($this->user->hasPermission('access', 'journal3/blog_post')) {
			$children[] = array(
				'name'     => $this->language->get('Posts'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/blog_post',
				'children' => array(),
			);
		}

		if ($this->user->hasPermission('access', 'journal3/blog_comment')) {
			$children[] = array(
				'name'     => $this->language->get('Comments'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/blog_comment',
				'children' => array(),
			);
		}

		if ($children) {
			$journal[] = array(
				'name'     => $this->language->get('Blog'),
				'href'     => '',
				'children' => $children,
			);
		}

		// system
		$children = array();

		// settings
		if ($this->user->hasPermission('access', 'journal3/setting')) {
			$children[] = array(
				'name'     => $this->language->get('Settings'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/setting',
				'children' => array(),
			);
		}

		// newsletter
		if ($this->user->hasPermission('access', 'journal3/newsletter')) {
			$children[] = array(
				'name'     => $this->language->get('Newsletter'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/newsletter',
				'children' => array(),
			);
		}

		// message
		if ($this->user->hasPermission('access', 'journal3/message')) {
			$children[] = array(
				'name'     => $this->language->get('Form E-Mails'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/message',
				'children' => array(),
			);
		}

		// import/export
		if ($this->user->hasPermission('access', 'journal3/import_export')) {
			$children[] = array(
				'name'     => $this->language->get('Import / Export'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/import_export',
				'children' => array(),
			);
		}

		// system settings
		if ($this->user->hasPermission('access', 'journal3/system')) {
			$children[] = array(
				'name'     => $this->language->get('System'),
				'href'     => $this->adminUrl('journal3/journal3') . '#/system',
				'children' => array(),
			);
		}

		if ($children) {
			$journal[] = array(
				'name'     => $this->language->get('System'),
				'href'     => '',
				'children' => $children,
			);
		}

		return array(
			'id'       => 'journal3-theme',
			'icon'     => 'fa-cogs journal3-icon',
			'name'     => $this->language->get('Journal'),
			'href'     => '',
			'children' => $journal,
		);
	}

	public function js() {
		$data = array();

		// admin options
		$data['j3limit'] = (int)$this->config->get('config_limit_admin');
		$data['j3ltr'] = defined('JOURNAL3_LTR_ADMIN') && JOURNAL3_LTR_ADMIN === true;

		// php options
		$data['php_ini'] = str_replace('\\', '/', php_ini_loaded_file());
		$data['php_upload_max_filesize'] = ini_get('upload_max_filesize');
		$data['php_post_max_size'] = ini_get('post_max_size');

		// version
		$data['j3v'] =  implode('.', array_slice(explode('.', JOURNAL3_VERSION), 0, 3));
		$data['j3ov'] = JOURNAL3_OC_VERSION;
		$data['ocv'] = VERSION;
		$data['j3debug'] = defined('JOURNAL3_DEBUG') && JOURNAL3_DEBUG;
		$data['j3env'] = defined('JOURNAL3_ENV') ? JOURNAL3_ENV : 'production';

		// sentry
		$data['j3sentry_dsn'] = defined('SENTRY_DSN') ? SENTRY_DSN : '';

		// webpack PORT
		if (defined('PORT')) {
			$data['PORT'] = PORT;
		}

		// base url
		$data['base'] = str_replace('&amp;', '&', $this->adminUrl('journal3/journal3'));

		// session token, needed for ajax calls
		if ($this->journal3->isOC3()) {
			$data['token'] = $this->session->data['user_token'];
		} else {
			$data['token'] = $this->session->data['token'];
		}

		// available stores
		$this->load->model('setting/store');
		$stores = $this->model_setting_store->getStores();
		array_unshift($stores, array(
			'store_id' => '0',
			'name'     => $this->config->get('config_name'),
		));
		$data['stores'] = $stores;

		// custom fields
		$this->load->model('customer/custom_field');
		$custom_fields = $this->model_customer_custom_field->getCustomFields();

		$data['custom_fields'] = array(
			'account' => array(),
			'address' => array(),
		);

		foreach ($custom_fields as $custom_field) {
			$data['custom_fields'][$custom_field['location']][] = array(
				'label' => $custom_field['name'],
				'value' => $custom_field['custom_field_id'],
			);
		}

		// customer groups
		$this->load->model('customer/customer_group');
		$customer_groups = $this->model_customer_customer_group->getCustomerGroups();

		$data['customer_groups'] = array();
		foreach ($customer_groups as $customer_group) {
			$data['customer_groups'][] = array(
				'customer_group_id' => $customer_group['customer_group_id'],
				'name'              => $customer_group['name'],
			);
		}

		// available languages
		$this->load->model('localisation/language');
		$data['languages'] = array_values($this->model_localisation_language->getLanguages());
		$data['default_language'] = $this->config->get('config_language_id');

		// tax classes
		$this->load->model('localisation/tax_class');

		$tax_classes = $this->model_localisation_tax_class->getTaxClasses();

		array_unshift($tax_classes, array(
			'tax_class_id' => '',
			'title'        => 'None',
		));

		$data['tax_classes'] = $tax_classes;

		// fonts
		$data['fonts']['system'] = json_decode(file_get_contents(DIR_SYSTEM . 'library/journal3/data/fonts/system.json'), true);
		$data['fonts']['google'] = json_decode(file_get_contents(DIR_SYSTEM . 'library/journal3/data/fonts/google.json'), true);

		// icons
		if (is_file(DIR_CATALOG . 'view/theme/journal3/icons_custom/style.css')) {
			$icons = 'icons_custom';
		} else {
			$icons = 'icons';
		}

		$data['icons'] = array();

		if (is_file(DIR_CATALOG . 'view/theme/journal3/' . $icons . '/selection.json')) {
			$selection = json_decode(file_get_contents(DIR_CATALOG . 'view/theme/journal3/' . $icons . '/selection.json'), true);

			foreach (Arr::get($selection, 'icons', array()) as $icon) {
				$classes = explode(',', $icon['properties']['name']);
				$name = trim($classes[0]);
				$code = $icon['properties']['code'];

				if ($name !== 'youtube22') {
					$data['icons'][] = array(
						'name' => $name,
						'code' => dechex($code),
					);
				}
			}
		}

		// variables
		$data['variables'] = $this->model_journal3_journal3->getVariables();

		// styles
		$data['styles'] = $this->model_journal3_journal3->getStyles();

		// modules
		$data['modules'] = $this->model_journal3_journal3->getModules();

		// filters
		$data['attributes'] = $this->model_journal3_journal3->getAllAttributes();
		$data['options'] = $this->model_journal3_journal3->getAllOptions();
		$data['filters'] = $this->model_journal3_journal3->getAllFilters();

		// authors
		$data['authors'] = $this->model_journal3_journal3->authors();

		// payments
		$data['payment_methods'] = $this->model_journal3_journal3->getPaymentMethods();

		// response
		$this->response->addHeader('Content-Type: application/javascript');
		$this->response->setOutput($this->load->view('journal3/js', array('data' => $data)));
	}

	public function get_variable() {
		return $this->renderJson(self::SUCCESS, $this->model_journal3_journal3->getVariables());
	}

	public function get_style() {
		return $this->renderJson(self::SUCCESS, $this->model_journal3_journal3->getStyles());
	}

	public function get_module() {
		return $this->renderJson(self::SUCCESS, $this->model_journal3_journal3->getModules());
	}

	public function get_skins() {
		$this->load->model('journal3/skin');

		return $this->renderJson(self::SUCCESS, $this->model_journal3_skin->all());
	}

	public function search() {
		// load system settings for attribute separator
		$this->load->model('journal3/setting');

		$settings = $this->model_journal3_setting->get(0, array('system'));

		$this->journal3->settings->load(Arr::get($settings, 'system', array()));

		try {
			$type = $this->input(self::GET, 'type');
			$keyword = $this->input(self::GET, 'keyword', '');
			$id = $this->input(self::GET, 'id', '');

			$results = array();

			switch ($type) {
				case 'product':
					$results = $this->model_journal3_journal3->getProducts($keyword, $id);
					break;

				case 'category':
					$results = $this->model_journal3_journal3->getCategories($keyword, $id);
					break;

				case 'manufacturer':
					$results = $this->model_journal3_journal3->getManufacturers($keyword, $id);
					break;

				case 'information':
					$results = $this->model_journal3_journal3->getInformations($keyword, $id);
					break;

				case 'attribute':
					$results = $this->model_journal3_journal3->getAttributes($keyword, $id);
					break;

				case 'option':
					$results = $this->model_journal3_journal3->getOptions($keyword, $id);
					break;

				case 'filter':
					$results = $this->model_journal3_journal3->getFilters($keyword, $id);
					break;

				case 'blog_category':
					$results = $this->model_journal3_journal3->getBlogCategories($keyword, $id);
					break;

				case 'blog_post':
					$results = $this->model_journal3_journal3->getBlogPosts($keyword, $id);
					break;

				default:
					if ($id) {
						$result = $this->model_journal3_module->get($id);
						$results = array(
							array(
								'id'   => $id,
								'name' => Arr::get($result, 'general.name'),
							),
						);
					} else {
						$result = $this->model_journal3_module->all(array(
							'type' => $type,
							'name' => $keyword,
						));
						$results = $result['items'];
					}
					break;
			}

			array_walk($results, function (&$result) {
				$result['name'] = strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'));
			});

			if ($id && !$results) {
//				throw new \Exception(sprintf("ID %s not found!", $id));
			}

			$this->renderJson(self::SUCCESS, $results);
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function layouts() {
		$this->load->model('design/layout');

		$layouts = array_map(function ($layout) {
			return array('id' => $layout['layout_id'], 'name' => $layout['name']);
		}, $this->model_design_layout->getLayouts());

		return $this->renderJson(self::SUCCESS, $layouts);
	}

	public function clear_cache() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/journal3')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$this->journal3->cache->delete();

			$this->journal3->minifier->clearCache();

			$this->renderJson(self::SUCCESS);
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

}
