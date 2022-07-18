<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class Padding extends Option {


	protected static function parseValue($value, $data = null) {
		$rtl = Arr::get($data, 'config.rtl') === true;

		$result = array();

		if (($v = Option::parseValue(Arr::get($value, 'padding', ''))) !== '') {
			$result['padding'] = $v . 'px';
		}

		if (($v = Option::parseValue(Arr::get($value, 'padding-top', ''))) !== '') {
			$result['padding-top'] = $v . 'px';
		}

		if ($rtl) {
			if (($v = Option::parseValue(Arr::get($value, 'padding-right', ''))) !== '') {
				$result['padding-left'] = $v . 'px';
			}
		} else {
			if (($v = Option::parseValue(Arr::get($value, 'padding-right', ''))) !== '') {
				$result['padding-right'] = $v . 'px';
			}
		}

		if (($v = Option::parseValue(Arr::get($value, 'padding-bottom', ''))) !== '') {
			$result['padding-bottom'] = $v . 'px';
		}

		if ($rtl) {
			if (($v = Option::parseValue(Arr::get($value, 'padding-left', ''))) !== '') {
				$result['padding-right'] = $v . 'px';
			}
		} else {
			if (($v = Option::parseValue(Arr::get($value, 'padding-left', ''))) !== '') {
				$result['padding-left'] = $v . 'px';
			}
		}

		return $result ? $result : null;
	}

}
