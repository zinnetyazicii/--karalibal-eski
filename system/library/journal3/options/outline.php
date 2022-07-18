<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class Outline extends Option {

	protected static function parseValue($value, $data = null) {
		$result = array();

		if (($v = Option::parseValue(Arr::get($value, 'outline-width', ''))) !== '') {
			$result['outline-width'] = $v . 'px';
		}

		if (($v = Option::parseValue(Arr::get($value, 'outline-style', ''))) !== '') {
			$result['outline-style'] = $v;
		}

		if ($v = Color::parseValue(Arr::get($value, 'outline-color'))) {
			$result['outline-color'] = $v;
		}

		if (($v = Option::parseValue(Arr::get($value, 'outline-offset', ''))) !== '') {
			$result['outline-offset'] = $v . 'px';
		}

		return $result ? $result : null;
	}

}
