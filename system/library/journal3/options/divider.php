<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class Divider extends Option {

	protected static function parseValue($value, $data = null) {
		$result = array();

		if ($v = Option::parseValue(Arr::get($value, 'width'))) {
			$result['border-width'] = $v . 'px';
		}

		if ($v = Option::parseValue(Arr::get($value, 'style'))) {
			$result['border-style'] = $v;
		}

		if ($v = Color::parseValue(Arr::get($value, 'color'))) {
			$result['border-color'] = $v;
		}

		return $result ? $result : null;
	}

}
