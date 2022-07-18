<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3BlogCategory extends Model {

	public function all($filters = array()) {
		$filter_sql = "";

		if ($filter = Arr::get($filters, 'filter')) {
			$filter_sql .= " AND cd.`name` LIKE '%{$this->dbEscape($filter)}%'";
		}

		$order_sql = "ORDER BY cd.name";

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
				`{$this->dbPrefix('journal3_blog_category')}` c
			LEFT JOIN 
				`{$this->dbPrefix('journal3_blog_category_description')}` cd ON c.category_id = cd.category_id
			WHERE
				(cd.`language_id` = '{$this->dbEscapeInt($this->config->get('config_language_id'))}' OR cd.`language_id` IS NULL)
				{$filter_sql}						
		";

		$count = (int)$this->db->query("SELECT COUNT(*) AS total {$sql}")->row['total'];

		$result = array();

		if ($count) {
			$query = $this->db->query("
				SELECT
					c.category_id,
					cd.name 
				{$sql} 
				GROUP BY 
					c.`category_id`
				{$order_sql}
			");

			foreach ($query->rows as $row) {
				$result[] = array(
					'id'   => $row['category_id'],
					'name' => $row['name'],
				);
			}
		}

		return array(
			'count' => $count,
			'items' => $result,
		);
	}

	/**
	 * @throws Exception
	 */
	public function get($id) {
		$query1 = $this->db->query("
            SELECT
                parent_id,
                image,
                status,
                sort_order
            FROM 
            	`{$this->dbPrefix('journal3_blog_category')}`
            WHERE 
            	`category_id` = '{$this->dbEscapeInt($id)}'
        ");

		if ($query1->num_rows === 0) {
			throw new Exception('Category not found!');
		}

		$query2 = $this->db->query("
            SELECT
                language_id,
                name,
                description,
                meta_title,
                meta_keywords,
                meta_description,
                keyword
            FROM
            	`{$this->dbPrefix('journal3_blog_category_description')}`
            WHERE
            	`category_id` = '{$this->dbEscapeInt($id)}'
        ");

		$query3 = $this->db->query("
            SELECT
                store_id,
                layout_id
            FROM
            	`{$this->dbPrefix('journal3_blog_category_to_layout')}`
            WHERE
            	`category_id` = '{$this->dbEscapeInt($id)}'
        ");

		$query4 = $this->db->query("
            SELECT
                store_id
            FROM
            	`{$this->dbPrefix('journal3_blog_category_to_store')}`
            WHERE
            	`category_id` = '{$this->dbEscapeInt($id)}'
        ");

		$result = array(
			'name'             => array(),
			'description'      => array(),
			'meta_title'       => array(),
			'meta_keywords'    => array(),
			'meta_description' => array(),
			'keyword'          => array(),
			'parent_id'        => $query1->row['parent_id'],
			'image'            => $query1->row['image'],
			'status'           => str_replace(array('0', '1'), array('false', 'true'), $query1->row['status']),
			'sort_order'       => $query1->row['sort_order'] ? $query1->row['sort_order'] : '',
			'layouts'          => array(),
			'store_ids'        => array(),
		);

		foreach ($query2->rows as $row) {
			$result['name']['lang_' . $row['language_id']] = $row['name'];
			$result['description']['lang_' . $row['language_id']] = $row['description'];
			$result['meta_title']['lang_' . $row['language_id']] = $row['meta_title'];
			$result['meta_keywords']['lang_' . $row['language_id']] = $row['meta_keywords'];
			$result['meta_description']['lang_' . $row['language_id']] = $row['meta_description'];
			$result['keyword']['lang_' . $row['language_id']] = $row['keyword'];
		}

		foreach ($query3->rows as $row) {
			$result['layouts']['store_' . $row['store_id']] = $row['layout_id'];
		}

		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();

		$result['stores']['store_0'] = 'false';

		foreach ($stores as $store) {
			$result['stores']['store_' . $store['store_id']] = 'false';
		}

		foreach ($query4->rows as $row) {
			$result['stores']['store_' . $row['store_id']] = 'true';
		}

		foreach ($result as &$value) {
			if (is_array($value) && !$value) {
				$value = new stdClass();
			}
		}

		return $result;
	}

	public function add($data) {
		$this->db->query("
            INSERT INTO `{$this->dbPrefix('journal3_blog_category')}` (
            	parent_id,
            	image,
            	status,
            	sort_order
			) VALUES (
				'{$this->dbEscapeInt(Arr::get($data, 'parent_id', ''))}',
				'{$this->dbEscape(Arr::get($data, 'image', ''))}',
				'{$this->dbEscape(Arr::get($data, 'status') === 'true' ? 1 : 0)}',
				'{$this->dbEscape(Arr::get($data, 'sort_order'))}'
			)
        ");

		$id = $this->db->getLastId();

		$this->_edit($id, $data);

		return $id;
	}

	public function edit($id, $data) {
		$this->db->query("
            UPDATE `{$this->dbPrefix('journal3_blog_category')}`
            SET
                parent_id = '{$this->dbEscapeInt(Arr::get($data, 'parent_id', ''))}',
                image = '{$this->dbEscape(Arr::get($data, 'image', ''))}',
                status = '{$this->dbEscape(str_replace(array('true', 'false'), array('1', '0'), Arr::get($data, 'status')))}',
                sort_order = '{$this->dbEscape(Arr::get($data, 'sort_order'))}'
            WHERE
            	category_id = '{$this->dbEscapeInt($id)}'
        ");

		$this->_edit($id, $data);

		return null;
	}

	private function _edit($id, $data) {
		$this->db->query("DELETE FROM `{$this->dbPrefix('journal3_blog_category_description')}` WHERE category_id = '{$this->dbEscapeInt($id)}'");
		$this->db->query("DELETE FROM `{$this->dbPrefix('journal3_blog_category_to_layout')}` WHERE category_id = '{$this->dbEscapeInt($id)}'");
		$this->db->query("DELETE FROM `{$this->dbPrefix('journal3_blog_category_to_store')}` WHERE category_id = '{$this->dbEscapeInt($id)}'");

		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();

		foreach ($languages as $language) {
			$this->db->query("
                INSERT INTO `{$this->dbPrefix('journal3_blog_category_description')}` (
                	category_id,
                	language_id,
                	name,
                	description,
                	meta_title,
                	meta_keywords,
                	meta_description,
                	keyword
				) VALUES (
                	'{$this->dbEscapeInt($id)}',
                	'{$this->dbEscapeInt($language['language_id'])}',
                	'{$this->dbEscape(Arr::get($data, 'name.lang_' . $language['language_id']))}',
                	'{$this->dbEscape(Arr::get($data, 'description.lang_' . $language['language_id']))}',
                	'{$this->dbEscape(Arr::get($data, 'meta_title.lang_' . $language['language_id']))}',
                	'{$this->dbEscape(Arr::get($data, 'meta_keywords.lang_' . $language['language_id']))}',
                	'{$this->dbEscape(Arr::get($data, 'meta_description.lang_' . $language['language_id']))}',
                	'{$this->dbEscape(Arr::get($data, 'keyword.lang_' . $language['language_id']))}'
                )
            ");
		}

		foreach (Arr::get($data, 'layouts', array()) as $store_id => $layout_id) {
			$store_id = str_replace('store_', '', $store_id);

			$this->db->query("
				INSERT INTO `{$this->dbPrefix('journal3_blog_category_to_layout')}` (
					category_id,
					store_id,
					layout_id
				) VALUES (
					'{$this->dbEscapeInt($id)}',
					'{$this->dbEscapeInt($store_id)}',
					'{$this->dbEscapeInt($layout_id)}'
				)
			");
		}

		foreach (Arr::get($data, 'stores', array()) as $store_id => $value) {
			if ($value === 'true') {
				$store_id = str_replace('store_', '', $store_id);

				$this->db->query("
                    INSERT INTO `{$this->dbPrefix('journal3_blog_category_to_store')}` (
                    	category_id,
                    	store_id
					) VALUES (
						'{$this->dbEscapeInt($id)}',
						'{$this->dbEscapeInt($store_id)}'
					)
				");
			}
		}
	}

	/**
	 * @throws Exception
	 */
	public function copy($id) {
		$data = $this->get($id);

		foreach ($data['name'] as &$name) {
			$name .= ' Copy';
		}

		return $this->add($data);
	}

	public function remove($id) {
		$this->db->query("DELETE FROM `{$this->dbPrefix('journal3_blog_category')}` WHERE category_id = {$this->dbEscapeInt($id)}");
		$this->db->query("DELETE FROM `{$this->dbPrefix('journal3_blog_category_description')}` WHERE category_id = {$this->dbEscapeInt($id)}");
		$this->db->query("DELETE FROM `{$this->dbPrefix('journal3_blog_category_to_layout')}` WHERE category_id = {$this->dbEscapeInt($id)}");
		$this->db->query("DELETE FROM `{$this->dbPrefix('journal3_blog_category_to_store')}` WHERE category_id = {$this->dbEscapeInt($id)}");
		$this->db->query("DELETE FROM `{$this->dbPrefix('journal3_blog_post_to_category')}` WHERE category_id = {$this->dbEscapeInt($id)}");
	}

}
