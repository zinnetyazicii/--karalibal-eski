<?php

namespace Journal3\Utils;

use PhpConsole\Helper;

class Log {

	private static $status = null;
	private static $sql = array();

	private static function canLog() {
		if (static::$status === null) {
			static::$status = defined('JOURNAL3_LOG') && JOURNAL3_LOG === true;

			if (static::$status) {
				require_once DIR_SYSTEM . 'library/journal3/vendor/PhpConsole/__autoload.php';
				Helper::register();
			}
		}

		return static::$status;
	}

	public static function debug($data, $tags = null) {
		if (!defined('JOURNAL3_ENV') || JOURNAL3_ENV !== 'development') {
			return;
		}

		if (!static::canLog()) {
			return;
		}

		if (class_exists('\PC')) {
			\PC::debug($data, $tags);
		}
	}

	public static function sql($sql, $time) {
		static::$sql[] = sprintf("%3.1f - %s", $time, $sql);
	}

	public static function sqlLog() {
		var_dump(static::$sql);
	}
}
