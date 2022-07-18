<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class ProductFilter extends Option {

	protected static function parseValue($value, $data = null) {
		$result = array(
			'sort'   => 'p.sort_order',
			'order'  => 'ASC',
			'start'  => 0,
			'limit'  => 10,
			'preset' => Arr::get($value, 'preset', 'all'),
		);

		switch ($result['preset']) {
			case 'all':
				break;

			case 'latest':
				$result['sort'] = 'p.date_added';
				$result['order'] = 'DESC';

				break;

			case 'special':
				$result['special'] = true;

				break;

			case 'bestseller':
				$result['bestseller'] = true;
				$result['sort'] = 'sales';
				$result['order'] = 'DESC';

				break;

			case 'related':
			case 'related_category':
			case 'related_manufacturer':
				$result['related'] = true;

				break;

			case 'alsobought':
				$result['alsobought'] = true;

				break;

			case 'recently_viewed':
				$result['recently_viewed'] = true;

				break;

			case 'most_viewed':
				$result['sort'] = 'p.viewed';
				$result['order'] = 'DESC';

				break;

			case 'random':
				$result['sort'] = 'random';

				break;

			case 'custom':
				$result['products'] = Arr::get($value, 'products', array());
				$result['custom'] = true;

				break;

			case 'advanced':
				if (is_array($categories = Arr::get($value, 'categories', array()))) {
					$categories = Arr::trim($categories);

					if ($categories) {
						$result['categories'] = $categories;
					}
				}

				if (is_array($manufacturers = Arr::get($value, 'manufacturers', array()))) {
					$manufacturers = Arr::trim($manufacturers);

					if ($manufacturers) {
						$result['manufacturers'] = $manufacturers;
					}
				}

				if (is_array($filters = Arr::get($value, 'filters', array()))) {
					foreach ($filters as $filter) {
						$filter = explode('_', $filter, 2);

						if ($filter[0] && $filter[1]) {
							$result['filters'][$filter[0]][] = $filter[1];
						}
					}
				}

				if (is_array($options = Arr::get($value, 'options', array()))) {
					foreach ($options as $option) {
						$option = explode('_', $option, 2);

						if ($option[0] && $option[1]) {
							$result['options'][$option[0]][] = $option[1];
						}
					}
				}

				if (is_array($attributes = Arr::get($value, 'attributes', array()))) {
					foreach ($attributes as $attribute) {
						$attribute = explode('_', $attribute, 2);

						if ($attribute[0] && $attribute[1]) {
							$result['attributes'][$attribute[0]][] = $attribute[1];
						}
					}
				}

				if (Arr::get($value, 'special') === 'true') {
					$result['special'] = true;
				}

				$result['price']['min'] = Arr::get($value, 'min_price');
				$result['price']['max'] = Arr::get($value, 'max_price');

				$result['quantity']['min'] = Arr::get($value, 'min_quantity');
				$result['quantity']['max'] = Arr::get($value, 'max_quantity');

				$result['sort'] = Arr::get($value, 'sort');
				$result['order'] = Arr::get($value, 'order');

				break;

			default:
				trigger_error('Invalid preset for ' . $data['name']);
		}

		$result['limit'] = (int)Arr::get($value, 'limit');

		switch (Arr::get($data, 'config.device')) {
			case 'tablet':
				if ($limit = (int)Arr::get($value, 'limitTablet')) {
					$result['limit'] = $limit;
				}
				break;

			case 'phone':
				if ($limit = (int)Arr::get($value, 'limitPhone')) {
					$result['limit'] = $limit;
				}
				break;
		}

		return $result;
	}

}
