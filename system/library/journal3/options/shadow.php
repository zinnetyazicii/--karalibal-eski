<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class Shadow extends Option {

	protected static function parseValue($value, $data = null) {
		$rtl = Arr::get($data, 'config.rtl') === true;

		$result = array();

		if (is_scalar($value) && Str::startsWith($value, '__VAR__')) {
			$value = Arr::get(static::$variables, 'shadow.' . $value);
		}

		if (Arr::get($value, 'none') === 'true') {
			return array(
				'box-shadow' => 'none',
			);
		}

		if ($v = Toggle::parseValue(Arr::get($value, 'inner'))) {
			$result['inset'] = 'inset';
		}

		$has_value = false;

		if ($v = Option::parseValue(Arr::get($value, 'offsetX'))) {
			if ($rtl) {
				$result['offsetX'] = (-1 * (int)$v) . 'px';
			} else {
				$result['offsetX'] = $v . 'px';
			}

			$has_value = true;
		} else {
			$result['offsetX'] = 0;
		}

		if ($v = Option::parseValue(Arr::get($value, 'offsetY'))) {
			$result['offsetY'] = $v . 'px';
			$has_value = true;
		} else {
			$result['offsetY'] = 0;
		}

		if ($v = Option::parseValue(Arr::get($value, 'blur'))) {
			$result['blur'] = $v . 'px';
			$has_value = true;
		} else {
			$result['blur'] = 0;
		}

		if (!$has_value) {
			return null;
		}

		if ($v = Option::parseValue(Arr::get($value, 'spread'))) {
			$result['spread'] = $v . 'px';
		}

		if ($v = Color::parseValue(Arr::get($value, 'color'))) {
			$result['color'] = $v;
		}

		if (!$result) {
			return null;
		}

		return array(
			'box-shadow' => implode(' ', $result),
		);
	}

}
