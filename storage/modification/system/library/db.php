<?php
/**
 * @package		OpenCart
 * @author		Daniel Kerr
 * @copyright	Copyright (c) 2005 - 2017, OpenCart, Ltd. (https://www.opencart.com/)
 * @license		https://opensource.org/licenses/GPL-3.0
 * @link		https://www.opencart.com
*/

/**
* DB class
*/
class DB {

    // Journal Theme Modification
    public static $LOG = [];
    // End Journal Theme Modification
      
	private $adaptor;

	/**
	 * Constructor
	 *
	 * @param	string	$adaptor
	 * @param	string	$hostname
	 * @param	string	$username
     * @param	string	$password
	 * @param	string	$database
	 * @param	int		$port
	 *
 	*/
	public function __construct($adaptor, $hostname, $username, $password, $database, $port = NULL) {
		$class = 'DB\\' . $adaptor;

		if (class_exists($class)) {
			$this->adaptor = new $class($hostname, $username, $password, $database, $port);
		} else {
			throw new \Exception('Error: Could not load database adaptor ' . $adaptor . '!');
		}
	}

	/**
     * 
     *
     * @param	string	$sql
	 * 
	 * @return	array
     */
	public function query($sql) {

    // Journal Theme Modification
    $time = microtime(true);

    if (version_compare(VERSION, '3', '>=')) {
        $result = $this->adaptor->query($sql);
    } else {
        $result = $this->adaptor->query($sql, $params);
    }

    $time = (microtime(true) - $time) * 1000;

    $data = [
      'file' => debug_backtrace()[array_search(__FUNCTION__, array_column(debug_backtrace(), 'function'))]['file'],
    ];

    if (function_exists('clock')) {
      clock()->addDatabaseQuery($sql, [], $time, $data);
    } else {
      static::$LOG[] = ['sql' => $sql, 'time' => $time, 'data' => $data];
    }

    return $result;
    // End Journal Theme Modification
      
		return $this->adaptor->query($sql);
	}

	/**
     * 
     *
     * @param	string	$value
	 * 
	 * @return	string
     */
	public function escape($value) {
		return $this->adaptor->escape($value);
	}

	/**
     * 
	 * 
	 * @return	int
     */
	public function countAffected() {
		return $this->adaptor->countAffected();
	}

	/**
     * 
	 * 
	 * @return	int
     */
	public function getLastId() {
		return $this->adaptor->getLastId();
	}
	
	/**
     * 
	 * 
	 * @return	bool
     */	
	public function connected() {
		return $this->adaptor->connected();
	}
}