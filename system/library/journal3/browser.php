<?php

namespace Journal3;

class Browser extends \Journal3\Vendor\Browser\Browser {

	public function fixIpad() {
		$this->setMobile(true);
		$this->setTablet(true);
		$this->setPlatform(Browser::PLATFORM_IPAD);
	}

}
