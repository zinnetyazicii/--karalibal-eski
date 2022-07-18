<?php

namespace Journal3\Options;

use Journal3;
use Journal3\Utils\Arr;

class Parserold {

	private $settings = array();
	private $css = array();
	private $js = array();
	private $php = array();
	private $fonts = array();

	public function __construct($files, $settings = array(), $prefix = null) {
		if (!is_array($files)) {
			$files = array($files);
		}

		$defaults = array();

		foreach ($files as $file) {
			$f = DIR_SYSTEM . 'library/journal3/data/settings/' . $file . '.json';

			if (!is_file($f)) {
				die('Error: File ' . $f . ' not found!');
			}

			$defaults = array_merge($defaults, json_decode(file_get_contents($f), true));
		}

		$this->parse($defaults, $settings);
	}

	private function parse($defaults, $settings) {
		foreach ($defaults as $name => $setting) {
			if (($include = Arr::get($setting, 'include')) !== null) {
				$f = DIR_SYSTEM . 'library/journal3/data/settings/common/' . $include . '.json';

				if (!is_file($f)) {
					die('Error: File ' . $f . ' not found!');
				}

				$defaults2 = json_decode(file_get_contents($f), true);
				$prefix = Arr::get($setting, 'prefix');

				$this->parse($defaults2, $settings);
			} else {
				$type = $setting['type'];

				$class = 'Journal3\\Options\\' . $type;

				if (!class_exists($class)) {
					$class = 'Journal3\\Options\\Option';
				}

				$setting['defaultValue'] = Arr::get($setting, 'value');

				if (isset($settings[$name])) {
					if (in_array($type, array('InputLang', 'ImageLang'))) {
						$setting['value'] = Arr::get($settings[$name], 'lang_' . Journal3::getInstance()->getLanguageId(), Arr::get($setting, 'value'));
					} else if ($type === 'Checkbox') {
						$setting['value'] = Arr::get($settings, $name);
					} else if (is_array($settings[$name])) {
						$setting['value'] = array_replace_recursive(Arr::get($setting, 'value', array()), $settings[$name]);
					} else {
						$setting['value'] = $settings[$name];
					}
				}

				$obj = new $class($setting);

				$value = $obj->value();
				$css = $obj->css();

				if (Arr::get($setting, 'php') === true) {
					$this->php[$name] = $value;
				}

				if (Arr::get($setting, 'js') === true) {
					$this->js[$name] = $value;
				}

				if ($css) {
					if ($setting['type'] === 'ItemsPerRow') {
						foreach ($css as $_css) {
							$this->addCss($_css, $value, $setting);
						}
					} else {
						$this->addCss($css, $value, $setting);
					}
				}

				foreach (Arr::get($setting, 'rules', array()) as $rule_value => $rules) {
					$_value = $value;
					if ($value === true) {
						$_value = 'on';
					} else if ($value === false) {
						$_value = 'off';
					}

					if (($setting['defaultValue'] !== $_value) && ($_value === $rule_value)) {
						foreach ($rules as $rk => $rv) {
							$this->addCss(array('media' => '_', 'selector' => $rk, 'properties' => array($rv)), $value, $setting);
						}
					}
				}

				foreach (Arr::get($settings, $name . '_multi', array()) as $multi_setting) {
					$setting['value'] = $multi_setting['value'];
					$obj = new $class($setting);

					$value = $obj->value();
					$css = $obj->css();

					if ($css) {
						$css['media'] = implode('_', array($multi_setting['min'], $multi_setting['max']));
						$this->addCss($css, $value, $setting);
					}

					foreach (Arr::get($setting, 'rules', array()) as $rule_value => $rules) {
						$_value = $value;
						if ($value === true) {
							$_value = 'on';
						} else if ($value === false) {
							$_value = 'off';
						}
						if ($_value === $rule_value) {
							foreach ($rules as $rk => $rv) {
								$this->addCss(array('media' => implode('_', array($multi_setting['min'], $multi_setting['max'])), 'selector' => $rk, 'properties' => array($rv)), $value, $setting);
							}
						}
					}
				}

				$this->settings[$name] = $value;
			}
		}
	}

	public function getSettings() {
		return $this->settings;
	}

	public function getSetting($key, $default = null) {
		return Arr::get($this->settings, $key, $default);
	}

	private function addCss($css, $value, $setting) {
		if (!isset($this->css[$css['media']])) {
			$this->css[$css['media']] = array();
		}

		if (!isset($this->css[$css['media']][$css['selector']])) {
			$this->css[$css['media']][$css['selector']] = array();
		}

		if (is_array($css['properties'])) {
			$this->css[$css['media']][$css['selector']] = array_merge($this->css[$css['media']][$css['selector']], $css['properties']);
		} else {
			$this->css[$css['media']][$css['selector']][] = $css['properties'];
		}
	}

	public function getCss($selector_params = array()) {
		$css = array();

		foreach ($this->css as $media => $selectors) {
			$_css = array();

			$media = explode('_', $media);

			$is_media = $media[0] !== '' || $media[1] !== '';

			foreach ($selectors as $selector => $properties) {
				if (count($properties)) {
					if ($selector_params) {
						$selector = call_user_func_array('sprintf', array_merge(array($selector), $selector_params));
					}
					$_css[] = $selector . " {\n\t" . implode($properties, "; \n\t") . "\n" . ($is_media ? "\t" : '') . "}" . ($is_media ? '' : "\n");
				}
			}

			if ($media[0] !== '' && $media[1] !== '') {
				$css[] = "@media (min-width: {$media[0]}px) and (max-width: {$media[1]}px) {";
				$css[] = " \t" . implode("\t", $_css);
				$css[] = "}\n";
			} else if ($media[0] !== '') {
				$css[] = "@media (min-width: {$media[0]}px) {";
				$css[] = " \t" . implode("\t", $_css);
				$css[] = "}\n";
			} else if ($media[1] !== '') {
				$css[] = "@media (max-width: {$media[1]}px) {";
				$css[] = "\t" . implode("\t", $_css);
				$css[] = "}\n";
			} else {
				$css[] = implode('', $_css);
			}
		}

		return implode("\n", $css);
	}

	public function getJs() {
		return $this->js;
	}

	public function getPhp() {
		return $this->php;
	}

	public function getFonts() {
		return $this->fonts;
	}

}
