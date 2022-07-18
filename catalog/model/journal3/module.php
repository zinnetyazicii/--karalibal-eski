<?php

use Journal3\Opencart\Model;

class ModelJournal3Module extends Model {

	public function get($module_id, $module_type) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "journal3_module` WHERE `module_id` = '" . (int)$module_id . "'");

		return $query->num_rows && $query->row['module_type'] === $module_type ? $this->decode($query->row['module_data'], true) : array();
	}

	public function getByType($module_type) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "journal3_module` WHERE `module_type` = '" . $this->dbEscape($module_type) . "'");

		$results = array();

		foreach ($query->rows as $row) {
			$results[$row['module_id']] = $this->decode($row['module_data'], true);
		}

		return $results;
	}

}
