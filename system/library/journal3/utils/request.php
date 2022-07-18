<?php

namespace Journal3\Utils;

class Request {

	public static function isGet() {
		return strtolower(Arr::get($_SERVER, 'REQUEST_METHOD')) === 'get';
	}

	public static function isPost() {
		return strtolower(Arr::get($_SERVER, 'REQUEST_METHOD')) === 'post';
	}

	public static function isAjax() {
		return strtolower(Arr::get($_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest';
	}

	public static function isAdminRequest() {
		return Arr::get($_GET, 'jf') === '1';
	}

	public static function isHttps() {
		return (bool)Arr::get($_SERVER, 'HTTPS');
	}

	public static function getCurrentUrl() {
		return static::getHost() . $_SERVER['REQUEST_URI'];
	}

	public static function getHost() {
		return (static::isHttps() ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
	}

	public static function matches($ignored_routes) {
		$route = Arr::get($_GET, 'route', Arr::get($_GET, '_route_'));

		if (!$route) {
			return false;
		}

		foreach ($ignored_routes as $ignored_route) {
			if (Str::startsWith($route, $ignored_route)) {
				return true;
			}
		}

		return false;
	}

	public static function header_sent($header) {
		$headers = headers_list();
		$header = trim($header, ': ');

		foreach ($headers as $hdr) {
			if (stripos($hdr, $header) !== false) {
				return true;
			}
		}

		return false;
	}

	public static function hasWebpSupport() {
		static $result = null;

		if ($result === null) {
			$result = strpos(Arr::get($_SERVER, 'HTTP_ACCEPT'), 'image/webp') !== false || strpos(Arr::get($_SERVER, 'HTTP_USER_AGENT'), ' Chrome/') !== false;
		}

		return $result;
	}

	public static function hasRequestHeader($header_name, $header_value = null) {
		if (strtolower(Arr::get($_SERVER, strtoupper($header_name))) === strtolower($header_value)) {
			return true;
		}

		return false;
	}

	public static function hasResponseHeader($header_name, $header_value = null) {
		$headers = headers_list();

		foreach ($headers as $header) {
			$header = explode(':', $header);
			if (count($header) === 2) {
				$name = trim($header[0]);
				$value = trim($header[1]);

				if (strtolower($header_name) === strtolower($name) && stripos($value, $header_value) !== false) {
					return true;
				}
			}
		}

		return false;
	}

}
