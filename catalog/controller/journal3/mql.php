<?php

use Journal3\Minifier;
use Journal3\Opencart\Controller;

class ControllerJournal3Mql extends Controller {

	public function index() {
		$file = 'catalog/view/theme/journal3/js/mql.js';

		if ($this->journal3->settings->get('performanceHTMLMinify') || $this->journal3->settings->get('performanceJSMinify')) {
			$file = Minifier::minifyScripts(array(
				$file => $file,
			));
		}

		return file_get_contents($file);
	}

}
