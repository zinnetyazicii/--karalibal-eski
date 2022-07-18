<?php

namespace Journal3;

use Journal3;
use Journal3\Utils\Arr;

class Document {

	private $device;
	private $classes = array();
	private $css = array();
	private $js = array();
	private $page_route;
	private $page_id;
	private $layout_id;
	private $scripts = array();
	private $styles = array();
	private $fonts = array();

	public function __construct() {
		$browser = new Browser();

		if ($browser->isBrowser(Browser::BROWSER_SAFARI)) {
			if (Arr::get(Journal3::getInstance()->getRegistry()->get('session')->data, 'j3_device') === 'ipad') {
				$browser->fixIpad();
			}
		}

		// detect device
		if ($browser->isMobile()) {
			$this->addClass('mobile');
			$this->addClass('phone');
			$this->addClass('touchevents');
			$this->device = 'phone';
		} else if ($browser->isTablet()) {
			$this->addClass('mobile');
			$this->addClass('tablet');
			$this->addClass('touchevents');
			$this->device = 'tablet';
		} else {
			$this->addClass('desktop');
			$this->device = 'desktop';
		}

		// platform
		switch ($browser->getPlatform()) {
			case Browser::PLATFORM_ANDROID:
				$this->addClass('android');
				break;
			case Browser::PLATFORM_APPLE:
				$this->addClass('mac');
				if ($browser->getBrowser() === Browser::BROWSER_SAFARI) {
					$this->addClass('apple');
				}
				break;
			case Browser::PLATFORM_IPAD:
				$this->addClass('ipad');
				$this->addClass('ios');
				$this->addClass('apple');
				break;
			case Browser::PLATFORM_IPHONE:
				$this->addClass('iphone');
				$this->addClass('ios');
				$this->addClass('apple');
				break;
			case Browser::PLATFORM_LINUX:
				$this->addClass('linux');
				break;
			case Browser::PLATFORM_WINDOWS:
				$this->addClass('win');
				break;
		}

		// browser detect
		$version = explode('.', $browser->getVersion());
		$version = is_array($version) && count($version) ? $version[0] : '';

		switch ($browser->getBrowser()) {
			case Browser::BROWSER_CHROME:
				$this->addClass('chrome');
				$this->addClass('chrome' . $version);
				$this->addClass('webkit');

				break;
			case Browser::BROWSER_FIREFOX:
				$this->addClass('firefox');
				$this->addClass('firefox' . $version);
				break;
			case Browser::BROWSER_EDGE;
				$this->addClass('edge');
				$this->addClass('ie');
				$this->addClass('ie' . $version);
				break;
			case Browser::BROWSER_IE:
				$this->addClass('ie');
				$this->addClass('ie' . $version);
				break;
			case Browser::BROWSER_OPERA:
				$this->addClass('opera');
				$this->addClass('opera' . $version);
				$this->addClass('webkit');
				break;
			case Browser::BROWSER_SAFARI:
			case Browser::BROWSER_IPHONE:
			case Browser::BROWSER_IPAD:
				$this->addClass('safari');
				$this->addClass('safari' . $version);
				$this->addClass('webkit');
				break;
			default:
				$this->addClass(strtolower(str_replace(' ', '', $browser->getBrowser())));
		}

		// oc version
		$this->addClass('oc' . JOURNAL3_OC_VERSION);

		// popup detect
		if (($popup = Arr::get($_GET, 'popup')) !== null) {
			$this->addClass('popup');
			$this->addClass('popup-' . $popup);
		}

		// default js classes
		$this->addJs(array(
			'isPopup'   => $this->isPopup(),
			'isPhone'   => $this->isPhone(),
			'isTablet'  => $this->isTablet(),
			'isDesktop' => $this->isDesktop(),
		));
	}

	public function addClass($class) {
		$class = htmlspecialchars(trim($class), ENT_COMPAT, 'UTF-8');
		$this->classes[$class] = $class;
	}

	public function getClasses() {
		return $this->classes;
	}

	public function hasClass($class) {
		$class = trim($class);

		return isset($this->classes[$class]);
	}

	public function removeClass($class) {
		$class = trim($class);

		if ($this->hasClass($class)) {
			unset($this->classes[$class]);
		}
	}

	public function isPhone() {
		return $this->hasClass('phone');
	}

	public function isTablet() {
		return $this->hasClass('tablet');
	}

	public function isMobile() {
		return $this->isPhone() || $this->isTablet();
	}

	public function isDesktop() {
		return $this->hasClass('desktop');
	}

	public function isPopup($name = null) {
		if ($name === null) {
			return $this->hasClass('popup');
		}

		return $this->hasClass('popup-' . $name);
	}

	public function addCss($css, $key = null) {
		if ($css) {
			$this->css[$key === null ? md5($css) : $key] = $css;
		}
	}

	public function getCss() {
		return implode(' ', $this->css);
	}

	public function addJs($js) {
		$this->js = array_merge_recursive($this->js, $js);
	}

	public function getJs() {
		return $this->js;
	}

	public function addFonts($fonts) {
		$this->fonts = Arr::merge($this->fonts, $fonts);
	}

	public function hasFonts() {
		return Arr::get($this->fonts, 'fonts');
	}

	public function getFonts($json) {
		$fonts = array();
		$subsets = implode(',', Arr::get($this->fonts, 'subsets', array()));

		foreach ($this->fonts['fonts'] as $family => $weights) {
			$family = str_replace(' ', '+', $family);

			if ($weights) {
				$weights = ':' . implode(',', $weights);
			}

			$fonts[] = $family . $weights;
		}

		if ($json) {
			if ($subsets) {
				array_walk($fonts, function (&$font) use ($subsets) {
					$font = $font . ':' . $subsets;
				});
			}

			if (Journal3::getInstance()->settings->get('performanceSwapFontsStatus') && $fonts) {
				$font = array_pop($fonts);
				$fonts[] = $font . '&display=block';
			}

			return json_encode($fonts);
		} else {
			$subsets = $subsets ? '&amp;subset=' . $subsets : '';
			$fonts = implode('%7C', $fonts);

			if (Journal3::getInstance()->settings->get('performanceSwapFontsStatus')) {
				return $fonts . $subsets . '&amp;display=block';
			}

			return $fonts . $subsets;
		}
	}

	public function setPageId($page_id) {
		$this->page_id = (int)$page_id;
	}

	public function setPageRoute($page_route) {
		$this->page_route = $page_route;
	}

	public function getPageId() {
		return $this->page_id;
	}

	public function getPageRoute() {
		return $this->page_route;
	}

	public function getDevice() {
		return $this->device;
	}

	public function setLayoutId($layout_id) {
		$this->layout_id = (int)$layout_id;
	}

	public function getLayoutId() {
		return $this->layout_id;
	}

	public function addStyle($href, $rel = 'stylesheet', $media = 'screen') {
		$this->styles[$href] = array(
			'href'  => $href,
			'rel'   => $rel,
			'media' => $media,
		);
	}

	public function getStyles($styles = array()) {
		$minify = Journal3::getInstance()->settings->get('performanceCSSMinify');

		$this->addStyle('catalog/view/theme/journal3/stylesheet/style.css');

		if (is_file(DIR_TEMPLATE . 'journal3/stylesheet/custom.css')) {
			$this->addStyle('catalog/view/theme/journal3/stylesheet/custom.css');
		}

		$styles = array_merge($this->styles, $styles);

		if ($minify) {
			$styles = array(
				Minifier::minifyStyles($styles),
			);
		}

		if (Journal3::getInstance()->settings->get('performanceCSSInline')) {
			foreach ($styles as &$style) {
				if (is_file($style['href'])) {
					$style['content'] = file_get_contents($style['href']);
				}
			}
		}

		return $styles;
	}

	public function addScript($href, $position = 'header') {
		$this->scripts[$position][$href] = $href;
	}

	public function getScripts($position = 'header', $scripts = array()) {
		$minify = Journal3::getInstance()->settings->get('performanceJSMinify');

		if ($position === 'footer') {
			$this->addScript('catalog/view/theme/journal3/js/common.js', 'footer');
			$this->addScript('catalog/view/theme/journal3/js/journal.js', 'footer');

			if (is_file(DIR_TEMPLATE . 'journal3/js/custom.js')) {
				$this->addScript('catalog/view/theme/journal3/js/custom.js');
			}

			if (Journal3::getInstance()->settings->get('performanceJSDefer')) {
				$this->addScript('catalog/view/theme/journal3/js/defer.js', 'footer');
			}
		}

		$scripts = array_merge($this->scripts[$position], $scripts);

		if (!$minify) {
			return $scripts;
		}

		return array(
			Minifier::minifyScripts($scripts),
		);
	}

	public function staticUrl($url, $cache = true) {
		if (Journal3\Utils\Str::startsWith($url, 'http')) {
			return $url;
		}

		$url = defined('JOURNAL3_STATIC_URL') ? JOURNAL3_STATIC_URL . $url : $url;

		if ($cache) {
			return $url;
		}

		if (Journal3::getInstance()->settings->get('performanceQueryStrings')) {
			if (Journal3::getInstance()->isDev()) {
				return $url . '?t=' . time();
			}

			return (strpos($url, '?') !== false ? $url . '&v=' : $url . '?v=') . (defined('JOURNAL3_BUILD') ? JOURNAL3_BUILD : JOURNAL3_VERSION);
		}

		return $url;
	}

}
