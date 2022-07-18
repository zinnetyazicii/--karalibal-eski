<?php

namespace Journal3\Options;

class Link extends Option {

	/** @var \ModelJournal3Links */
	private static $link;

	protected static function parseValue($value, $data = null) {
		if (static::$link === null) {
			\Journal3::getInstance()->getRegistry()->get('load')->model('journal3/links');
			static::$link = \Journal3::getInstance()->getRegistry()->get('model_journal3_links');
		}

		return static::$link->link($value);
	}

}
