<?php

namespace Journal3;

use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class Settings {

	private $settings = array();

	public function all() {
		return $this->settings;
	}

	public function load($values) {
		$this->settings = array_merge($this->settings, $values);
	}

	public function set($key, $value) {
		$this->settings[$key] = $value;
	}

	public function get($key, $default = null) {
		return Arr::get($this->settings, $key, $default);
	}

	public function getWith($key, $default = null, $default2 = null) {
		$value = Arr::get($this->settings, $key, $default);

		if (!$value) {
			$value = $default2;
		}

		return $value;
	}

	public function getIn($key, $context, $default = null) {
		return Arr::get($context, 'module' . $key, $this->get('global' . $key, $default));
	}

	public function getWithValue($key, $value) {
		$key = $this->get($key);

		if (Str::contains($key, '%s')) {
			return str_replace('%s', $value, $key);
		}

		return $key . ' ' . $value;
	}

}
