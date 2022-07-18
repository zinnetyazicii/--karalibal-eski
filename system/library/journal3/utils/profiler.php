<?php

namespace Journal3\Utils;

class Profiler {

	private static $keys = array();

	public static function start($key) {
		if (static::isJournalKey($key)) {
			static::$keys[$key] = Arr::get(static::$keys, $key, 0) - round(microtime(true) * 1000);
		}
	}

	public static function end($key) {
		if (static::isJournalKey($key)) {
			static::$keys[$key] = Arr::get(static::$keys, $key, 0) + round(microtime(true) * 1000);
		}
	}

	public static function getStats() {
		return array_filter(static::$keys, array(__CLASS__, 'filterStats'));
	}

	private static function isJournalKey($key) {
		return strpos($key, 'journal3') !== false;
	}

	private static function filterStats($value) {
		return $value >= 0;
	}

}
