<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class InputPair extends Option {

	protected static function parseValue($value, $data = null) {
		return array(
			'first'  => Arr::get($value, 'first'),
			'second' => Arr::get($value, 'second'),
		);
	}

	protected static function parseCss($value, $data = null) {
		$first_data = $data;
		$second_data = $data;

		$first_data['property'] = Arr::get($data, 'properties.first');
		$first_data['rtlProperty'] = Arr::get($data, 'rtlProperties.first');

		$second_data['property'] = Arr::get($data, 'properties.second');
		$second_data['rtlProperty'] = Arr::get($data, 'rtlProperties.second');

		$first_result = parent::parseCss($value['first'], $first_data);
		$second_result = parent::parseCss($value['second'], $second_data);

		if ($first_result && $second_result) {
			return array_merge_recursive($first_result, $second_result);
		}

		if ($first_result) {
			return $first_result;
		}

		return $second_result;
	}

}
