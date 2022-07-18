<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Variable extends Model {

	public function all($filters = array()) {
		$filter_sql = "";

		$filter_sql .= "`variable_type` = '{$this->dbEscape(Arr::get($filters, 'type'))}'";

		if ($filter = Arr::get($filters, 'filter')) {
			$filter_sql .= " AND `variable_name` LIKE '%{$this->dbEscape($filter)}%'";
		}

		$order_sql = "";

		if (in_array(Arr::get($filters, 'type', ''), array('breakpoint', 'font_size', 'value'))) {
			$order_sql = 'ORDER BY length(variable_value), variable_value';
		} else {
			$order_sql = 'ORDER BY variable_label';
		}

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
				`{$this->dbPrefix('journal3_variable')}`
			WHERE
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
					'id'    => $row['variable_name'],
					'name'  => $row['variable_name'],
					'label' => $row['variable_label'] ? $row['variable_label'] : $row['variable_name'],
				);
			}
		}

		return array(
			'count' => $count,
			'items' => $result,
		);
	}

	public function get($id, $type) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_variable')}`
			WHERE 
				`variable_name` = '{$this->dbEscape($id)}'
				AND `variable_type` = '{$this->dbEscape($type)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Variable not found!');
		}

		return array(
			'name'  => $query->row['variable_name'],
			'label' => $query->row['variable_label'] ? $query->row['variable_label'] : $query->row['variable_name'],
			'value' => $this->decode($query->row['variable_value'], $query->row['serialized']),
		);
	}

	public function add($type, $data) {
		$name = Arr::get($data, 'name');
		$label = Arr::get($data, 'label');
		$value = Arr::get($data, 'value');
		$serialized = is_scalar($value) ? 0 : 1;
		$value = $this->encode($value, $serialized);

		$query = $this->db->query("
			SELECT
				COUNT(*) AS total 
			FROM
				`{$this->dbPrefix('journal3_variable')}` 
			WHERE
				`variable_name` = '{$this->dbEscape($name)}'
				AND `variable_type` = '{$this->dbEscape($type)}'
		");

		if ($query->row['total'] > 0) {
			throw new Exception("Variable name already exists!");
		}

		$this->db->query("
			INSERT INTO `{$this->dbPrefix('journal3_variable')}` (
				`variable_name`,
				`variable_label`,
				`variable_type`,
				`variable_value`,
				`serialized`
			) VALUES (
				'{$this->dbEscape($name)}',
				'{$this->dbEscape($label)}',
				'{$this->dbEscape($type)}',
				'{$this->dbEscape($value)}',
				'{$this->dbEscapeInt($serialized)}'
			)
		");

		return $name;
	}

	public function edit($id, $type, $data) {
		$name = Arr::get($data, 'name');
		$label = Arr::get($data, 'label');
		$value = Arr::get($data, 'value');
		$serialized = is_scalar($value) ? 0 : 1;
		$value = $this->encode($value, $serialized);

		$query = $this->db->query("
			SELECT 
				COUNT(*) AS total 
			FROM 
				`{$this->dbPrefix('journal3_variable')}` 
			WHERE
				`variable_name` != '{$this->dbEscape($id)}'
				AND `variable_type` = '{$this->dbEscape($type)}' 
				AND `variable_name` = '{$this->dbEscape($name)}'
		");

		if ($query->row['total'] > 0) {
			throw new Exception("Variable name already exists!");
		}

		$this->db->query("
			UPDATE `{$this->dbPrefix('journal3_variable')}` 
			SET 
				`variable_name` = '{$this->dbEscape($name)}',
				`variable_label` = '{$this->dbEscape($label)}',
				`variable_value` = '{$this->dbEscape($value)}',
				`serialized` = '{$this->dbEscapeInt($serialized)}'
			WHERE
				`variable_name` = '{$this->dbEscape($id)}'
				AND `variable_type` = '{$this->dbEscape($type)}'
		");

		return $this->get($name, $type);
	}

	public function copy($id, $type) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_variable')}`
			WHERE 
				`variable_name` = '{$this->dbEscape($id)}'
				AND `variable_type` = '{$this->dbEscape($type)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Variable not found!');
		}

		$type = $query->row['variable_type'];

		$data = array(
			'name'  => $query->row['variable_name'] . '_COPY',
			'label' => $query->row['variable_label'],
			'value' => $this->decode($query->row['variable_value'], $query->row['serialized']),
		);

		return $this->add($type, $data);
	}

	public function remove($id, $type) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_variable')}`
			WHERE 
				`variable_name` = '{$this->dbEscape($id)}'
				AND `variable_type` = '{$this->dbEscape($type)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Variable not found!');
		}

		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('journal3_variable')}`
			WHERE 
				`variable_name` = '{$this->dbEscape($id)}'
				AND `variable_type` = '{$this->dbEscape($type)}'
		");
	}

}
