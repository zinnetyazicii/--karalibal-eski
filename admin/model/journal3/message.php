<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Message extends Model {

	public function all($filters = array()) {
		$filter_sql = "";

		if ($filter = Arr::get($filters, 'filter')) {
			$filter_sql .= " WHERE `email` LIKE '%{$this->dbEscape($filter)}%'";
		}

		$order_sql = "ORDER BY email";

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
				`{$this->dbPrefix('journal3_message')}`
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
					'id'     => $row['message_id'],
					'name'   => $row['name'],
					'email'  => $row['email'],
					'fields' => $this->decode($row['fields'], true),
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
				`{$this->dbPrefix('journal3_message')}`
			WHERE 
				`message_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Message not found!');
		}

		$data = $query->row;
		$data['fields'] = array();

		foreach ($this->decode($query->row['fields'], true) as $field) {
			if (is_array($field['value'])) {
				$field['value'] = implode(', ', $field['value']);
			}
			$data['fields'][] = $field;
		}

		return $data;
	}

	public function remove($id) {
		$query = $this->db->query("
			SELECT
				*
			FROM
				`{$this->dbPrefix('journal3_message')}`
			WHERE 
				`message_id` = '{$this->dbEscapeInt($id)}'
		");

		if ($query->num_rows === 0) {
			throw new Exception('Message not found!');
		}

		$this->db->query("
			DELETE FROM
				`{$this->dbPrefix('journal3_message')}`
			WHERE 
				`message_id` = '{$this->dbEscapeInt($id)}'
		");
	}

}
