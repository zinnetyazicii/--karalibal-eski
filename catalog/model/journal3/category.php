<?php

use Journal3\Utils\Arr;
use Journal3\Utils\Request;

class ModelJournal3Category extends \Journal3\Opencart\Model {

	private static $category_tree;

	private function buildCategoryTree($categories, $parent_id = 0, $path = '') {
		$branch = array();

		foreach ($categories as $category) {
			if ($category['parent_id'] == $parent_id) {
				$href = $path ? ($path . '_' . $category['category_id']) : $category['category_id'];

				$category['items'] = $this->buildCategoryTree($categories, $category['category_id'], $href);

				$branch[$category['category_id']] = $category;

				$branch[$category['category_id']]['classes'] = array(
					'menu-item menu-item-c' . $category['category_id'],
					'dropdown' => $category['items'],
				);

				$branch[$category['category_id']]['link']['href'] = $this->url->link('product/category', 'path=' . $href, Request::isHttps());

				$branch[$category['category_id']]['link']['total'] = Arr::get($category, 'total');

				$branch[$category['category_id']]['link']['classes'] = array();

				unset($branch[$category['category_id']]['total']);

				static::$category_tree[$category['category_id']] = $branch[$category['category_id']];
			}
		}

		return $branch;
	}

	private function getCategoryTree($category_id) {
		if (static::$category_tree === null) {
			static::$category_tree = array();

			$sql = "
				SELECT
					c.category_id,
					c.parent_id,
					cd.name as title
			";

			if ($this->config->get('config_product_count')) {
				$sql .= ", (
					SELECT
						COUNT(p.product_id)
					FROM " . DB_PREFIX . "product_to_category p2c
					LEFT JOIN " . DB_PREFIX . "product p ON (p.product_id = p2c.product_id)
					LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id)
					WHERE
						p.status = '1'
						AND p.date_available <= NOW()
						AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
						AND p2c.category_id = c.category_id) as total
				";
			}

			$sql .= "
				FROM " . DB_PREFIX . "category c
				LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id)
				LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id)
				WHERE 
					cd.language_id = '" . (int)$this->config->get('config_language_id') . "'
					AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
					AND c.status = '1'
				ORDER BY
					c.sort_order, LCASE(cd.name)
			";

			$query = $this->db->query($sql);

			$this->buildCategoryTree($query->rows);
		}

		if ($category_id) {
			return Arr::get(static::$category_tree, $category_id);
		}

		return array_filter(static::$category_tree, function ($value) {
			return $value['parent_id'] == 0;
		});
	}

	public function getSubcategories($category_id) {
		$cache_key = implode('.', array(
			'product',
			'categories',
			$this->journal3->getLanguageId(),
			$this->journal3->getStoreId(),
			(int)$category_id,
		));

		$categories = $this->journal3->cache->get($cache_key);

		if (!$categories) {
			$categories = $this->getCategoryTree($category_id);

			$this->journal3->cache->set($cache_key, $categories);
		}

		return $categories;
	}

	public function getTotalCategories($parent_id) {
		$sql = "
			SELECT COUNT(*) AS total
			FROM `{$this->dbPrefix('category')}` c 
			LEFT JOIN `{$this->dbPrefix('category_description')}` cd ON (c.category_id = cd.category_id) 
			LEFT JOIN `{$this->dbPrefix('category_to_store')}` c2s ON (c.category_id = c2s.category_id) 
			WHERE 
				c.parent_id = '{$this->dbEscapeInt($parent_id)}' 
				AND cd.language_id = '{$this->dbEscapeInt($this->config->get('config_language_id'))}' 
				AND c2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'  
				AND c.status = '1'
		";

		return $this->db->query($sql)->row['total'];
	}

	public function getCategories($parent_id, $limit = 5, $top_only = false) {
		$sql = "
			SELECT *
			FROM `{$this->dbPrefix('category')}` c 
			LEFT JOIN `{$this->dbPrefix('category_description')}` cd ON (c.category_id = cd.category_id) 
			LEFT JOIN `{$this->dbPrefix('category_to_store')}` c2s ON (c.category_id = c2s.category_id) 
			WHERE 				 
				cd.language_id = '{$this->dbEscapeInt($this->config->get('config_language_id'))}' 
				AND c2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'  
				AND c.status = '1'
		";

		if ($top_only) {
			$sql .= " AND c.top = 1";
		} else {
			$sql .= " AND c.parent_id = '{$this->dbEscapeInt($parent_id)}'";
		}

		$sql .= "				
			ORDER BY
				c.sort_order, LCASE(cd.name)
		";

		if ($limit) {
			$sql .= " LIMIT 0, {$this->dbEscapeNat($limit)} ";
		}

		return $this->db->query($sql)->rows;
	}
}
