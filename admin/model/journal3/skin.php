<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Skin extends Model {

	public function all($filters = array()) {
		$filter_sql = "";

		if ($filter = Arr::get($filters, 'filter')) {
			$filter_sql .= " WHERE `skin_name` LIKE '%{$this->dbEscape($filter)}%'";
		}

		$order_sql = "ORDER BY skin_name";

		$page = (int)Arr::get($filters, 'page');
		$limit = (int)Arr::get($filters, 'limit');

		if ($page || $limit) {
			if ($page < 1) {
				$page = 1;
			}

			if ($limit < 1) {
				$limit = 10;
			}

			$order_sql .= ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;
		}

		$sql = "
			FROM
				`{$this->dbPrefix('journal3_skin')}`
				{$filter_sql}						
		";

		$count = (int)$this->db->query("SELECT COUNT(*) AS total {$sql}")->row['total'];

		$result = array();

		if ($count) {
			$query = $this->db->query("
				SELECT
					* 
				{$sql} 
				{$order_sql}
			");

			foreach ($query->rows as $row) {
				$result[] = array(
					'id'   => $row['skin_id'],
					'name' => $row['skin_name'],
				);
			}
		}

		return array(
			'count' => $count,
			'items' => $result,
		);
	}

	public function get($id) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_skin')}`
			WHERE 
				`skin_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Skin not found!');
		}

		$skin_name = $query->row['skin_name'];

		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_skin_setting')}`
			WHERE 
				`skin_id` = '{$this->dbEscapeInt($id)}'
		");

		$result = array();

		foreach ($query->rows as $value) {
			$result['general'][$value['setting_name']] = $this->decode($value['setting_value'], $value['serialized']);
		}

		$result['general']['skinName'] = $skin_name;

		return $result;
	}

	public function add($data) {
		$name = Arr::get($data, 'general.skinName');

		$query = $this->db->query("
			SELECT
				COUNT(*) AS total 
			FROM
				`{$this->dbPrefix('journal3_skin')}` 
			WHERE
				`skin_name` = '{$this->dbEscape($name)}'
		");

		if ($query->row['total'] > 0) {
			throw new Exception("Skin name already exists!");
		}

		$this->db->query("
			INSERT INTO `{$this->dbPrefix('journal3_skin')}` (
				`skin_name`
			) VALUES (
				'{$this->dbEscape($name)}'
			)
		");

		$id = $this->db->getLastId();

		foreach ($data['general'] as $key => $value) {
			$serialized = is_scalar($value) ? 0 : 1;

			$this->db->query("
				INSERT INTO `{$this->dbPrefix('journal3_skin_setting')}` (
					`skin_id`,
					`setting_name`,
					`setting_value`,
					`serialized`
				) VALUES (
					'{$this->dbEscapeInt($id)}',
					'{$this->dbEscape($key)}',
					'{$this->dbEscape($this->encode($value, $serialized))}',
					'{$this->dbEscapeInt($serialized)}'
				)
			");
		}

		return (string)$id;
	}

	public function edit($id, $data) {
		$name = Arr::get($data, 'general.skinName');

		$query = $this->db->query("
			SELECT
				COUNT(*) AS total 
			FROM
				`{$this->dbPrefix('journal3_skin')}` 
			WHERE
				`skin_name` = '{$this->dbEscape($name)}'
				AND `skin_id` != '{$this->dbEscapeInt($id)}'
		");

		if ($query->row['total'] > 0) {
			throw new Exception("Skin name already exists!");
		}

		$this->db->query("
			UPDATE `{$this->dbPrefix('journal3_skin')}` 
			SET 
				`skin_name` = '{$this->dbEscape($name)}'
			WHERE `skin_id` = '{$this->dbEscapeInt($id)}'
		");

		foreach ($data['general'] as $key => $value) {
			$serialized = is_scalar($value) ? 0 : 1;

			$this->db->query("
				INSERT INTO `{$this->dbPrefix('journal3_skin_setting')}` (
					`skin_id`,
					`setting_name`,
					`setting_value`,
					`serialized`
				) VALUES (
					'{$this->dbEscapeInt($id)}',
					'{$this->dbEscape($key)}',
					'{$this->dbEscape($this->encode($value, $serialized))}',
					'{$this->dbEscapeInt($serialized)}'
				) ON DUPLICATE KEY UPDATE 
					`setting_value` = '{$this->dbEscape($this->encode($value, $serialized))}',
					`serialized` = '{$this->dbEscapeInt($serialized)}'
			");
		}

		return $this->get($id);
	}

	public function copy($id) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_skin')}`
			WHERE 
				`skin_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Skin not found!');
		}

		$data = $this->get($id);

		$data['general']['skinName'] = $query->row['skin_name'] . ' Copy';

		return $this->add($data);
	}

	public function remove($id) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_skin')}`
			WHERE 
				`skin_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Skin not found!');
		}

		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('journal3_skin')}`
			WHERE 
				`skin_id` = '{$this->dbEscapeInt($id)}'
		");

		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('journal3_skin_setting')}`
			WHERE 
				`skin_id` = '{$this->dbEscapeInt($id)}'
		");
	}

	public function load() {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_setting')}`
			WHERE
				`setting_name` = 'active_skin'
		");

		$results = array();

		foreach ($query->rows as $row) {
			$results['store_' . $row['store_id']] = $row['setting_value'];
		}

		if (!count($results)) {
			$results = new stdClass();
		}

		return $results;
	}

	public function save($data) {
		foreach ($data as $key => $value) {
			$store_id = str_replace('store_', '', $key);

			$this->db->query("
				INSERT INTO `{$this->dbPrefix('journal3_setting')}` (
					`store_id`,
					`setting_group`,
					`setting_name`,
					`setting_value`,
					`serialized`
				) VALUES (
					'{$this->dbEscapeInt($store_id)}',
					'active_skin',
					'active_skin',
					'{$this->dbEscapeInt($value)}',
					'0'
				) ON DUPLICATE KEY UPDATE
					`setting_value` = '{$this->dbEscapeInt($value)}',
					`serialized` = '0'
			");
		}

		return null;
	}

	public function reset($id) {
		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('journal3_skin_setting')}`
			WHERE
				`skin_id` = {$this->dbEscapeInt($id)}
			");

		return null;
	}

}
