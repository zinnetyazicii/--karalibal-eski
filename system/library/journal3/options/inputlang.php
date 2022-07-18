<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class InputLang extends Option {

	protected static function parseValue($value, $data = null) {
		if (is_scalar($value)) {
			return $value;
		}

		$result = Arr::get($value, 'lang_' . $data['config']['language_id']);

		if ($result === null) {
			$result = Arr::get($value, 'lang_1');
		}

		return $result;
	}

}
