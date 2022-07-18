<?php
/**
 * @package		OpenCart
 * @author		Daniel Kerr
 * @copyright	Copyright (c) 2005 - 2017, OpenCart, Ltd. (https://www.opencart.com/)
 * @license		https://opensource.org/licenses/GPL-3.0
 * @link		https://www.opencart.com
*/

/**
* Router class
*/
final class Router {
	private $registry;
	private $pre_action = array();
	private $error;
	
	/**
	 * Constructor
	 *
	 * @param	object	$route
 	*/
	public function __construct($registry) {
		$this->registry = $registry;
	}
	
	/**
	 * 
	 *
	 * @param	object	$pre_action
 	*/	
	public function addPreAction(Action $pre_action) {
		$this->pre_action[] = $pre_action;
	}

	/**
	 * 
	 *
	 * @param	object	$action
	 * @param	object	$error
 	*/		
	public function dispatch(Action $action, Action $error) {
		$this->error = $error;

		foreach ($this->pre_action as $pre_action) {
			$result = $this->execute($pre_action);

			if ($result instanceof Action) {
				$action = $result;

				break;
			}
		}


            // Journal Theme Modification
            define('JOURNAL3_INSTALLED', true);

            if (is_file(DIR_SYSTEM . 'library/journal3/build.php')) {
                require_once DIR_SYSTEM . 'library/journal3/build.php';
            }

            if (is_file(DIR_SYSTEM . 'library/journal3/vendor/__autoload.php')) {
                require_once DIR_SYSTEM . 'library/journal3/vendor/__autoload.php';
            }

            if (version_compare(phpversion(), '7.1', '>=') && is_file(DIR_SYSTEM . 'library/journal3/vendor-composer/autoload.php')) {
                require_once DIR_SYSTEM . 'library/journal3/vendor-composer/autoload.php';
            }

            $env = DIR_SYSTEM . '../.env';

			if (is_file($env)) {
				$lines = file($env);

				foreach ($lines as $line) {
					$line = trim($line);

					if (!$line) {
					    continue;
					}

					if ($line[0] === '#') {
						continue;
					}

					$line = explode('=', $line);

					if (count($line) === 2) {
					    $value = trim($line[1]);

					    if ($value === 'true') {
                            $value = true;
					    }

					    if ($value === 'false') {
                            $value = false;
					    }

						define(trim($line[0]), $value);
					}
				}
			}

			if (!defined('JOURNAL3_ENV')) {
			    define('JOURNAL3_ENV', 'production');
			}

			if (!defined('JOURNAL3_CACHE')) {
			    define('JOURNAL3_CACHE', true);
			}

			if (defined('SENTRY_DSN') && SENTRY_DSN && function_exists('Sentry\init')) {
			    Sentry\init(array(
                    'dsn' => SENTRY_DSN
                ));
			}

            $this->execute(new Action('journal3/startup'));
		    // End Journal Theme Modification
            
		while ($action instanceof Action) {
			$action = $this->execute($action);
		}
	}
	
	/**
	 * 
	 *
	 * @param	object	$action
	 * @return	object
 	*/
	private function execute(Action $action) {
		$result = $action->execute($this->registry);

		if ($result instanceof Action) {
			return $result;
		} 
		
		if ($result instanceof Exception) {
			$action = $this->error;
			
			$this->error = null;
			
			return $action;
		}
	}
}