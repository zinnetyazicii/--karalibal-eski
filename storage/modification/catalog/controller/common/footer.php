<?php
class ControllerCommonFooter extends Controller {
	public function index() {

            if (defined('JOURNAL3_ACTIVE') && !$this->journal3->document->isPopup()) {
                $this->journal3->settings->set('desktop_main_menu', $this->load->controller('journal3/main_menu', array('module_type' => 'main_menu', 'module_id' => $this->journal3->settings->get('headerMainMenu'), 'id' => 'main-menu')));
                $this->journal3->settings->set('desktop_main_menu_2', $this->load->controller('journal3/main_menu', array('module_type' => 'main_menu', 'module_id' => $this->journal3->settings->get('headerMainMenu2'), 'id' => 'main-menu-2')));
                $this->journal3->settings->set('desktop_top_menu', $this->load->controller('journal3/top_menu', array('module_type' => 'top_menu', 'module_id' => $this->journal3->settings->get('headerTopMenu'))));
                $this->journal3->settings->set('desktop_top_menu_2', $this->load->controller('journal3/top_menu', array('module_type' => 'top_menu', 'module_id' => $this->journal3->settings->get('headerTopMenu2'))));
                $this->journal3->settings->set('desktop_top_menu_3', $this->load->controller('journal3/top_menu', array('module_type' => 'top_menu', 'module_id' => $this->journal3->settings->get('headerTopMenu3'))));

                if ($this->journal3->document->hasClass('mobile-header-active')) {
                    $this->journal3->settings->set('mobile_main_menu', $this->load->controller('journal3/main_menu', array('module_type' => 'main_menu', 'module_id' => $this->journal3->settings->get('headerMobileMainMenu'))));
                }

                $this->journal3->settings->set('mobile_top_menu', $this->load->controller('journal3/top_menu', array('module_type' => 'top_menu', 'module_id' => $this->journal3->settings->get('headerMobileTopMenu'))));

                $data['footer_menu'] = $this->load->controller('journal3/footer_menu', array('module_type' => 'footer_menu', 'module_id' => $this->journal3->settings->get('footerMenu')));
            }
            
		$this->load->language('common/footer');

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach (defined('JOURNAL3_ACTIVE') ? array() : $this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}

		$data['contact'] = $this->url->link('information/contact');
		$data['return'] = $this->url->link('account/return/add', '', true);
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['tracking'] = $this->url->link('information/tracking');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', true);
		$data['affiliate'] = $this->url->link('affiliate/login', '', true);
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['newsletter'] = $this->url->link('account/newsletter', '', true);

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = ($this->request->server['HTTPS'] ? 'https://' : 'http://') . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}

		$data['scripts'] = $this->document->getScripts('footer');
		$data['styles'] = $this->document->getStyles('footer');
		
		return $this->load->view('common/footer', $data);
	}
}
