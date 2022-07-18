<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class ItemsPerRow extends Option {

	protected static function parseValue($value, $data = null) {
		$variable = Arr::get($value, 'variable');

		if ($variable && Str::startsWith($variable, '__VAR__')) {
			$value = static::getVariable('items_per_row', $variable);
		}

		$result = array(
			'c0' => array(
				'0' => Arr::get($value, 'c0', array(
					'items'   => 1,
					'spacing' => 0,
				)),
			),
			'c1' => array(
				'0' => Arr::get($value, 'c1', array(
					'items'   => 1,
					'spacing' => 0,
				)),
			),
			'c2' => array(
				'0' => Arr::get($value, 'c2', array(
					'items'   => 1,
					'spacing' => 0,
				)),
			),
			'sc' => array(
				'0' => Arr::get($value, 'sc', array(
					'items'   => 1,
					'spacing' => 0,
				)),
			),
		);

		foreach (Arr::get($value, 'c0_multi', array()) as $v) {
			$result['c0'][static::parseBreakpoint(Arr::get($v, 'max'))] = Arr::get($v, 'value', array(
				'items'   => 1,
				'spacing' => 0,
			));
		}

		foreach (Arr::get($value, 'c1_multi', array()) as $v) {
			$result['c1'][static::parseBreakpoint(Arr::get($v, 'max'))] = Arr::get($v, 'value', array(
				'items'   => 1,
				'spacing' => 0,
			));
		}

		foreach (Arr::get($value, 'c2_multi', array()) as $v) {
			$result['c2'][static::parseBreakpoint(Arr::get($v, 'max'))] = Arr::get($v, 'value', array(
				'items'   => 1,
				'spacing' => 0,
			));
		}

		foreach (Arr::get($value, 'sc_multi', array()) as $v) {
			$result['sc'][static::parseBreakpoint(Arr::get($v, 'max'))] = Arr::get($v, 'value', array(
				'items'   => 1,
				'spacing' => 0,
			));
		}

		foreach ($result as &$c) {
			foreach ($c as $k => &$v) {
				$v['items'] = (int)$v['items'];
				$v['spacing'] = (int)InputValue::parseValue($v['spacing'], $data, 'value');
			}
		}

		return $result;
	}

	protected static function parseCss($value, $data = null) {
		if (!$value) {
			return null;
		}

		$selector = Arr::get($data, 'selector');

		if (!$selector) {
			return null;
		}

		$result = array();

		$margin = Arr::get($data, 'config.rtl') === true ? 'margin-left' : 'margin-right';

		// no columns
		foreach (Arr::get($value, 'c0', array()) as $k => $v) {
			$items = (int)Arr::get($v, 'items', 1);
			$spacing = (int)Arr::get($v, 'spacing', 0);
			$media = $k ? ('_' . $k) : '_';

			$result[$media][$selector . '.swiper-slide'] = array(
				sprintf($margin . ": %spx", $spacing),
				sprintf("width: calc((100%% - %s * %spx) / %s - 0.01px)", $items - 1, $spacing, $items),
			);
			$result[$media][$selector . ':not(.swiper-slide)'] = array(
				sprintf("padding: %spx", $spacing / 2),
				sprintf("width: calc(100%% / %s - 0.01px)", $items),
			);
		}

		// one column
		foreach (Arr::get($value, 'c1', array()) as $k => $v) {
			$items = (int)Arr::get($v, 'items', 1);
			$spacing = (int)Arr::get($v, 'spacing', 0);
			$media = $k ? ('_' . $k) : '_';

			$result[$media]['.one-column #content ' . $selector . '.swiper-slide'] = array(
				sprintf($margin . ": %spx", $spacing),
				sprintf("width: calc((100%% - %s * %spx) / %s - 0.01px)", $items - 1, $spacing, $items),
			);
			$result[$media]['.one-column #content ' . $selector . ':not(.swiper-slide)'] = array(
				sprintf("padding: %spx", $spacing / 2),
				sprintf("width: calc(100%% / %s - 0.01px)", $items),
			);
		}

		// two columns
		foreach (Arr::get($value, 'c2', array()) as $k => $v) {
			$items = (int)Arr::get($v, 'items', 1);
			$spacing = (int)Arr::get($v, 'spacing', 0);
			$media = $k ? ('_' . $k) : '_';

			$result[$media]['.two-column #content ' . $selector . '.swiper-slide'] = array(
				sprintf($margin . ": %spx", $spacing),
				sprintf("width: calc((100%% - %s * %spx) / %s - 0.01px)", $items - 1, $spacing, $items),
			);
			$result[$media]['.two-column #content ' . $selector . ':not(.swiper-slide)'] = array(
				sprintf("padding: %spx", $spacing / 2),
				sprintf("width: calc(100%% / %s - 0.01px)", $items),
			);
		}

		// side column
		foreach (Arr::get($value, 'sc', array()) as $k => $v) {
			$items = (int)Arr::get($v, 'items', 1);
			$spacing = (int)Arr::get($v, 'spacing', 0);
			$media = $k ? ('_' . $k) : '_';

			$result[$media]['.side-column ' . $selector . '.swiper-slide'] = array(
				sprintf($margin . ": %spx", $spacing),
				sprintf("width: calc((100%% - %s * %spx) / %s - 0.01px)", $items - 1, $spacing, $items),
			);
			$result[$media]['.side-column ' . $selector . ':not(.swiper-slide)'] = array(
				sprintf("padding: %spx", $spacing / 2),
				sprintf("width: calc(100%% / %s - 0.01px)", $items),
			);
		}

		return $result ? $result : null;
	}

}
