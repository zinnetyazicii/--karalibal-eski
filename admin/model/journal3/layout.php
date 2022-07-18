<?php

use Journal3\Utils\Arr;

class ModelJournal3Layout extends \Journal3\Opencart\Model {

	public function all($filters = array()) {
		$filter_sql = "";

		if ($filter = Arr::get($filters, 'filter')) {
			$filter_sql .= " WHERE `name` LIKE '%{$this->dbEscape($filter)}%'";
		}

		$order_sql = "ORDER BY name";

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
				`{$this->dbPrefix('layout')}`
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
					'id'   => $row['layout_id'],
					'name' => $row['name'],
				);
			}
		}

		return array(
			'count' => $count,
			'items' => $result,
		);
	}

	public function get($id) {
		$layout = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('layout')}`
			WHERE 
				`layout_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($layout->num_rows === 0) {
			throw new Exception('Layout not found!');
		}

		$query = $this->db->query("
			SELECT
				layout_id,
				layout_data
			FROM
				`{$this->dbPrefix('journal3_layout')}`
			WHERE 
				`layout_id` = '{$this->dbEscapeInt($id)}'
				OR `layout_id` = -1
			ORDER BY
				`layout_id` DESC
		");

		$result = array();

		if ($query->num_rows) {
			foreach ($query->rows as $row) {
				if ($row['layout_id'] > 0) {
					$data = $this->decode($row['layout_data'], true);
				} else {
					$data = array(
						'positions' => array(
							'global' => $this->decode($row['layout_data'], true),
						),
					);
				}

				$result = Arr::merge($result, $data);
			}
		}

		$result['layout_name'] = $layout->row['name'];

		return $result;
	}

	public function add($data) {
		$global = $data['positions']['global'];

		unset($data['positions']['global']);

		$name = $data['layout_name'];

		unset($data['layout_name']);

		$this->db->query("
			INSERT INTO `{$this->dbPrefix('layout')}` 
			SET name = '{$this->dbEscape($name)}'
		");

		$id = $this->db->getLastId();

		$this->db->query("
			INSERT INTO `{$this->dbPrefix('journal3_layout')}`
                (`layout_id`, `layout_data`)
            VALUES
                ('{$this->dbEscapeInt($id)}', '{$this->dbEscape($this->encode($data, true))}')
            ON DUPLICATE KEY UPDATE
                `layout_data` = '{$this->dbEscape($this->encode($data, true))}'
		");

		/* @todo check global */

//		$this->db->query("
//			INSERT INTO `{$this->dbPrefix('journal3_layout')}`
//                (`layout_id`, `layout_data`)
//            VALUES
//                ('-1', '{$this->dbEscape($this->encode($global, true))}')
//            ON DUPLICATE KEY UPDATE
//                `layout_data` = '{$this->dbEscape($this->encode($global, true))}'
//		");

		return (string)$id;
	}

	public function edit($id, $data) {
		$global = $data['positions']['global'];

		unset($data['positions']['global']);

		$name = $data['layout_name'];

		unset($data['layout_name']);

		$this->db->query("
			UPDATE `{$this->dbPrefix('layout')}` 
			SET name = '{$this->dbEscape($name)}' 
			WHERE layout_id = '{$this->dbEscapeInt($id)}'
		");

		$this->db->query("
			INSERT INTO `{$this->dbPrefix('journal3_layout')}`
                (`layout_id`, `layout_data`)
            VALUES
                ('{$this->dbEscapeInt($id)}', '{$this->dbEscape($this->encode($data, true))}')
            ON DUPLICATE KEY UPDATE
                `layout_data` = '{$this->dbEscape($this->encode($data, true))}'
		");

		$this->db->query("
			INSERT INTO `{$this->dbPrefix('journal3_layout')}`
                (`layout_id`, `layout_data`)
            VALUES
                ('-1', '{$this->dbEscape($this->encode($global, true))}')
            ON DUPLICATE KEY UPDATE
                `layout_data` = '{$this->dbEscape($this->encode($global, true))}'
		");

		return $this->get($id);
	}

	public function copy($id) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('layout')}`
			WHERE 
				`layout_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Layout not found!');
		}

		$data = $this->get($id);

		$data['layout_name'] = $query->row['name'] . ' Copy';

		return $this->add($data);
	}

	public function remove($id) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('layout')}`
			WHERE 
				`layout_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Layout not found!');
		}

		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('layout')}`
			WHERE 
				`layout_id` = '{$this->dbEscapeInt($id)}'
		");

		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('layout_route')}`
			WHERE 
				`layout_id` = '{$this->dbEscapeInt($id)}'
		");

		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('layout_module')}`
			WHERE 
				`layout_id` = '{$this->dbEscapeInt($id)}'
		");

		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('journal3_layout')}`
			WHERE 
				`layout_id` = '{$this->dbEscapeInt($id)}'
		");
	}

}
