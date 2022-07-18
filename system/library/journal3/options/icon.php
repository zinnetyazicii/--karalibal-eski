<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class Icon extends Option {

	protected static function parseValue($value, $data = null) {
		$result = array();

		if (Arr::get($value, 'none') === 'true') {
			return array(
				'content' => 'none !important',
			);
		}

		if ($v = Arr::get($value, 'icon.code')) {
			$result['content'] = "'\\" . $v . "' !important";
			$result['font-family'] = 'icomoon !important';
		}

		if ($v = Arr::get($value, 'size')) {
			$result['font-size'] = $v . 'px';
		}

		if ($v = Color::parseValue(Arr::get($value, 'color'))) {
			$result['color'] = $v;
		}

		if ($v = Arr::get($value, 'offsetX')) {
			if (Arr::get($data, 'config.rtl') === true) {
				$result['right'] = $v . 'px';
			} else {
				$result['left'] = $v . 'px';
			}
		}

		if ($v = Arr::get($value, 'offsetY')) {
			$result['top'] = $v . 'px';
		}

		if ($v = Arr::get($value, 'flip')) {
			if ($v === 'all' || Arr::get($data, 'config.rtl') === true) {
				$result['display'] = 'inline-block';
				$result['transform'] = 'scaleX(-1)';
			}
		}

		if ($v = Margin::parseValue(Arr::get($value, 'margin'), $data)) {
			$result = Arr::merge($result, $v);
		}

		return $result;
	}

}
