<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Newsletter extends Model {

	private $stores;

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('setting/store');

		$this->stores = array(0 => $this->config->get('config_name'));

		foreach ($this->model_setting_store->getStores() as $store) {
			$this->stores[$store['store_id']] = $store['name'];
		}
	}

	public function getTotalSubscribers() {
		$sql = 'SELECT COUNT(*) AS total FROM ((SELECT email FROM ' . DB_PREFIX . 'customer WHERE newsletter = 1) UNION (SELECT email FROM ' . DB_PREFIX . 'journal3_newsletter)) TEMP';

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getSubscribers($data = array()) {
		$sql = 'SELECT email, status, store_id FROM ((SELECT email, 1 as status, store_id FROM ' . DB_PREFIX . 'customer WHERE newsletter = 1) UNION (SELECT email, 0 as status, store_id FROM ' . DB_PREFIX . 'journal3_newsletter)) TEMP';

		$sql .= ' ORDER BY email ASC';

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		foreach ($query->rows as &$row) {
			$row['store'] = isset($this->stores[$row['store_id']]) ? $this->stores[$row['store_id']] : $this->stores[0];
		}

		return $query->rows;
	}

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
				`{$this->dbPrefix('journal3_newsletter')}`
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
					'id'       => $row['newsletter_id'],
					'name'     => $row['name'],
					'email'    => $row['email'],
					'ip'       => $row['ip'],
					'store_id' => $row['store_id'],
				);
			}
		}

		return array(
			'count' => $count,
			'items' => $result,
		);
	}

	public function unsubscribe($email) {
		$this->dbQuery("DELETE FROM `{$this->dbPrefix('journal3_newsletter')}` WHERE email = '{$this->dbEscape($email)}'");
	}

}
