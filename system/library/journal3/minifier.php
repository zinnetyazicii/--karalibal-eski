<?php

namespace Journal3;

use Journal3\Utils\Profiler;

require_once DIR_SYSTEM . 'library/journal3/vendor/Minify/CSS/Compressor.php';
require_once DIR_SYSTEM . 'library/journal3/vendor/Minify/CSS/UriRewriter.php';
require_once DIR_SYSTEM . 'library/journal3/vendor/Minify/CSS.php';
require_once DIR_SYSTEM . 'library/journal3/vendor/Minify/HTML.php';
require_once DIR_SYSTEM . 'library/journal3/vendor/Minify/JSMin.php';

class Minifier {

	private static $ASSETS_PATH;
	const ASSETS_URL = 'catalog/view/theme/journal3/assets/';
	const DEBUG = false;

	public function __construct() {
		if (static::$ASSETS_PATH === null) {
			static::$ASSETS_PATH = realpath(DIR_SYSTEM . '../catalog/view/theme/journal3/assets/') . '/';

			if (!isset($_SERVER['DOCUMENT_ROOT'])) {
				$_SERVER['DOCUMENT_ROOT'] = realpath(DIR_SYSTEM . '../');
			}
		}
	}

	public static function hash($data, $ext) {
		if (is_scalar($data)) {
			$hash = $data;
		} else {
			$hash = implode('', array_keys($data));
		}

		return md5($hash . (defined('JOURNAL3_BUILD') ? JOURNAL3_BUILD : JOURNAL3_VERSION)) . '.' . $ext;
	}

	public static function minifyCSS($css, $options = array()) {
		$options['preserveComments'] = false;

		return \Minify_CSS::minify($css, $options);
	}

	public static function minifyJS($js) {
		try {
			$js = \JSMin::minify($js);
		} catch (\Exception $e) {
//			echo $e->getMessage();
//			global $log;
//			$log->write($e->getMessage());
		}

		return $js;
	}

	public static function minifyStyles($styles) {
		Profiler::start('journal3/minify/css');

		$hash = static::hash($styles, 'css');

		$file = static::$ASSETS_PATH . $hash;

		if (!is_file($file) || static::DEBUG) {
			$content = '';

			foreach ($styles as $style) {
				$_file = static::$ASSETS_PATH . static::hash($style['href'], 'css');

				if (!is_file($_file) || static::DEBUG) {
					$_content = file_get_contents($style['href']);

					$_content = static::minifyCSS($_content, array(
						'currentDir' => dirname($style['href']),
					));

					file_put_contents($_file, $_content);

					$content .= $_content;
				} else {
					$content .= file_get_contents($_file);
				}
			}

			if (static::DEBUG) {
				$content = sprintf("/* %s */\n\n", print_r(array_keys($styles), true)) . $content;
			}

			file_put_contents($file, $content);
		}

		Profiler::end('journal3/minify/css');

		return array(
			'href'  => static::ASSETS_URL . $hash,
			'rel'   => 'stylesheet',
			'media' => 'screen',
		);
	}

	public static function minifyScripts($scripts) {
		Profiler::start('journal3/minify/js');

		$hash = static::hash($scripts, 'js');

		$file = static::$ASSETS_PATH . $hash;

		if (!is_file($file) || static::DEBUG) {
			$content = '';

			foreach ($scripts as $script) {
				$_file = static::$ASSETS_PATH . static::hash($script, 'js');

				if (!is_file($_file) || static::DEBUG) {
					$_content = file_get_contents($script);

					$_content = static::minifyJS($_content);

					file_put_contents($_file, $_content);

					$content .= PHP_EOL . $_content;
				} else {
					$content .= PHP_EOL . file_get_contents($_file);
				}
			}

			if (static::DEBUG) {
				$content = sprintf("/* %s */\n\n", print_r(array_keys($scripts), true)) . $content;
			}

			file_put_contents($file, $content);
		}

		Profiler::end('journal3/minify/js');

		return static::ASSETS_URL . $hash;
	}

	public static function minifyHTML($html) {
		Profiler::start('journal3/minify/html');

		try {
			$html = \Minify_HTML::minify($html);
		} catch (\Exception $e) {
			global $log;
			$log->write($e->getMessage());
		}

		Profiler::end('journal3/minify/html');

		return $html;
	}

	public function clearCache() {
		$files = glob(static::$ASSETS_PATH . '*.{js,css}', GLOB_BRACE);

		foreach ($files as $file) {
			if (is_file($file)) {
				@unlink($file);
			}
		}
	}

	public function getAssetsPath() {
		return static::$ASSETS_PATH;
	}

	public function getAssetsUrl() {
		return static::ASSETS_URL;
	}

}
