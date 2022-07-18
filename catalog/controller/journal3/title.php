<?php

use Journal3\Opencart\ModuleController;
use Journal3\Utils\Arr;

class ControllerJournal3Title extends ModuleController {

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		return array();
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		return array();
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		return array();
	}

	protected function beforeRender() {
		if ($this->settings['type'] === 'current') {
			$route = Arr::get($this->request->get, 'route');

			switch ($route) {
				case 'common/home':
					return null;


				case 'product/catalog':
					$this->settings['title'] = $this->journal3->settings->get('allProductsPageTitle');

					break;

				case 'information/information':
				case 'product/category':
				case 'product/manufacturer/info':
				case 'product/product':
				case 'journal3/blog':
				case 'journal3/blog/post':
					$this->settings['title'] = $this->load->controller('journal3/seo/getTags', array('title'));

					break;

				case 'product/special':
					$this->load->language('product/special');
					$this->settings['title'] = $this->language->get('heading_title');

					break;

				default:
					$this->settings['title'] = $this->language->get('heading_title');
			}

			if ($route === 'checkout/checkout' && $this->journal3->settings->get('activeCheckout') === 'journal') {
				$this->settings['title'] = $this->journal3->settings->get('checkoutTitle');
			}
		}

		// not to interfere with global .module-title
		$this->settings['classes']['1'] = 'title-module';
	}
}
