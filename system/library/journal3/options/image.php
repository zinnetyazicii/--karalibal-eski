<?php

namespace Journal3\Options;

class Image extends Option {

	protected static function parseValue($value, $data = null) {
		if (is_file(DIR_IMAGE . $value)) {
			return $value;
		}

		return null;
	}

}
