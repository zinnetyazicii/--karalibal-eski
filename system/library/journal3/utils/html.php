<?php

namespace Journal3\Utils;

class Html {

	/**
	 * Generate classes string from array
	 *
	 * @param $classes
	 * @return mixed
	 */
	public static function classes($classes) {
		if (!$classes) {
			return null;
		}

		$result = array();

		foreach ($classes as $key => $value) {
			if (is_numeric($key)) {
				$result[$value] = $value;
			} else {
				if ($value) {
					$result[$key] = $key;
				}
			}
		}

		return trim(implode(' ', $result));
	}

	/**
	 * Count Badge Markup
	 *
	 * @param string $text
	 * @param string $count
	 * @param array $classes
	 * @return string
	 */
	public static function countBadge($text, $count, $classes = array()) {
		$result = '<span class="links-text">' . ($count === null ? $text : trim(str_replace(array('%s', ')', '('), '', $text))) . '</span>';

		if ($count === null) {
			return $result;
		}

		if ($count) {
			return $result . '<span class="count-badge ' . static::classes($classes) . '">' . $count . '</span>';
		}

		return $result . '<span class="count-badge count-zero ' . static::classes($classes) . '">' . $count . '</span>';
	}

}
