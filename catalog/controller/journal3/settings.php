<?php

use Journal3\Cache;
use Journal3\Opencart\Controller;
use Journal3\Options\Option;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;
use Journal3\Utils\Img;
use Journal3\Utils\Request;

class ControllerJournal3Settings extends Controller {

	public function index() {
		Parser::setConfig('admin', $this->journal3->isAdmin());
		Parser::setConfig('language_id', $this->journal3->getLanguageId());
		Parser::setConfig('currency_id', $this->journal3->getCurrencyId());
		Parser::setConfig('rtl', $this->language->get('direction') === 'rtl');
		Parser::setConfig('device', $this->journal3->document->getDevice());
		Parser::setConfig('customer', $this->journal3->isCustomer());
		Parser::setConfig('customer_group_id', $this->journal3->getCustomerGroupId());
		Parser::setConfig('store_id', $this->journal3->getStoreId());
		Parser::setConfig('default_language_id', $this->config->get('config_default_language_id'));

		$cart_count = $this->cart->countProducts();

		if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');
			$wishlist_count = $this->model_account_wishlist->getTotalWishlist();
		} else {
			$wishlist_count = isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0;
		}

		$compare_count = isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0;

		Cache::setConfig('admin', $this->journal3->isAdmin());
		Cache::setConfig('language_id', $this->journal3->getLanguageId());
		Cache::setConfig('currency_id', $this->journal3->getCurrencyId());
		Cache::setConfig('store_id', $this->journal3->getStoreId());
		Cache::setConfig('device', $this->journal3->document->getDevice());
		Cache::setConfig('customer', $this->journal3->isCustomer());
		Cache::setConfig('customer_group_id', $this->journal3->getCustomerGroupId());
		Cache::setConfig('customer_firstname', $this->customer->getFirstName());
		Cache::setConfig('customer_lastname', $this->customer->getLastName());
		Cache::setConfig('cart', $cart_count);
		Cache::setConfig('wishlist', $wishlist_count);
		Cache::setConfig('compare', $compare_count);
		Cache::setConfig('webp', Request::hasWebpSupport() && Img::canOptimise()['cwebp'] ? 1 : 0);

		$this->_cache_key = 'settings';

		if ($this->_cache === false) {
			$variables = $this->model_journal3_settings->getVariables();
			$settings = $this->model_journal3_settings->getSettings();

			Option::setVariables($variables);

			$cache = array(
				'variables' => $variables,
				'php'       => array(),
				'js'        => array(),
				'fonts'     => array(),
				'css'       => '',
			);

			// settings
			$files = array(
				'system/system',

				'settings/active_skin',
				'settings/blog',
				'settings/custom_code',
				'settings/general',
				'settings/performance',
				'settings/seo',
			);

			$parser = new Parser($files, $settings);

			$cache['php'] += $parser->getPhp();
			$cache['js'] += $parser->getJs();
			$fonts = $parser->getFonts();
			$cache['fonts'] = Arr::merge($cache['fonts'], $fonts);
			$cache['css'] .= $parser->getCss();

			$this->journal3->settings->set('performanceCompressImagesStatus', $parser->getSetting('performanceCompressImagesStatus'));

			// skin
			$files = array(
				'skin/blog/post',
				'skin/blog/posts',

				'skin/footer/general',

				'skin/global/countdown',
				'skin/global/general',
				'skin/global/notification',
				'skin/global/quickview',

				'skin/header/general',

				'skin/page/account',
				'skin/page/cart',
				'skin/page/category',
				'skin/page/checkout',
				'skin/page/compare',
				'skin/page/contact',
				'skin/page/information',
				'skin/page/maintenance',
				'skin/page/manufacturers',
				'skin/page/search',
				'skin/page/sitemap',
				'skin/page/wishlist',

				'skin/product/general',

				'skin/products/general',

				'skin/image_dimensions',

				'skin/catalog_mode',
			);

			$parser = new Parser($files, $settings);

			$cache['php'] += $parser->getPhp();
			$cache['js'] += $parser->getJs();
			$fonts = $parser->getFonts();
			$cache['fonts'] = Arr::merge($cache['fonts'], $fonts);
			$cache['css'] .= $parser->getCss();

			// footer mobile
			if ($this->journal3->document->isMobile()) {
				if ($data = Arr::get($cache, 'php.footerMenuPhone')) {
					$cache['php']['footerMenu'] = $data;
				}
			}

			// checkout link
			$cache['js']['checkoutUrl'] = $this->url->link('checkout/checkout', '', true);

			// set cache
			$this->_cache = $cache;
		} else {
			Option::setVariables($this->_cache['variables']);
		}

		$this->journal3->settings->load($this->_cache['php']);
		$this->journal3->document->addJs($this->_cache['js']);
		$this->journal3->document->addFonts($this->_cache['fonts']);
		$this->journal3->document->addCss($this->_cache['css']);

		$this->load->controller('journal3/layout/header');
		$this->load->controller('journal3/layout/footer');

		$this->journal3->document->addCss(strip_tags($this->load->view('journal3/css', array('data' => $this->journal3->settings->all()))));

		// image dimensions
		$image_dimensions = array_keys(json_decode(file_get_contents(DIR_SYSTEM . 'library/journal3/data/settings/skin/image_dimensions.json'), true));

		foreach ($image_dimensions as $image_dimension) {
			$dimensions = $this->journal3->settings->get($image_dimension);

			$this->config->set(str_replace('image_dimensions_', 'theme_journal3_image_', $image_dimension) . '_width', $dimensions['width']);
			$this->config->set(str_replace('image_dimensions_', 'theme_journal3_image_', $image_dimension) . '_height', $dimensions['height']);
		}

		// other settings
		$this->config->set('theme_journal3_product_limit', $this->journal3->settings->get('productLimit'));
		$this->config->set('theme_journal3_product_description_length', $this->journal3->settings->get('productDescriptionLimit'));

		// performance
		$ignored_routes = array(
			'account/',
			'checkout/',
			'journal3/checkout',
			'extension/payment/',
		);

		if (
			$this->journal3->settings->get('developerMode')
			|| !$this->journal3->settings->get('performanceMinifiersStatus')
			|| !Request::isGet()
			|| Request::matches($ignored_routes)
		) {
			$this->journal3->settings->set('performanceHTMLMinify', false);
			$this->journal3->settings->set('performanceCSSMinify', false);
			$this->journal3->settings->set('performanceCSSInline', false);
			$this->journal3->settings->set('performanceJSMinify', false);
			$this->journal3->settings->set('performanceJSDefer', false);
		}

		// disable defer on routes
		$ignored_routes = array(
			'checkout/'
		);

		if (Request::matches($ignored_routes)) {
			$this->journal3->settings->set('performanceJSDefer', false);
		}

		// cdn
		if ($this->journal3->settings->get('performanceCDNStatus')) {
			if (Request::isHttps()) {
				$static_url = $this->journal3->settings->get('performanceCDNHttps');
			} else {
				$static_url = $this->journal3->settings->get('performanceCDNHttp');
			}

			if ($static_url) {
				define('JOURNAL3_STATIC_URL', $static_url);
			}
		}

		// active skin + active store
		$this->journal3->document->addClass('store-' . $this->journal3->getStoreId());
		$this->journal3->document->addClass('skin-' . $this->journal3->settings->get('active_skin'));

		// boxed layout
		if ($this->journal3->settings->get('globalPageBoxedLayout') === 'boxed') {
			$this->journal3->document->addClass('boxed-layout');
		}

		// active header
		if ((($this->journal3->settings->get('mobileHeaderOn') === 'phone') && $this->journal3->document->isPhone()) || (($this->journal3->settings->get('mobileHeaderOn') === 'tablet') && $this->journal3->document->isMobile())) {
			$this->journal3->document->addClass('mobile-header-active');
		} else {
			$this->journal3->document->addClass('desktop-header-active');
		}

		// sticky header compact desktop
		if ($this->journal3->settings->get('stickyStatus') && in_array($this->journal3->settings->get('headerType'), array('slim', 'compact'))) {
			$this->journal3->document->addClass('compact-sticky');
		}

		// mobile sticky
		if ($this->journal3->settings->get('headerMobileStickyStatus')) {
			$this->journal3->document->addClass('mobile-sticky');
		}

		// logo
		if ($this->journal3->settings->get('logo')) {
			$logo = $this->journal3->settings->get('logo');
		} else {
			$logo = $this->config->get('config_logo');
		}

		if (is_file(DIR_IMAGE . $logo)) {
			list ($width, $height) = getimagesize(DIR_IMAGE . $logo);

			$this->journal3->settings->set('logo_width', $width);
			$this->journal3->settings->set('logo_height', $height);
			$this->journal3->settings->set('logo_src', $this->model_journal3_image->resize($logo));

			$logo2x = $this->journal3->settings->get('logo2x');

			if (is_file(DIR_IMAGE . $logo2x)) {
				$this->journal3->settings->set('logo2x_src', $this->model_journal3_image->resize($logo2x));
			} else {
				$this->journal3->settings->set('logo2x_src', false);
			}

			if ($this->journal3->document->isMobile()) {
				$logoMobile2x = $this->journal3->settings->get('logoMobile2x');

				if (is_file(DIR_IMAGE . $logoMobile2x)) {
					$this->journal3->settings->set('logo2x_src', $this->model_journal3_image->resize($logoMobile2x));
				}
			}
		} else {
			$this->journal3->settings->set('logo_src', false);
		}

		// default view
		if (isset($this->request->cookie['view'])) {
			$this->journal3->settings->set('globalProductView', $this->request->cookie['view']);
		}

		// old browser
		if ($this->journal3->settings->get('oldBrowserStatus') && $this->journal3->document->hasClass('ie') && !$this->journal3->document->hasClass('edge')) {
			$this->journal3->settings->set('oldBrowserChrome', $this->model_journal3_image->resize('catalog/journal3/misc/chrome.png'));
			$this->journal3->settings->set('oldBrowserFirefox', $this->model_journal3_image->resize('catalog/journal3/misc/firefox.png'));
			$this->journal3->settings->set('oldBrowserEdge', $this->model_journal3_image->resize('catalog/journal3/misc/edge.png'));
			$this->journal3->settings->set('oldBrowserOpera', $this->model_journal3_image->resize('catalog/journal3/misc/opera.png'));
			$this->journal3->settings->set('oldBrowserSafari', $this->model_journal3_image->resize('catalog/journal3/misc/safari.png'));
		} else {
			$this->journal3->settings->set('oldBrowserStatus', false);
		}

		// catalog mode
		if (!$this->journal3->settings->get('catalogLanguageStatus')) {
			$this->journal3->document->addClass('no-language');
		}

		if (!$this->journal3->settings->get('catalogCurrencyStatus')) {
			$this->journal3->document->addClass('no-currency');
		}

		if (!$this->journal3->settings->get('catalogSearchStatus')) {
			$this->journal3->document->addClass('no-search');
		}

		if (!$this->journal3->settings->get('catalogMiniCartStatus')) {
			$this->journal3->document->addClass('no-mini-cart');
		}

		if (!$this->journal3->settings->get('catalogCartStatus')) {
			$this->journal3->document->addClass('no-cart');
		}

		if (!$this->journal3->settings->get('catalogWishlistStatus')) {
			$this->journal3->document->addClass('no-wishlist');
		}

		if (!$this->journal3->settings->get('catalogCompareStatus')) {
			$this->journal3->document->addClass('no-compare');
		}

		// columns status on tablet
		if ($this->journal3->document->isTablet()) {
			if (!$this->journal3->settings->get('globalPageColumnLeftTabletStatus')) {
				$this->journal3->document->addClass('left-column-disabled');
			}

			if (!$this->journal3->settings->get('globalPageColumnRightTabletStatus')) {
				$this->journal3->document->addClass('right-column-disabled');
			}
		}

		// search page
		if ($this->journal3->settings->get('headerMiniSearchDisplay') === 'page') {
			$this->journal3->document->addClass('search-page');
		}

	}
}
