<?php

namespace Journal3\Options;

use Journal3\Utils\Arr;

class PostFilter extends Option {

	protected static function parseValue($value, $data = null) {
		$result = array(
			'sort'   => 'newest',
			'order'  => 'ASC',
			'start'  => 0,
			'limit'  => 5,
			'preset' => Arr::get($value, 'preset', 'latest'),
		);

		switch ($result['preset']) {
			case 'latest':
				$result['sort'] = 'newest';
				break;

			case 'most_commented':
				$result['sort'] = 'comments';
				break;

			case 'most_viewed':
				$result['sort'] = 'views';
				break;

			case 'related':
				break;

			case 'category':
				$result['categories'] = Arr::get($value, 'categories', array());
				break;

			case 'custom':
				$result['post_ids'] = Arr::get($value, 'posts', array());
				break;

			default:
				trigger_error('Invalid preset for ' . $data['name']);
		}

		$result['limit'] = (int)Arr::get($value, 'limit');

		return $result;
	}

}
