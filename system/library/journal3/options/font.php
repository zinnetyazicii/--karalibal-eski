<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class Font extends Option {

	protected static function parseValue($value, $data = null) {
		$result = array();

		$variable = Arr::get($value, 'font-family');

		if ($variable && Str::startsWith($variable, '__VAR__')) {
			$variable = static::getVariable('font', $variable);

			if ($v = Arr::get($variable, 'type')) {
				$result['type'] = $v;
			}

			if ($v = Arr::get($variable, 'font-family')) {
				$result['font-family'] = $v;
			}

			if ($v = Arr::get($variable, 'font-weight')) {
				if ($v === 'regular') {
					$result['font-weight'] = '400';
				} else if ($v !== 'italic') {
					$result['font-weight'] = $v;
				}
			}

//			if ($v = Arr::get($variable, 'font-style')) {
//				$result['font-style'] = $v;
//			}

			if ($v = Arr::get($variable, 'subsets')) {
				$result['subsets'] = $v;
			}
		}

		if ($v = (int)InputValue::parseValue(Arr::get($value, 'font-size'), $data, 'font_size')) {
			$result['font-size'] = $v . 'px';
		}

		if ($v = Color::parseValue(Arr::get($value, 'color'))) {
			$result['color'] = $v;
		}

		if ($v = Arr::get($value, 'font-weight')) {
			$result['font-weight'] = $v;
		}

		if ($v = Arr::get($value, 'font-style')) {
			$result['font-style'] = $v;
		}

		if ($v = Arr::get($value, 'text-align')) {
			if (Arr::get($data, 'config.rtl') === true) {
				if ($v === 'left') {
					$v = 'right';
				} else if ($v === 'right') {
					$v = 'left';
				}
			}
			$result['text-align'] = $v;
		}

		if ($v = Arr::get($value, 'text-transform')) {
			$result['text-transform'] = $v;
		}

		if ($v = Arr::get($value, 'text-decoration')) {
			$result['text-decoration'] = $v;
		}

		if ($v = Arr::get($value, 'word-break')) {
			$result['word-break'] = $v;
		}

		if (($v = Option::parseValue(Arr::get($value, 'letter-spacing', ''))) !== '') {
			$result['letter-spacing'] = Option::addUnit($v);
		}

		if (($v = Option::parseValue(Arr::get($value, 'word-spacing', ''))) !== '') {
			$result['word-spacing'] = Option::addUnit($v);
		}

		if (($v = Option::parseValue(Arr::get($value, 'line-height', ''))) !== '') {
			$result['line-height'] = $v;
		}

		if (($v = Option::parseValue(Arr::get($value, 'text-indent', ''))) !== '') {
			$result['text-indent'] = Option::addUnit($v);
		}

		$text_shadow = array();

		if (($v = Option::parseValue(Arr::get($value, 'textShadowOffsetX', ''))) !== '') {
			$text_shadow['textShadowOffsetX'] = Option::addUnit($v);
		}

		if (($v = Option::parseValue(Arr::get($value, 'textShadowOffsetY', ''))) !== '') {
			$text_shadow['textShadowOffsetY'] = Option::addUnit($v);
		}

		if (($v = Option::parseValue(Arr::get($value, 'textShadowBlur', ''))) !== '') {
			$text_shadow['textShadowBlur'] = Option::addUnit($v);
		}

		if ($v = Color::parseValue(Arr::get($value, 'textShadowColor'))) {
			$text_shadow['textShadowColor'] = $v;
		}

		if ($text_shadow) {
			$result['text-shadow'] = implode(' ', $text_shadow);
		}

		return $result ? $result : null;
	}

	protected static function parseCss($value, $data = null) {
		if (isset($value['type'])) {
			if ($value['type'] === 'google') {
				if (isset($value['font-family'])) {
					$value['font-family'] = "'" . $value['font-family'] . "'";
				}
			}
		}

		unset($value['subsets']);
		unset($value['type']);

		if (Arr::get($value, 'font-weight') === 'regular') {
			unset($value['font-weight']);
		}

		return parent::parseCss($value, $data);
	}

}
