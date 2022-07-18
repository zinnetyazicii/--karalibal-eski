<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class BorderRadius extends Option {

	protected static function parseValue($value, $data = null) {
		$rtl = Arr::get($data, 'config.rtl') === true;

		$result = array();

		if (($v = Option::parseValue(Arr::get($value, 'custom', ''))) !== '') {
			$result['border-radius'] = $v;
		} else {
			$unit = Option::parseValue(Arr::get($value, 'borderRadiusUnit', 'px'));

			if ($rtl) {
				if (($v = Option::parseValue(Arr::get($value, 'border-radius', ''))) !== '') {
					if ($v && Str::startsWith($v, '__VAR__')) {
						$v = static::getVariable('radius', $v);
					}

					$result['border-radius'] = $v . $unit;
				}

				if (($v = Option::parseValue(Arr::get($value, 'border-top-left-radius', ''))) !== '') {
					$result['border-top-right-radius'] = $v . $unit;
				}

				if (($v = Option::parseValue(Arr::get($value, 'border-top-right-radius', ''))) !== '') {
					$result['border-top-left-radius'] = $v . $unit;
				}

				if (($v = Option::parseValue(Arr::get($value, 'border-bottom-right-radius', ''))) !== '') {
					$result['border-bottom-left-radius'] = $v . $unit;
				}

				if (($v = Option::parseValue(Arr::get($value, 'border-bottom-left-radius', ''))) !== '') {
					$result['border-bottom-right-radius'] = $v . $unit;
				}
			} else {
				if (($v = Option::parseValue(Arr::get($value, 'border-radius', ''))) !== '') {
					if ($v && Str::startsWith($v, '__VAR__')) {
						$v = static::getVariable('radius', $v);
					}

					$result['border-radius'] = $v . $unit;
				}

				if (($v = Option::parseValue(Arr::get($value, 'border-top-left-radius', ''))) !== '') {
					$result['border-top-left-radius'] = $v . $unit;
				}

				if (($v = Option::parseValue(Arr::get($value, 'border-top-right-radius', ''))) !== '') {
					$result['border-top-right-radius'] = $v . $unit;
				}

				if (($v = Option::parseValue(Arr::get($value, 'border-bottom-right-radius', ''))) !== '') {
					$result['border-bottom-right-radius'] = $v . $unit;
				}

				if (($v = Option::parseValue(Arr::get($value, 'border-bottom-left-radius', ''))) !== '') {
					$result['border-bottom-left-radius'] = $v . $unit;
				}
			}
		}

		return $result ? $result : null;
	}

}
