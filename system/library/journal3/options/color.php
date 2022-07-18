<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class Color extends Option {

	protected static function parseValue($value, $data = null) {
		if (!$value) {
			return null;
		}

		$value = is_array($value) ? $value : array('color' => $value);

		$color = Arr::get($value, 'color');

		if (Str::startsWith($color, '__VAR__')) {
			$variable = Arr::get(static::$variables, 'color.' . $color);

			$color = is_array($variable) ? Arr::get($variable, 'color') : $variable;
		}

		list($r, $g, $b, $a) = sscanf($color, "rgba(%d, %d, %d, %f)");

		$lightness = (int)Arr::get($value, 'lightness');

		if ($lightness) {
			$color = lighten(array('r' => $r, 'g' => $g, 'b' => $b), $lightness);

			$r = $color['r'];
			$g = $color['g'];
			$b = $color['b'];
		}

		if (is_numeric($r) && is_numeric($g) && is_numeric($b) && is_numeric($a)) {
			return "rgba($r, $g, $b, $a)";
		}

		return null;
	}
}

function hueToRGB($m1, $m2, $h) {
	if ($h < 0)
		$h += 1;
	elseif ($h > 1)
		$h -= 1;

	if ($h * 6 < 1)
		return $m1 + ($m2 - $m1) * $h * 6;

	if ($h * 2 < 1)
		return $m2;

	if ($h * 3 < 2)
		return $m1 + ($m2 - $m1) * (2 / 3 - $h) * 6;

	return $m1;
}

function RGBAtoHSL($color) {
	$red = $color['r'];
	$green = $color['g'];
	$blue = $color['b'];

	$min = min($red, $green, $blue);
	$max = max($red, $green, $blue);

	$l = $min + $max;

	if ($min == $max) {
		$s = $h = 0;
	} else {
		$d = $max - $min;

		if ($l < 255)
			$s = $d / $l;
		else
			$s = $d / (510 - $l);

		if ($red == $max)
			$h = 60 * ($green - $blue) / $d;
		elseif ($green == $max)
			$h = 60 * ($blue - $red) / $d + 120;
		elseif ($blue == $max)
			$h = 60 * ($red - $green) / $d + 240;
	}

	return array(
		'h' => fmod($h, 360),
		's' => $s * 100,
		'l' => $l / 5.1,
	);
}

function HSLtoRGBA($color) {
	$hue = $color['h'];
	$saturation = $color['s'];
	$lightness = $color['l'];

	if ($hue < 0) {
		$hue += 360;
	}

	$h = $hue / 360;
	$s = min(100, max(0, $saturation)) / 100;
	$l = min(100, max(0, $lightness)) / 100;

	$m2 = $l <= 0.5 ? $l * ($s + 1) : $l + $s - $l * $s;
	$m1 = $l * 2 - $m2;

	$r = hueToRGB($m1, $m2, $h + 1 / 3) * 255;
	$g = hueToRGB($m1, $m2, $h) * 255;
	$b = hueToRGB($m1, $m2, $h - 1 / 3) * 255;

	return array(
		'r' => round($r),
		'g' => round($g),
		'b' => round($b),
	);
}

function RGBA($color) {
	return 'rgb(' + $color['r'] + ',' + $color['g'] + ',' + $color['b'] + ')';
}

function lighten($color, $amount) {
	$color = RGBAtoHSL($color);

	$color['l'] -= $amount;

	$color = HSLtoRGBA($color);

	return $color;
}
