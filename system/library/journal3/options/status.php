<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class Status extends Option {

	protected static function parseValue($value, $data = null) {
		if (Arr::get($value, 'status') === 'false') {
			return false;
		}

		if ($device = Arr::get($value, 'device')) {
			if (!in_array($data['config']['device'], $device)) {
				return false;
			}
		}

		$customer = Arr::get($data, 'config.customer');

		if ((Arr::get($value, 'customer') === 'customers') && !$customer) {
			return false;
		}

		if ((Arr::get($value, 'customer') === 'guests') && $customer) {
			return false;
		}

		if (Arr::get($value, 'customer_group_' . $data['config']['customer_group_id']) === 'false') {
			return false;
		}

		if (Arr::get($value, 'store_' . $data['config']['store_id']) === 'false') {
			return false;
		}

		if ((Arr::get($value, 'admin') === 'true') && !Arr::get($data, 'config.admin')) {
			return false;
		}

		return true;
	}

}
