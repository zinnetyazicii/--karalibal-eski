<?php

namespace Journal3\Opencart;

class Model extends \Model implements Autocomplete {

	public static $REPL = array(
		'search'  => array("\n", "\r", "\t"),
		'replace' => array('[~nl~]', '[~nr~]', '[~nt~]'),
	);

	protected function dbPrefix($table) {
		return $this->dbEscape(DB_PREFIX . $table);
	}

	protected function dbEscape($value) {
		if (is_array($value)) {
			return implode(', ', array_map(function ($val) {
				return "'{$this->db->escape($val)}'";
			}, $value));
		}

		return $this->db->escape($value);
	}

	protected function dbEscapeInt($value) {
		if (is_array($value)) {
			return implode(', ', array_map(function ($val) {
				return (int)$val;
			}, $value));
		}

		return (int)$value;
	}

	protected function dbEscapeNat($value) {
		if (is_array($value)) {
			return implode(', ', array_map(function ($val) {
				return abs((int)$val);
			}, $value));
		}

		return abs((int)$value);
	}

	protected function dbQuery($sql, $tag = null) {
		try {
			return $this->db->query($sql);
		} catch (\Exception $e) {
			if ($this->journal3->isDev()) {
				die ("
				<h1>DB Exception!</h1>
				<h4>{$e->getMessage()}</h4>
				<hr/>
				<pre>{$sql}</pre>
				<hr/>
				<pre>{$e->getTraceAsString()}</pre>
			");
			} else {
				throw $e;
			}
		}
	}

	protected function dbTableExists($table) {
		return $this->dbQuery("SHOW TABLES LIKE '{$this->dbPrefix($table)}'")->num_rows > 0;
	}

	protected function encode($value, $serialized) {
		if ($serialized) {
			return json_encode($this->escape($value));
		}

		return $value;
	}

	protected function decode($value, $serialized) {
		if ($serialized) {
			return $this->unescape(json_decode($value, true));
		}

		return $value;
	}

	private function escape($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$data[$key] = $this->escape($value);
			}
		} else {
			$data = str_replace(static::$REPL['search'], static::$REPL['replace'], $data);
		}

		return $data;
	}

	private function unescape($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$data[$key] = $this->unescape($value);
			}
		} else {
			$data = str_replace(static::$REPL['replace'], static::$REPL['search'], $data);
		}

		return $data;
	}

}
