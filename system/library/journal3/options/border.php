<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class Border extends Option {

	protected static function parseValue($value, $data = null) {
		$rtl = Arr::get($data, 'config.rtl') === true;

		$result = array();

		$has_width = false;

		if (($v = Option::parseValue(Arr::get($value, 'border-width', ''))) !== '') {
			$result['border-width'] = $v . 'px';
			$has_width = true;
		}

		$has_width2 = false;

		if (($v = Option::parseValue(Arr::get($value, 'border-top-width', ''))) !== '') {
			$result['border-top-width'] = $v . 'px';
			$has_width2 = true;
		}

		if ($rtl) {
			if (($v = Option::parseValue(Arr::get($value, 'border-right-width', ''))) !== '') {
				$result['border-left-width'] = $v . 'px';
				$has_width2 = true;
			}
		} else {
			if (($v = Option::parseValue(Arr::get($value, 'border-right-width', ''))) !== '') {
				$result['border-right-width'] = $v . 'px';
				$has_width2 = true;
			}
		}

		if (($v = Option::parseValue(Arr::get($value, 'border-bottom-width', ''))) !== '') {
			$result['border-bottom-width'] = $v . 'px';
			$has_width2 = true;
		}

		if ($rtl) {
			if (($v = Option::parseValue(Arr::get($value, 'border-left-width', ''))) !== '') {
				$result['border-right-width'] = $v . 'px';
				$has_width2 = true;
			}
		} else {
			if (($v = Option::parseValue(Arr::get($value, 'border-left-width', ''))) !== '') {
				$result['border-left-width'] = $v . 'px';
				$has_width2 = true;
			}
		}

		if (!$has_width && $has_width2) {
			$result = array_merge(array('border-width' => 0), $result);
		}

		if ($v = Option::parseValue(Arr::get($value, 'border-style'))) {
			$result['border-style'] = $v;
		}

		if ($v = Color::parseValue(Arr::get($value, 'border-color'))) {
			$result['border-color'] = $v;
		}

		return $result ? $result : null;
	}

}
