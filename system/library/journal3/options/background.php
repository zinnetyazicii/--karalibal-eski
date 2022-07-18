<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;
use Journal3\Utils\Img;
use Journal3\Utils\Str;

class Background extends Option {

	protected static function parseValue($value, $data = null) {
		$rtl = Arr::get($data, 'config.rtl') === true;

		$result = array();

		$has_bg = false;

		if (Arr::get($value, 'none') === 'true') {
			return array(
				'background' => 'none',
			);
		}

		if (($v = Color::parseValue(Arr::get($value, 'background-color'))) !== null) {
			$result['background'] = $v;
		}

		if (($v = trim(Arr::get($value, 'gradient')))) {
			if (Str::startsWith($v, '__VAR__')) {
				$v = Arr::get(static::$variables, 'gradient.' . $v);
			}

			$result['gradient'] = $v;
			$has_bg = true;
		}

		if (($v = Image::parseValue(Arr::get($value, 'background-image'))) !== null) {
			$result['background-image'] = "url('" . Img::resize($v) . "')";
			$has_bg = true;

			if (($v = trim(Arr::get($value, 'overlay')))) {
				if (Str::startsWith($v, '__VAR__')) {
					$v = Arr::get(static::$variables, 'gradient.' . $v);

					if ($v) {
						$v = explode(':', $v);

						if (isset($v[1])) {
							$result['background-image'] = trim($v[1], ';') . ', ' . $result['background-image'];
						}
					}
				}
			}

			if (($v = Option::parseValue(Arr::get($value, 'background-position'))) !== null) {
				if ($v === 'custom') {
					$size = array();
					$unit = Option::parseValue(Arr::get($value, 'backgroundPositionUnit', 'px'));

					if (($v = Option::parseValue(Arr::get($value, 'backgroundPositionX'))) !== '') {
						$size[] = Option::addUnit($v, $unit);
					}

					if (($v = Option::parseValue(Arr::get($value, 'backgroundPositionY'))) !== '') {
						$size[] = Option::addUnit($v, $unit);
					}

					if ($size) {
						$result['background-position'] = implode(' ', $size);
					}
				} else {
					$result['background-position'] = $v;

					if ($rtl) {
						if (Str::startsWith($v, 'left')) {
							$result['background-position'] = str_replace('left', 'right', $v);
						} else if (Str::startsWith($v, 'right')) {
							$result['background-position'] = str_replace('right', 'left', $v);
						}
					}
				}
			}

			if (($v = Option::parseValue(Arr::get($value, 'background-attachment'))) !== null) {
				$result['background-attachment'] = $v;
			}

			if (($v = Option::parseValue(Arr::get($value, 'background-repeat'))) !== null) {
				$result['background-repeat'] = $v;
			}

			if (($v = Option::parseValue(Arr::get($value, 'background-origin'))) !== null) {
				$result['background-origin'] = $v;
			}

			if (($v = Option::parseValue(Arr::get($value, 'background-size'))) !== null) {
				if ($v === 'custom') {
					$size = array();
					$unit = Option::parseValue(Arr::get($value, 'backgroundSizeUnit', 'px'));

					if (($v = Option::parseValue(Arr::get($value, 'backgroundSizeW'))) !== '') {
						$size[] = Option::addUnit($v, $unit);
					}

					if (($v = Option::parseValue(Arr::get($value, 'backgroundSizeH'))) !== '') {
						$size[] = Option::addUnit($v, $unit);
					}

					if ($size) {
						$result['background-size'] = implode(' ', $size);
					}
				} else {
					$result['background-size'] = $v;
				}
			}
		}

		if (($v = Option::parseValue(Arr::get($value, 'background-blend-mode'))) !== null) {
			$result['background-blend-mode'] = $v;
		}

		if (!$has_bg) {
//			$result['background-image'] = 'none';
		}

		return $result ? $result : null;
	}

}
