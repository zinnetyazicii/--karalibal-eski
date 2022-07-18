<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class Toggle extends Option {

	public function __construct($data) {
		parent::__construct($data);
	}

	protected static function parseValue($value, $data = null) {
		if ($value === null || $value === 'true') {
			return true;
		}

		if ($value === 'false') {
			return false;
		}

		return null;
	}

	protected static function parseCss($value, $data = null) {
		return parent::parseCss(Arr::get($data, 'value'), $data);
	}

}
