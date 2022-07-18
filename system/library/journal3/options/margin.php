<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class Margin extends Option {

	protected static function parseValue($value, $data = null) {
		$rtl = Arr::get($data, 'config.rtl') === true;

		$result = array();

		if (($v = Option::parseValue(Arr::get($value, 'margin', ''))) !== '') {
			$result['margin'] = $v === 'a' ? 'auto' : ($v . 'px');
		}

		if (($v = Option::parseValue(Arr::get($value, 'margin-top', ''))) !== '') {
			$result['margin-top'] = $v === 'a' ? 'auto' : ($v . 'px');
		}

		if ($rtl) {
			if (($v = Option::parseValue(Arr::get($value, 'margin-right', ''))) !== '') {
				$result['margin-left'] = $v === 'a' ? 'auto' : ($v . 'px');
			}
		} else {
			if (($v = Option::parseValue(Arr::get($value, 'margin-right', ''))) !== '') {
				$result['margin-right'] = $v === 'a' ? 'auto' : ($v . 'px');
			}
		}

		if (($v = Option::parseValue(Arr::get($value, 'margin-bottom', ''))) !== '') {
			$result['margin-bottom'] = $v === 'a' ? 'auto' : ($v . 'px');
		}

		if ($rtl) {
			if (($v = Option::parseValue(Arr::get($value, 'margin-left', ''))) !== '') {
				$result['margin-right'] = $v === 'a' ? 'auto' : ($v . 'px');
			}
		} else {
			if (($v = Option::parseValue(Arr::get($value, 'margin-left', ''))) !== '') {
				$result['margin-left'] = $v === 'a' ? 'auto' : ($v . 'px');
			}
		}

		return $result ? $result : null;
	}

}
