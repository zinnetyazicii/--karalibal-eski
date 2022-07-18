<?php

use Journal3\Utils\Arr;

class ModelJournal3Settings extends \Journal3\Opencart\Model {

	public function getVariables() {
		$query = $this->db->query("
			SELECT
                *
            FROM
                `{$this->dbPrefix('journal3_variable')}`
		");

		$results = array();

		foreach ($query->rows as $row) {
			$results[$row['variable_type']]['__VAR__' . $row['variable_name']] = $this->decode($row['variable_value'], $row['serialized']);
		}

		$query = $this->db->query("
			SELECT
                *
            FROM
                `{$this->dbPrefix('journal3_style')}`
		");

		foreach ($query->rows as $row) {
			$values = $this->decode($row['style_value'], $row['serialized']);

			foreach ($values as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $k => $v) {
						if ($v === '') {
							unset($values[$key][$k]);
						}
					}
				}

			}

			$results[$row['style_type']]['__VAR__' . $row['style_name']] = $values;
		}

		return $results;
	}

	public function getSettings() {
		$results = array();

		// global settings

		$query = $this->db->query("
			SELECT
                setting_name,
                setting_value,
                serialized
            FROM
                `{$this->dbPrefix('journal3_setting')}`
            WHERE
            	`store_id` = '0'
                OR `store_id` = '{$this->config->get('config_store_id')}'
			ORDER BY 
				store_id ASC
		");

		foreach ($query->rows as $row) {
			$results[$row['setting_name']] = $this->decode($row['setting_value'], $row['serialized']);
		}

		$skin_id = Arr::get($results, 'active_skin', 0);

		// skin settings

		$query = $this->db->query("
			SELECT
                setting_name,
                setting_value,
                serialized
            FROM
                `{$this->dbPrefix('journal3_skin_setting')}`
            WHERE
                `skin_id` = '{$this->dbEscapeInt($skin_id)}'
		");

		foreach ($query->rows as $row) {
			$results[$row['setting_name']] = $this->decode($row['setting_value'], $row['serialized']);
		}

		return $results;
	}

	public function updateSetting($key, $value) {
		if ($this->journal3->isAdmin()) {
			$this->db->query("
				UPDATE
					`{$this->dbPrefix('journal3_skin_setting')}`
				SET
					`setting_value` = '{$this->dbEscape($value)}'
				WHERE
					`skin_id` = '{$this->dbEscapeInt($this->journal3->settings->get('active_skin'))}'
					AND `setting_name` = '{$this->dbEscape($key)}'
			");
		}
	}

	public function haveSkins() {
		$query = $this->db->query("
			SELECT
                count(*) AS total
            FROM
                `{$this->dbPrefix('journal3_skin')}`
		");

		return $query->row['total'] > 0;
	}

}
