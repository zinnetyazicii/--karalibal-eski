<?php
/**
 * @package		OpenCart
 * @author		Daniel Kerr
 * @copyright	Copyright (c) 2005 - 2017, OpenCart, Ltd. (https://www.opencart.com/)
 * @license		https://opensource.org/licenses/GPL-3.0
 * @link		https://www.opencart.com
*/

/**
* Response class
*/
class Response {
	private $headers = array();
	private $level = 0;
	private $output;

	/**
	 * Constructor
	 *
	 * @param	string	$header
	 *
 	*/
	public function addHeader($header) {
		$this->headers[] = $header;
	}
	
	/**
	 * 
	 *
	 * @param	string	$url
	 * @param	int		$status
	 *
 	*/
	public function redirect($url, $status = 302) {
		header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&', '', ''), $url), true, $status);
		exit();
	}
	
	/**
	 * 
	 *
	 * @param	int		$level
 	*/
	public function setCompression($level) {
		$this->level = $level;
	}
	
	/**
	 * 
	 *
	 * @return	array
 	*/
	public function getOutput() {
		return $this->output;
	}
	
	/**
	 * 
	 *
	 * @param	string	$output
 	*/	
	public function setOutput($output) {
		$this->output = $output;
	}
	
	/**
	 * 
	 *
	 * @param	string	$data
	 * @param	int		$level
	 * 
	 * @return	string
 	*/
	private function compress($data, $level = 0) {
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false)) {
			$encoding = 'gzip';
		}

		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'x-gzip') !== false)) {
			$encoding = 'x-gzip';
		}

		if (!isset($encoding) || ($level < -1 || $level > 9)) {
			return $data;
		}

		if (!extension_loaded('zlib') || ini_get('zlib.output_compression')) {
			return $data;
		}

		if (headers_sent()) {
			return $data;
		}

		if (connection_status()) {
			return $data;
		}

		$this->addHeader('Content-Encoding: ' . $encoding);

		return gzencode($data, (int)$level);
	}
	
	/**
	 * 
 	*/
	public function output() {
		if ($this->output) {

                if (defined('JOURNAL3_ACTIVE')) {
                    if (\Journal3::getInstance()->settings->get('performanceHTMLMinify')) {
                        $this->output = \Journal3\Minifier::minifyHTML($this->output);
                    }

                    if (\Journal3::getInstance()->settings->get('performanceJSDefer')) {
                        $this->output = str_replace('<script type="text/javascript">', '<script type="text/javascript/defer">', $this->output);
                    }
                }
            
			$output = $this->level ? $this->compress($this->output, $this->level) : $this->output;
			
			if (!headers_sent()) {
				foreach ($this->headers as $header) {
					header($header, true);
				}
			}
			

      // Journal Theme Modification
      if (function_exists('clock')) {
        foreach (DB::$LOG as $log) {
          clock()->addDatabaseQuery($log['sql'], [], $log['time'], $log['data']);
        }

        /*
        $opencart = clock()->userData('opencart')->title('Opencart');

        $opencart->table('REQUEST', [
          [
            'TYPE' => 'GET',
                'VALUE' => Journal4\Journal4::registry()->get('request')->get
            ],
            [
                'TYPE' => 'POST',
                'VALUE' => Journal4\Journal4::registry()->get('request')->post
            ],
            [
                'TYPE' => 'COOKIE',
                'VALUE' => Journal4\Journal4::registry()->get('request')->cookie
            ],
            [
                'TYPE' => 'SESSION',
                'VALUE' => Journal4\Journal4::registry()->get('session')->data
            ],
            [
                'TYPE' => 'SERVER',
                'VALUE' => Journal4\Journal4::registry()->get('request')->server
            ],
        ]);
        */

        clock()->requestProcessed();
      }
      // End Journal Theme Modification
      
			echo $output;

                if (defined('JOURNAL3_ACTIVE')) {
                    \Journal3::getInstance()->loadController('journal3/admin_bar');
                }
            
		}
	}
}
