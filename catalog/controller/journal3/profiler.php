<?php

class ControllerJournal3Profiler extends Controller {

	private static $start_view;

	public function before_view(&$eventRoute, &$data) {
		static::$start_view = microtime(true);
	}

	public function after_view(&$eventRoute, &$data, &$output) {
		clock()->addView($eventRoute, $data, [
			'time'     => static::$start_view,
			'duration' => microtime(true) - static::$start_view,
		]);
	}

	public function before_controller(&$eventRoute, &$data) {
		clock()->event($eventRoute)->name($eventRoute)->begin();
	}

	public function after_controller(&$eventRoute, &$data, &$output) {
		clock()->event($eventRoute)->end();
	}

	public function clockwork() {
		if (function_exists('clock') && !empty($this->request->get['request'])) {
			clock()->returnMetadata($this->request->get['request']);
		}
	}

}
