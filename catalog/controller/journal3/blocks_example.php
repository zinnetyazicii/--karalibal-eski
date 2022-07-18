<?php

use Journal3\Opencart\Controller;

class ControllerJournal3BlocksExample extends Controller {

	public function index($args) {
		return 'Dynamic Content for module_id = ' . $args['module_id'];
	}

}
