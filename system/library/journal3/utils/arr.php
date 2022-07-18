<?php

namespace Journal3\Utils;

class Arr {

	/**
	 * Get a value from an array using . (dot) notation
	 *
	 * @param $array
	 * @param $key
	 * @param null $default
	 * @return mixed
	 */
	public static function get($array, $key, $default = null) {
		foreach (explode('.', $key) as $k) {
			if (!is_array($array) || !isset($array[$k])) {
				return $default;
			}

			$array = $array[$k];
		}

		return $array;
	}

	/**
	 * Sorts a mixed array by a specific key
	 *
	 * @param $array
	 * @param $key
	 * @return mixed
	 */
	public static function sort($array, $key) {
		usort($array, function ($a, $b) use ($key) {
			return $a[$key] - $b[$key];
		});

		return $array;
	}

	/**
	 * Remove falsy values from array
	 *
	 * @param $array
	 * @return mixed
	 */
	public static function trim($array) {
		foreach ($array as $key => $value) {
			if (!$value) {
				unset($array[$key]);
			}
		}

		return $array;
	}

	/**
	 * Copy from http://www.php.net/manual/en/function.array-merge-recursive.php#92195
	 *
	 * array_merge_recursive does indeed merge arrays, but it converts values with duplicate
	 * keys to arrays rather than overwriting the value in the first array with the duplicate
	 * value in the second array, as array_merge does. I.e., with array_merge_recursive,
	 * this happens (documented behavior):
	 *
	 * array_merge_recursive(array('key' => 'org value'), array('key' => 'new value'));
	 *     => array('key' => array('org value', 'new value'));
	 *
	 * array_merge_recursive_distinct does not change the datatypes of the values in the arrays.
	 * Matching keys' values in the second array overwrite those in the first array, as is the
	 * case with array_merge, i.e.:
	 *
	 * array_merge_recursive_distinct(array('key' => 'org value'), array('key' => 'new value'));
	 *     => array('key' => array('new value'));
	 *
	 * Parameters are passed by reference, though only for performance reasons. They're not
	 * altered by this function.
	 *
	 * @param array $array1
	 * @param array $array2
	 * @return array
	 * @author Daniel <daniel (at) danielsmedegaardbuus (dot) dk>
	 * @author Gabriel Sobrinho <gabriel (dot) sobrinho (at) gmail (dot) com>
	 */
	public static function merge(array &$array1, array &$array2) {
		$merged = $array1;

		foreach ($array2 as $key => &$value) {
			if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
				$merged[$key] = static::merge($merged[$key], $value);
			} else {
				$merged[$key] = $value;
			}
		}

		return $merged;
	}

	public static function del($obj, $fn) {
		if (is_array($obj)) {
			foreach ($obj as $key => $value) {
				$obj[$key] = static::del($value, $fn);
			}
		} else if (is_object($obj)) {
			foreach (get_object_vars($obj) as $key => $value) {
				if ($fn($key)) {
					unset($obj->$key);
				} else {
					$obj->$key = static::del($value, $fn);
				}
			}
		}

		return $obj;
	}

	public static function hasKeyStartingWith($array, $key) {
		foreach ($array as $k => $v) {
			if (Str::startsWith($k, $key)) {
				return true;
			}
		}

		return false;
	}

}
