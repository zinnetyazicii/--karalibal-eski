<?php

use Journal3\Opencart\MenuController;
use Journal3\Options\Parser;

class ControllerJournal3MainMenu extends MenuController {

	static $first = true;

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		$display = $this->journal3->document->hasClass('mobile-header-active') ? 'accordion' : 'dropdown';

		$data = array(
			'classes' => array(
				'accordion-menu' => $display !== 'dropdown',
			),
			'display' => $display,
		);

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		return array(
			'classes' => array(
				'icon-only'      => $parser->getSetting('iconOnly'),
				'menu-fullwidth' => ($parser->getSetting('type') === 'megamenu') && ($parser->getSetting('megaMenuBGFull')) && ($parser->getSetting('megaMenuLayout') === 'full'),
				'mega-fullwidth' => ($parser->getSetting('type') === 'megamenu') && ($parser->getSetting('megaMenuLayout') === 'full'),
				'mega-custom'    => ($parser->getSetting('type') === 'megamenu') && ($parser->getSetting('megaMenuLayout') === 'custom'),
				'drop-menu'      => ($parser->getSetting('type') === 'multilevel') || ($parser->getSetting('type') === 'flyout'),
			),
			'isOpen'  => $parser->getSetting('mobileOpen') && $parser->getSetting('type') === 'flyout',
		);
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		return $this->parseItemSettings($parser, $index);
	}

	protected function beforeRender() {
		if ($this->journal3->document->isPhone()) {
			$this->settings['first'] = false;
		} else {
			$this->settings['first'] = static::$first;
		}

		static::$first = false;
	}

}
