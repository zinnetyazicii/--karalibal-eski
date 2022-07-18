<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class ModelJournal3BlogComment extends Model {

	private static $SORTS = array(
		'name' => 'pd.name',
	);

	public function all($filters = array()) {
		$filter_sql = "";

		if ($filter = Arr::get($filters, 'filter')) {
			$filter_sql .= " AND (
				pd.`name` LIKE '%{$this->dbEscape($filter)}%'
				OR bc.`name` LIKE '%{$this->dbEscape($filter)}%'
				OR bc.`email` LIKE '%{$this->dbEscape($filter)}%'
			)
			";
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
				`{$this->dbPrefix('journal3_blog_comments')}` bc
			LEFT JOIN 
				`{$this->dbPrefix('journal3_blog_post')}` p ON p.post_id = bc.post_id
			LEFT JOIN 
				`{$this->dbPrefix('journal3_blog_post_description')}` pd ON p.post_id = pd.post_id
			WHERE
				(pd.`language_id` = '{$this->dbEscapeInt($this->config->get('config_language_id'))}' OR pd.`language_id` IS NULL)
				{$filter_sql}						
		";

		$count = (int)$this->db->query("SELECT COUNT(*) AS total {$sql}")->row['total'];

		$result = array();

		if ($count) {
			$query = $this->db->query("
				SELECT
					bc.comment_id,
                    bc.name as author,
                    pd.name as post_name,
                    bc.parent_id as parent_id,
                    bc.status as status 
				{$sql} 
				GROUP BY 
					bc.`comment_id`
				{$order_sql}
			");

			foreach ($query->rows as $row) {
				$result[] = array(
					'id'     => $row['comment_id'],
					'name'   => $row['author'] ? $row['author'] . ' @ ' . $row['post_name'] : $row['post_name'],
					'status' => (int)$row['status'],
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
		$query = $this->db->query("
            SELECT
                *
            FROM 
            	`{$this->dbPrefix('journal3_blog_comments')}`
            WHERE 
            	`comment_id` = '{$this->dbEscapeInt($id)}'
        ");

		if ($query->num_rows === 0) {
			throw new Exception('Comment not found!');
		}


		$result = array(
			'name'    => $query->row['name'],
			'email'   => $query->row['email'],
			'website' => $query->row['website'],
			'comment' => $query->row['comment'],
			'status'  => Str::toBool($query->row['status']),
		);

		return $result;
	}

	public function edit($id, $data) {
		$this->db->query("
            UPDATE `{$this->dbPrefix('journal3_blog_comments')}`
            SET
            	name = '{$this->dbEscape(Arr::get($data, 'name', ''))}',
                email = '{$this->dbEscape(Arr::get($data, 'email', ''))}',
                website = '{$this->dbEscape(Arr::get($data, 'website', ''))}',
                comment = '{$this->dbEscape(Arr::get($data, 'comment', ''))}',
                status = '{$this->dbEscape(Str::fromBool(Arr::get($data, 'status')))}'
            WHERE
            	comment_id = '{$this->dbEscapeInt($id)}'
        ");

		return null;
	}

	public function remove($id) {
		$this->db->query("DELETE FROM `{$this->dbPrefix('journal3_blog_comments')}` WHERE comment_id = {$this->dbEscapeInt($id)}");
	}

}
