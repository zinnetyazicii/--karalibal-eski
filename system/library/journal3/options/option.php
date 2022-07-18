<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class Option {

	protected static $variables;
	protected $data;
	protected $value;
	protected $css;

	public function __construct($data) {
		$selector = Arr::get($data, 'selector');
		$selector_prefix = Arr::get($data, 'selector_prefix');

		if ($selector || $selector_prefix) {
			$data['selector'] = static::parseSelector($selector_prefix, $selector);

			$selector_params = Arr::get($data, 'selector_params');

			if ($selector_params) {
				$count = substr_count($data['selector'], '%s');

				$selector_params2 = $selector_params;

				if ($count > 1) {
					for ($i = 0; $i < $count - 1; $i++) {
						$selector_params2 = array_merge($selector_params2, $selector_params);
					}
				}

				$data['selector'] = call_user_func_array('sprintf', array_merge(array($data['selector']), $selector_params2));
			}
		}

		$this->data = $data;
		$this->value = static::parseValue(Arr::get($data, 'value'), $data);
		$this->css = static::parseCss($this->value, $data);
	}

	final public function css() {
		return $this->css;
	}

	final public function value() {
		return $this->value;
	}

	protected static function parseValue($value, $data = null) {
		return $value;
	}

	protected static function addUnit($value, $unit = 'px') {
		return $value ? $value . $unit : $value;
	}

	protected static function parseCss($value, $data = null) {
		$rtl = Arr::get($data, 'config.rtl') === true;

		if (($value === null) || ($value === '')) {
			return null;
		}

		$selector = Arr::get($data, 'selector');

		if ($rtl) {
			$rules = Arr::get($data, 'rtlRules');

			if ($rules === null) {
				$rules = Arr::get($data, 'rules');
			}
		} else {
			$rules = Arr::get($data, 'rules');
		}

		if (!$selector && !$rules) {
			return null;
		}

		if ($temp = Arr::get($data, 'parent_selector')) {
			$selector = $temp . ' ' . $selector;
		}

		$devices = array();

		if (Arr::get($data, 'desktop') === true) {
			$devices[] = '.desktop';
		}

		if (Arr::get($data, 'tablet') === true) {
			$devices[] = '.tablet';
		}

		if (Arr::get($data, 'phone') === true) {
			$devices[] = '.phone';
		}

		if ($devices) {
			$selector = implode('', $devices) . ' ' . $selector;
		}

		if (is_array($value)) {
			$properties = $value;
		} else {
			if ($rtl) {
				$property = Arr::get($data, 'rtlProperty');

				if ($property === null) {
					$property = Arr::get($data, 'property');
				}
			} else {
				$property = Arr::get($data, 'property');
			}

			if (!$property && !$rules) {
				return null;
			}

			if ($property) {
				$properties = array($property => $value);
			} else {
				$properties = array();
			}
		}

		$result = array();
		$rules_result = array();

		if ($rules) {
			$rules = array_merge(Arr::get($rules, $value, array()), Arr::get($rules, '@', array()));

			$selector_params = Arr::get($data, 'selector_params');

			foreach ($rules as $rule_selector => $rule_properties) {
				if ($selector_params && strpos($rule_selector, '%s') !== false) {
					$rule_selector = call_user_func_array('sprintf', array_merge(array($rule_selector), $selector_params));
				}

				if (strpos($rule_properties, '%s') !== false) {
					$rules_result[static::parseSelector($selector, $rule_selector)][] = str_replace('%s', $value, $rule_properties);
				} else {
					$rules_result[static::parseSelector($selector, $rule_selector)][] = $rule_properties;
				}
			}
		}

		$important = Arr::get($data, 'important');

		foreach ($properties as $k => $v) {
			$p = static::parseCssValue($k, $v);

			if ($p) {
				if ($important) {
					$p .= ' !important';
				}

				$result[] = $p;
			}
		}

		if (!$result && !$rules_result) {
			return null;
		}

		return array(
			Arr::get($data, 'media', '_') => array_merge_recursive($rules_result, $selector && $result ? array(
				$selector => $result,
			) : array()),
		);
	}

	final protected static function parseCssValue($property, $value) {
		if ($value === '' || $value === null) {
			return null;
		}

		if (strpos($property, '%s') !== false) {
			return str_replace('%s', addslashes($value), $property);
		}

		// gradient trick
		if ($property === 'gradient') {
			return $value;
		}

		return $property . ': ' . $value;
	}

	public static function parseSelector($prefix, $selector) {
		if ($prefix && $selector && Str::contains($selector, ',')) {
			$selectors = explode(',', $selector);

			$result = array();

			foreach ($selectors as $selector) {
				$result[] = trim(str_replace(array('& ', ' &'), '', $prefix . ' ' . trim($selector)));
			}

			return implode(', ', $result);
		}

		return trim(str_replace(array('& ', ' &'), '', $prefix . ' ' . $selector));
	}

	public static function setVariables($variables) {
		self::$variables = $variables;
	}

	public static function getVariable($type, $value) {
		if (Str::startsWith($value, '__VAR__')) {
			$result = Arr::get(static::$variables, $type . '.' . $value);

			if ($result === null) {
				$result = Arr::get(static::$variables, $type . '.__VAR__DEFAULT');
			}
		} else {
			$result = null;
		}

		return $result;
	}

	public static function parseBreakpoint($value) {
		if (Str::startsWith($value, '__VAR__')) {
			$value = Arr::get(static::$variables, 'breakpoint.' . $value);
		}

		return $value;
	}

}
