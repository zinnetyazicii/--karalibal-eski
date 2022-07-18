<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Module extends Model {

	private static $SORTS = array(
		'name' => 'module_name',
	);

	public function all($filters = array()) {
		$filter_sql = "";

		$filter_sql .= "`module_type` = '{$this->dbEscape(Arr::get($filters, 'type'))}'";

		if ($filter = Arr::get($filters, 'filter')) {
			$filter_sql .= " AND `module_name` LIKE '%{$this->dbEscape($filter)}%'";
		}

		$order_sql = "";

		if (($sort = Arr::get($filters, 'sort')) !== null) {
			$sort = Arr::get(static::$SORTS, $sort);

			if ($sort) {
				$order_sql .= " ORDER BY {$this->dbEscape($sort)}";

				if (($sort = Arr::get($filters, 'sort')) === 'desc') {
					$order_sql .= ' DESC';
				} else {
					$order_sql .= ' ASC';
				}
			}
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
				`{$this->dbPrefix('journal3_module')}`
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
					'id'   => $row['module_id'],
					'name' => $row['module_name'],
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
				`{$this->dbPrefix('journal3_module')}`
			WHERE 
				`module_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Module not found!');
		}

		return $this->decode($query->row['module_data'], true);
	}

	public function add($type, $data) {
		$name = Arr::get($data, 'general.name');

		$query = $this->db->query("
			SELECT
				COUNT(*) AS total 
			FROM
				`{$this->dbPrefix('journal3_module')}` 
			WHERE
				`module_name` = '{$this->dbEscape($name)}'
				AND `module_type` = '{$this->dbEscape($type)}'
		");

		if ($query->row['total'] > 0) {
			throw new Exception("Module name already exists!");
		}

		$this->db->query("
			INSERT INTO `{$this->dbPrefix('journal3_module')}` (
				`module_name`,
				`module_type`,
				`module_data`
			) VALUES (
				'{$this->dbEscape($name)}',
				'{$this->dbEscape($type)}',
				'{$this->dbEscape($this->encode($data, true))}'
			)
		");

		return (string)$this->db->getLastId();
	}

	public function edit($id, $type, $data) {
		$name = Arr::get($data, 'general.name');

		$query = $this->db->query("
			SELECT 
				COUNT(*) AS total 
			FROM 
				`{$this->dbPrefix('journal3_module')}` 
			WHERE 
				`module_name` = '{$this->dbEscape($name)}'
				AND `module_type` = '{$this->dbEscape($type)}'
				AND `module_id` != '{$this->dbEscapeInt($id)}'
		");

		if ($query->row['total'] > 0) {
			throw new Exception("Module name already exists!");
		}

		$this->db->query("
			UPDATE `{$this->dbPrefix('journal3_module')}` 
			SET 
				`module_name` = '{$this->dbEscape($name)}',
				`module_data` = '{$this->dbEscape($this->encode($data, true))}'
			WHERE `module_id` = '{$this->dbEscapeInt($id)}'
		");

		return $this->get($id);
	}

	public function copy($id) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_module')}`
			WHERE 
				`module_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Module not found!');
		}

		$type = $query->row['module_type'];

		$data = $this->decode($query->row['module_data'], true);
		$data['general']['name'] = $data['general']['name'] . ' Copy';

		return $this->add($type, $data);
	}

	public function remove($id) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_module')}`
			WHERE 
				`module_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Module not found!');
		}

		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('journal3_module')}`
			WHERE 
				`module_id` = '{$this->dbEscapeInt($id)}'
		");
	}

	public function explodeAttributeValues($separator) {
		$this->db->query("TRUNCATE TABLE `{$this->dbPrefix('journal3_product_attribute')}`");

		$attribute_values = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('product_attribute')}`
		")->rows;

		$insert_values = array();

		foreach ($attribute_values as $attribute_value) {
			$values = explode($separator, $attribute_value['text']);

			foreach ($values as $value) {
				$value = trim($value);

				if ($value) {
					$insert_values[] = " (
						'{$attribute_value['product_id']}',
						'{$attribute_value['attribute_id']}',
						'{$attribute_value['language_id']}',
						'{$this->dbEscape($value)}',
						'0'
					) ";
				}
			}
		}

		$insert_values = array_chunk($insert_values, 500);

		foreach ($insert_values as $insert_value) {
			$sql = "
				INSERT IGNORE INTO `{$this->dbPrefix('journal3_product_attribute')}` (
					`product_id`,
					`attribute_id`,
					`language_id`,
					`text`,
					`sort_order`
				) VALUES " . implode(',', $insert_value);
			try {
				$this->db->query($sql);
			} catch (Exception $e) {
			}
		}

	}

}
