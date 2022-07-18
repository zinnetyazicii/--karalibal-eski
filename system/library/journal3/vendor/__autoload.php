<?php

spl_autoload_register(function ($class) {
	$file = DIR_SYSTEM . 'library/journal3/vendor' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

	if (is_file($file)) {
		require_once $file;

		return true;
	}

	return false;
});
