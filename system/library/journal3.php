<?php

use Journal3\Cache;
use Journal3\Document;
use Journal3\Minifier;
use Journal3\Settings;
use Journal3\Utils\Arr;
use Journal3\Utils\Html;
use Journal3\Utils\Request;
use Journal3\Utils\Str;

define('JOURNAL3_VERSION', '3.1.8');

if (!defined('JOURNAL3_OC_VERSION')) {
	if (!defined('VERSION')) {
		define('JOURNAL3_OC_VERSION', null);
	} else if (version_compare(VERSION, '3.1', '>=')) {
		define('JOURNAL3_OC_VERSION', Journal3::OC_31);
	} else if (version_compare(VERSION, '3', '>=')) {
		define('JOURNAL3_OC_VERSION', Journal3::OC_3);
	} else if (version_compare(VERSION, '2', '>=')) {
		define('JOURNAL3_OC_VERSION', Journal3::OC_2);
	} else if (version_compare(VERSION, '1.5.5.1', '>=')) {
		define('JOURNAL3_OC_VERSION', Journal3::OC_1);
	} else {
		define('JOURNAL3_OC_VERSION', null);
	}
}

final class Journal3 {

	const OC_1 = 10;
	const OC_2 = 20;
	const OC_3 = 30;
	const OC_31 = 31;

	/** @var \Registry */
	private $registry;

	/** @var \Journal3 */
	private static $instance;

	/** @var Cache */
	public $cache;

	/** @var \Journal3\Minifier */
	public $minifier;

	/** @var \Journal3\Settings */
	public $settings;

	/** @var Document */
	public $document;

	private static $base_href = null;
	private $language_code = null;
	private $language_id = null;
	private $currency_id = null;
	private $store_id = null;
	private $product_data = array();

	public function __construct($registry) {
		if (self::$instance !== null) {
			die('Journal3 Class Already instantiated!');
		}

		self::$instance = $this;

		$this->registry = $registry;
		$this->cache = new Cache();
		$this->minifier = new Minifier();
		$this->settings = new Settings();
		$this->document = new Document();

		$this->language_code = $registry->get('language')->get('code');
	}

	public static function getInstance() {
		return self::$instance;
	}

	public function constant($name) {
		return defined($name) ? constant($name) : '';
	}

	public function getRegistry() {
		return $this->registry;
	}

	public function getLanguageId() {
		if ($this->language_id === null) {
			$this->language_id = (int)$this->config('config_language_id');
		}

		return $this->language_id;
	}

	public function getCurrencyId() {
		if ($this->currency_id === null) {
			$this->currency_id = Arr::get($this->registry->get('session')->data, 'currency', $this->config('config_currency'));
		}

		return $this->currency_id;
	}

	public function getStoreId() {
		if ($this->store_id === null) {
			$this->store_id = (int)$this->config('config_store_id');
		}

		return $this->store_id;
	}

	public function staticAssetUrl($url) {
		return self::$base_href . $url;
	}

	public function config($key) {
		return $this->registry->get('config')->get($key);
	}

	public function themeConfig($key) {
		return $this->registry->get('config')->get('theme_journal3_' . $key);
	}

	public function loadController($route, $args = array()) {
		return $this->registry->get('load')->controller($route, $args);
	}

	public function loadView($route, $data = array()) {
		return $this->registry->get('load')->view($route, $data);
	}

	public function currencyFormat($number) {
		return $this->registry->get('currency')->format($number, $this->registry->get('session')->data['currency']);
	}

	public function isCustomer() {
		return Arr::get($this->registry->get('session')->data, 'customer_id') > 0;
	}

	public function getCustomerGroupId() {
		if ($this->isCustomer()) {
			return $this->registry->get('customer')->getGroupId();
		}

		return $this->registry->get('config')->get('config_customer_group_id');
	}

	public function isRTL() {
		return $this->registry->get('language')->get('direction') === 'rtl';
	}

	public function isAdmin() {
		return Arr::get($this->registry->get('session')->data, 'user_id') > 0;
	}

	public function isOC1() {
		return JOURNAL3_OC_VERSION === self::OC_1;
	}

	public function isOC2() {
		return JOURNAL3_OC_VERSION === self::OC_2;
	}

	public function isOC3() {
		return JOURNAL3_OC_VERSION === self::OC_3 || JOURNAL3_OC_VERSION === self::OC_31;
	}

	public function isOC31() {
		return JOURNAL3_OC_VERSION === self::OC_31;
	}

	public function isDev() {
		return JOURNAL3_ENV === 'development';
	}

	public function isLocalhost() {
		return in_array(Arr::get($_SERVER, 'SERVER_NAME'), array('127.0.0.1', '::1', 'localhost'));
	}

	public function canLiveReload() {
		return $this->isDev() && !Request::isHttps() && ($this->isLocalhost() || Str::startsWith($this->getHost(), '192.'));
	}

	public function getHost() {
		return parse_url(Request::getHost(), PHP_URL_HOST);
	}

	public function uniqueId($prefix = '') {
		return uniqid($prefix);
	}

	public function countBadge($text, $count, $classes = array()) {
		return Html::countBadge($text, $count, $classes);
	}

	public function classes($classes) {
		return Html::classes($classes);
	}

	public function linkAttrs($link) {
		$attrs = Arr::get($link, 'attrs');

		return $attrs ? implode(' ', $attrs) : null;
	}

	public function imageToBase64($image) {
		$type = pathinfo($image, PATHINFO_EXTENSION);
		$data = file_get_contents($image);

		return 'data:image/' . $type . ';base64,' . base64_encode($data);
	}

	public function productStat($result, $stat) {
		$label = null;
		$text = null;

		switch ($stat) {
			case 'brand':
				$label = $this->settings->get('productPageStyleProductManufacturerText');
				$text = $result['manufacturer'] ? '<a href="' . $this->registry->get('url')->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id']) . '">' . $result['manufacturer'] . '</a>' : null;
				break;

			case 'model':
				$label = $this->settings->get('productPageStyleProductModelText');
				$text = $result['model'];
				break;

			case 'sku':
				$label = $this->settings->get('productPageStyleProductSKUText');
				$text = $result['sku'];
				break;

			case 'upc':
				$label = $this->settings->get('productPageStyleProductUPCText');
				$text = $result['upc'];
				break;

			case 'ean':
				$label = $this->settings->get('productPageStyleProductEANText');
				$text = $result['ean'];
				break;

			case 'jan':
				$label = $this->settings->get('productPageStyleProductJANText');
				$text = $result['jan'];
				break;

			case 'isbn':
				$label = $this->settings->get('productPageStyleProductISBNText');
				$text = $result['isbn'];
				break;

			case 'mpn':
				$label = $this->settings->get('productPageStyleProductMPNText');
				$text = $result['mpn'];
				break;

			case 'location':
				$label = $this->settings->get('productPageStyleProductLocationText');
				$text = $result['location'];
				break;

			case 'weight':
				$label = $this->settings->get('productPageStyleProductWeightText');
				$text = $this->registry->get('weight')->format($result['weight'], $result['weight_class_id']);
				break;

			case 'dimension':
				$length = $this->registry->get('length')->format($result['length'], $result['length_class_id']);
				$width = $this->registry->get('length')->format($result['width'], $result['length_class_id']);
				$height = $this->registry->get('length')->format($result['height'], $result['length_class_id']);
				$label = $this->settings->get('productPageStyleProductDimensionText');
				$text = "{$length} x {$width} x {$height}";
				break;

			case 'reward':
				$label = $this->settings->get('productPageStyleProductRewardText');
				$text = $result['reward'];
				break;

			case 'points':
				$label = $this->settings->get('productPageStyleProductPointsText');
				$text = $result['points'];
				break;

			case 'stock':
				$label = $this->settings->get('productPageStyleProductStockText');
				if ($result['quantity'] > 0) {
					if (!($text = Arr::get($result, 'in_stock_status'))) {
						$text = $this->settings->get('productPageStyleProductInStockText');
					}
				} else {
					$text = $result['stock_status'];
				}
				break;

			case 'quantity':
				$label = $this->settings->get('productPageStyleProductStockText');
				$text = $result['quantity'];
				break;

		}

		if ($label && $text) {
			return array(
				'label' => $label,
				'text'  => $text,
			);
		}

		return null;
	}

	public function setProductData($type, $data) {
		$this->product_data[$type] = $data;
	}

	public function productLabels($result, $price, $special) {
		$results = array();

		$label_ids = Arr::get($this->product_data, 'product_label.all', array());

		foreach ($label_ids as $label_id) {
			$results[$label_id] = Arr::get($this->product_data, 'product_label.data.' . $label_id . '.php');
		}

		$label_ids = Arr::get($this->product_data, 'product_label.custom.' . $result['product_id'], array());

		foreach ($label_ids as $label_id) {
			$results[$label_id] = Arr::get($this->product_data, 'product_label.data.' . $label_id . '.php');
		}

		if ($special) {
			$label_ids = Arr::get($this->product_data, 'product_label.special', array());

			foreach ($label_ids as $label_id) {
				$label = Arr::get($this->product_data, 'product_label.data.' . $label_id . '.php');

				if ((float)$result['price']) {
					$label['label'] = '-' . round(($result['price'] - $result['special']) / $result['price'] * 100) . ' %';
				} else {
					$label['label'] = '-100' . ' %';
				}

				$results[$label_id] = $label;
			}
		}

		if ($result['quantity'] <= 0) {
			$label_ids = Arr::get($this->product_data, 'product_label.outofstock', array());

			foreach ($label_ids as $label_id) {
				$label = Arr::get($this->product_data, 'product_label.data.' . $label_id . '.php');

				$label['label'] = $result['stock_status'];

				$results[$label_id] = $label;
			}
		}

		return $results;
	}

	public function productExcludeButton($result, $price, $special) {
		$results = array();

		$extra_button_ids = Arr::get($this->product_data, 'product_exclude_button.all', array());

		foreach ($extra_button_ids as $extra_button_id) {
			$data = Arr::get($this->product_data, 'product_exclude_button.data.' . $extra_button_id . '.php');

			if ($data) {
				if ($data['excludeCart']) {
					$results['hide-cart'] = true;
				}

				if ($data['excludeWishlist']) {
					$results['hide-wishlist'] = true;
				}

				if ($data['excludeCompare']) {
					$results['hide-compare'] = true;
				}
			}
		}

		$extra_button_ids = Arr::get($this->product_data, 'product_exclude_button.custom.' . $result['product_id'], array());

		foreach ($extra_button_ids as $extra_button_id) {
			$data = Arr::get($this->product_data, 'product_exclude_button.data.' . $extra_button_id . '.php');

			if ($data) {
				if ($data['excludeCart']) {
					$results['hide-cart'] = true;
				}

				if ($data['excludeWishlist']) {
					$results['hide-wishlist'] = true;
				}

				if ($data['excludeCompare']) {
					$results['hide-compare'] = true;
				}
			}
		}

		if ($special) {
			$extra_button_ids = Arr::get($this->product_data, 'product_exclude_button.special', array());

			foreach ($extra_button_ids as $extra_button_id) {
				$data = Arr::get($this->product_data, 'product_exclude_button.data.' . $extra_button_id . '.php');

				if ($data) {
					if ($data['excludeCart']) {
						$results['hide-cart'] = true;
					}

					if ($data['excludeWishlist']) {
						$results['hide-wishlist'] = true;
					}

					if ($data['excludeCompare']) {
						$results['hide-compare'] = true;
					}
				}
			}
		}

		if ($result['quantity'] <= 0) {
			$extra_button_ids = Arr::get($this->product_data, 'product_exclude_button.outofstock', array());

			foreach ($extra_button_ids as $extra_button_id) {
				$data = Arr::get($this->product_data, 'product_exclude_button.data.' . $extra_button_id . '.php');

				if ($data) {
					if ($data['excludeCart']) {
						$results['hide-cart'] = true;
					}

					if ($data['excludeWishlist']) {
						$results['hide-wishlist'] = true;
					}

					if ($data['excludeCompare']) {
						$results['hide-compare'] = true;
					}
				}
			}
		}

		return implode(' ', array_keys($results));
	}

	public function productExtraButton($result, $price, $special) {
		$results = array();

		$extra_button_ids = Arr::get($this->product_data, 'product_extra_button.all', array());

		foreach ($extra_button_ids as $extra_button_id) {
			$results[$extra_button_id] = Arr::get($this->product_data, 'product_extra_button.data.' . $extra_button_id . '.php');
		}

		$extra_button_ids = Arr::get($this->product_data, 'product_extra_button.custom.' . $result['product_id'], array());

		foreach ($extra_button_ids as $extra_button_id) {
			$results[$extra_button_id] = Arr::get($this->product_data, 'product_extra_button.data.' . $extra_button_id . '.php');
		}

		if ($special) {
			$extra_button_ids = Arr::get($this->product_data, 'product_extra_button.special', array());

			foreach ($extra_button_ids as $extra_button_id) {
				$results[$extra_button_id] = Arr::get($this->product_data, 'product_extra_button.data.' . $extra_button_id . '.php');
			}
		}

		if ($result['quantity'] <= 0) {
			$extra_button_ids = Arr::get($this->product_data, 'product_extra_button.outofstock', array());

			foreach ($extra_button_ids as $extra_button_id) {
				$results[$extra_button_id] = Arr::get($this->product_data, 'product_extra_button.data.' . $extra_button_id . '.php');
			}
		}

		return array_slice($results, 0, 2, true);
	}

	public function productBlocks($result, $price, $special) {
		$results = array();

		$product_block_ids = Arr::get($this->product_data, 'product_blocks.all', array());

		foreach ($product_block_ids as $product_block_id) {
			$results[$product_block_id] = Arr::get($this->product_data, 'product_blocks.data.' . $product_block_id . '.php');
		}

		$product_block_ids = Arr::get($this->product_data, 'product_blocks.custom.' . $result['product_id'], array());

		foreach ($product_block_ids as $product_block_id) {
			$results[$product_block_id] = Arr::get($this->product_data, 'product_blocks.data.' . $product_block_id . '.php');
		}

		if ($special) {
			$product_block_ids = Arr::get($this->product_data, 'product_blocks.special', array());

			foreach ($product_block_ids as $product_block_id) {
				$results[$product_block_id] = Arr::get($this->product_data, 'product_blocks.data.' . $product_block_id . '.php');
			}
		}

		if ($result['quantity'] <= 0) {
			$product_block_ids = Arr::get($this->product_data, 'product_blocks.outofstock', array());

			foreach ($product_block_ids as $product_block_id) {
				$results[$product_block_id] = Arr::get($this->product_data, 'product_blocks.data.' . $product_block_id . '.php');
			}
		}

		return $results;
	}

	public function productTabs($result, $price, $special) {
		$results = array();

		$product_tab_ids = Arr::get($this->product_data, 'product_tabs.all', array());

		foreach ($product_tab_ids as $product_tab_id) {
			$results[$product_tab_id] = Arr::get($this->product_data, 'product_tabs.data.' . $product_tab_id . '.php');
		}

		$product_tab_ids = Arr::get($this->product_data, 'product_tabs.custom.' . $result['product_id'], array());

		foreach ($product_tab_ids as $product_tab_id) {
			$results[$product_tab_id] = Arr::get($this->product_data, 'product_tabs.data.' . $product_tab_id . '.php');
		}

		if ($special) {
			$product_tab_ids = Arr::get($this->product_data, 'product_tabs.special', array());

			foreach ($product_tab_ids as $product_tab_id) {
				$results[$product_tab_id] = Arr::get($this->product_data, 'product_tabs.data.' . $product_tab_id . '.php');
			}
		}

		if ($result['quantity'] <= 0) {
			$product_tab_ids = Arr::get($this->product_data, 'product_tabs.outofstock', array());

			foreach ($product_tab_ids as $product_tab_id) {
				$results[$product_tab_id] = Arr::get($this->product_data, 'product_tabs.data.' . $product_tab_id . '.php');
			}
		}

		return $results;
	}

	public function productSecondImage($result) {
		return Arr::get($this->product_data, 'second_image.' . $result['product_id']);
	}

	public function productCountdown($result) {
		return Arr::get($this->product_data, 'countdown.' . $result['product_id']);
	}

	public function carousel($options, $key) {
		return array(
			'speed'        => (int)Arr::get($options, "${key}Speed"),
			'autoplay'     => (bool)Arr::get($options, "${key}AutoPlay") ? array(
				'delay' => (int)Arr::get($options, "${key}Delay"),
			) : false,
			'pauseOnHover' => (bool)Arr::get($options, "${key}PauseOnHover"),
			'loop'         => (bool)Arr::get($options, "${key}Loop"),
		);
	}

	public function incl($file) {
		return modification(DIR_TEMPLATE . 'journal3/template/' . $file);
	}

	public function isDescriptionEmpty($description) {
		return !trim(strip_tags($description, '<img><iframe>'));
	}

	public function blog_date($date) {
		$format = $this->settings->getWith('blogDateFormat', null, 'd \<\i\>M\<\/\i\>');
		$format_intl = $this->settings->get('blogDateFormatIntl', null);

		if (!$format_intl || !class_exists('\IntlDateFormatter') || !class_exists('\IntlCalendar')) {
			return date($format, strtotime($date));
		}

		return \IntlDateFormatter::formatObject(\IntlCalendar::fromDateTime($date), $format_intl, $this->language_code);
	}

}
