<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class InputValue extends Option {

	protected static function parseValue($value, $data = null, $type = 'value') {
		if (Str::startsWith($value, '__VAR__')) {
			$value = Arr::get(static::$variables, $type . '.' . $value);
		}

		return $value;
	}

}
