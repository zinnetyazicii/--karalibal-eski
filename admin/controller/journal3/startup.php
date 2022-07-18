<?php

use Journal3\Opencart\Controller;
use Journal3\Utils\Arr;

class ControllerJournal3Startup extends Controller {

	public function index() {
		define('JOURNAL3_ADMIN', true);

		$this->registry->set('journal3', new Journal3($this->registry));
	}

}
