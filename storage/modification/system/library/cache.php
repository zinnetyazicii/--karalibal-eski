<?php
/**
 * @package		OpenCart
 * @author		Daniel Kerr
 * @copyright	Copyright (c) 2005 - 2017, OpenCart, Ltd. (https://www.opencart.com/)
 * @license		https://opensource.org/licenses/GPL-3.0
 * @link		https://www.opencart.com
*/

/**
* Cache class
*/
class Cache {
	private $adaptor;
	
	/**
	 * Constructor
	 *
	 * @param	string	$adaptor	The type of storage for the cache.
	 * @param	int		$expire		Optional parameters
	 *
 	*/
	public function __construct($adaptor, $expire = 3600) {
		$class = 'Cache\\' . $adaptor;

		if (class_exists($class)) {
			$this->adaptor = new $class($expire);
		} else {
			throw new \Exception('Error: Could not load cache adaptor ' . $adaptor . ' cache!');
		}
	}
	
    /**
     * Gets a cache by key name.
     *
     * @param	string $key	The cache key name
     *
     * @return	string
     */
	public function get($key) {
		
    // Journal Theme Modification
    $time = microtime(true);

    $result = $this->adaptor->get($key);

    $time = (microtime(true) - $time) * 1000;

    $data = [
      'file' => debug_backtrace()[array_search(__FUNCTION__, array_column(debug_backtrace(), 'function'))]['file'],
    ];

    if (function_exists('clock')) {
      clock()->addCacheQuery('read', $key, $result, $time, $data);
    }

    return $result;
    // End Journal Theme Modification
      
	}
	
    /**
     * 
     *
     * @param	string	$key	The cache key
	 * @param	string	$value	The cache value
	 * 
	 * @return	string
     */
	public function set($key, $value) {
		return $this->adaptor->set($key, $value);
	}
   
    /**
     * 
     *
     * @param	string	$key	The cache key
     */
	public function delete($key) {

            // Journal Theme Modification
            if (is_file(DIR_SYSTEM . 'library/journal3/vendor/SuperCache/SuperCache.php')) {
                require_once DIR_SYSTEM . 'library/journal3/vendor/SuperCache/SuperCache.php';

			    \SuperCache\SuperCache::clearAll();
            }
		    // End Journal Theme Modification
            
		return $this->adaptor->delete($key);
	}
}
