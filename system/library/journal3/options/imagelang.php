<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class ImageLang extends Option {

	protected static function parseValue($value, $data = null) {
		if (is_array($value)) {
			$result = Arr::get($value, 'lang_' . $data['config']['language_id']);

			if (!$result) {
				$result = Arr::get($value, 'lang_' . $data['config']['default_language_id']);
			}
		} else {
			$result = $value;
		}

		if ($result && is_file(DIR_IMAGE . $result)) {
			return $result;
		}

		return null;
	}

}
