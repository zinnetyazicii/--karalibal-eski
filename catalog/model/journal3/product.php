<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Product extends Model {

	public function getProductIds($product_id) {
		if (is_array($product_id)) {
			$product_ids = array_map(function ($product_id) {
				return isset($product_id['product_id']) ? (int)$product_id['product_id'] : (int)$product_id;
			}, $product_id);
		} else {
			$product_ids = array_filter(array($product_id));
		}

		return $product_ids;
	}

	public function getProduct($product_id) {
		$product_ids = $this->getProductIds($product_id);

		if (!$product_ids) {
			return array();
		}

		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND pr.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' LIMIT 1) AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id IN (" . implode(',', $product_ids) . ") AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		$result = array_flip($product_ids);

		foreach ($query->rows as $row) {
			$result[$row['product_id']] = array(
				'product_id'       => $row['product_id'],
				'name'             => $row['name'],
				'description'      => $row['description'],
				'meta_title'       => $row['meta_title'],
				'meta_description' => $row['meta_description'],
				'meta_keyword'     => $row['meta_keyword'],
				'tag'              => $row['tag'],
				'model'            => $row['model'],
				'sku'              => $row['sku'],
				'upc'              => $row['upc'],
				'ean'              => $row['ean'],
				'jan'              => $row['jan'],
				'isbn'             => $row['isbn'],
				'mpn'              => $row['mpn'],
				'location'         => $row['location'],
				'quantity'         => $row['quantity'],
				'stock_status'     => $row['stock_status'],
				'image'            => $row['image'],
				'manufacturer_id'  => $row['manufacturer_id'],
				'manufacturer'     => $row['manufacturer'],
				'price'            => ($row['discount'] ? $row['discount'] : $row['price']),
				'special'          => $row['special'],
				'reward'           => $row['reward'],
				'points'           => $row['points'],
				'tax_class_id'     => $row['tax_class_id'],
				'date_available'   => $row['date_available'],
				'weight'           => $row['weight'],
				'weight_class_id'  => $row['weight_class_id'],
				'length'           => $row['length'],
				'width'            => $row['width'],
				'height'           => $row['height'],
				'length_class_id'  => $row['length_class_id'],
				'subtract'         => $row['subtract'],
				'rating'           => round($row['rating']),
				'reviews'          => $row['reviews'] ? $row['reviews'] : 0,
				'minimum'          => $row['minimum'],
				'sort_order'       => $row['sort_order'],
				'status'           => $row['status'],
				'date_added'       => $row['date_added'],
				'date_modified'    => $row['date_modified'],
				'viewed'           => $row['viewed'],
			);
		}

		if (count($result) !== $query->num_rows) {
			$result = array_filter($result, function ($res) {
				return isset($res['product_id']) && $res['product_id'];
			});
		}

		return $result;
	}

	public function getProductsSecondImage() {
		$cache_key = 'product.image';

		$results = $this->journal3->cache->get($cache_key);

		if ($results === false) {
			$results = array();

			$query = $this->db->query("
			  	SELECT
			  		product_id,
			  		image
				FROM {$this->dbPrefix('product_image')}
				WHERE sort_order = (
					SELECT MIN(sort_order) 
					FROM {$this->dbPrefix('product_image')} AS p 
					WHERE p.product_id = {$this->dbPrefix('product_image')}.product_id
				)
			");

			foreach ($query->rows as $row) {
				if (!isset($results[$row['product_id']])) {
					$results[$row['product_id']] = $row['image'];
				}
			}

			$this->journal3->cache->set($cache_key, $results);
		}

		return $results;
	}

	public function getProductsCountdown() {
		if ($this->customer->isLogged()) {
			$customer_group_id = version_compare(VERSION, '2', '>=') ? $this->customer->getGroupId() : $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$cache_key = 'product.countdown.' . $customer_group_id;

		$results = $this->journal3->cache->get($cache_key);

		if ($results === false) {
			$results = array();

			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special ps WHERE ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND ps.date_end != '0000-00-00' AND ps.date_end > NOW()) GROUP BY ps.product_id ORDER BY ps.priority ASC, ps.price ASC");

			foreach ($query->rows as $row) {
				$results[$row['product_id']] = date('D M d Y H:i:s O', strtotime($row['date_end']));
			}

			$this->journal3->cache->set($cache_key, $results);
		}

		return $results;
	}

	public function getProductOptionValues($product_id, $product_options) {
		if (!$product_options) {
			return array();
		}

		$sql = array();

		foreach ($product_options as $product_option_id => $product_option_values) {
			$values = is_array($product_option_values) ? "IN ({$this->dbEscapeInt($product_option_values)})" : "= {$this->dbEscapeInt($product_option_values)}";
			$sql[] = "(product_option_id = {$this->dbEscapeInt($product_option_id)} AND product_option_value_id $values)";
		}

		$sql = implode(' OR ', $sql);

		$sql = "SELECT * FROM {$this->dbPrefix('product_option_value')} WHERE product_id = {$this->dbEscapeInt($product_id)} AND $sql";

		return $this->db->query($sql)->rows;
	}

	public function getRelatedProducts($product_id, $limit) {
		$product_ids = $this->getProductIds($product_id);

		if (!$product_ids) {
			return array();
		}

		$sql = "
			SELECT * 
			FROM `{$this->dbPrefix('product_related')}` pr 
			LEFT JOIN `{$this->dbPrefix('product')}` p ON (pr.related_id = p.product_id) 
			LEFT JOIN `{$this->dbPrefix('product_to_store')}` p2s ON (p.product_id = p2s.product_id) 
			WHERE 
				pr.product_id IN (" . implode(', ', $product_ids) . ") 
				AND p.status = '1'
				AND p.date_available <= NOW()
				AND p2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'
		";

		if ($this->journal3->settings->get('filterCheckQuantity')) {
			$sql .= ' AND p.quantity > 0';
		}

		if ($limit) {
			$sql .= " LIMIT 0, {$this->dbEscapeNat($limit)}";
		}

		$query = $this->db->query($sql);

		return $this->getProduct($query->rows);
	}

	public function getRelatedProductsByCategory($product_id, $limit) {
		$product_ids = $this->getProductIds($product_id);

		if (!$product_ids) {
			return array();
		}

		$category_ids = array();

		if (Arr::get($this->request->get, 'path')) {
			$category_ids = explode('_', $this->request->get['path']);
			$category_ids = end($category_ids);
			$category_ids = array(
				$this->dbEscapeInt($category_ids),
			);
		} else {
			$sql = "
				SELECT
					c.category_id
				FROM `{$this->dbPrefix('category')}` c 
				LEFT JOIN `{$this->dbPrefix('category_to_store')}` c2s ON (c.category_id = c2s.category_id) 
				LEFT JOIN `{$this->dbPrefix('product_to_category')}` p2c ON (c.category_id = p2c.category_id)
				LEFT JOIN `{$this->dbPrefix('product')}` p ON (p2c.product_id = p.product_id) 
				LEFT JOIN `{$this->dbPrefix('product_to_store')}` p2s ON (p.product_id = p2s.product_id)
				WHERE 
					p2c.product_id IN (" . implode(', ', $product_ids) . ") 
					AND c.status = '1'
					AND c2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'
					AND p.status = '1'
					AND p.date_available <= NOW()
					AND p2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'
				GROUP BY
					c.category_id
			";

			$query = $this->db->query($sql);

			if (!$query->num_rows) {
				return array();
			}

			foreach ($query->rows as $row) {
				$category_ids[] = $row['category_id'];
			}
		}

		$sql = "
			SELECT * 
			FROM `{$this->dbPrefix('product')}` p
			LEFT JOIN `{$this->dbPrefix('product_description')}` pd ON (p.product_id = pd.product_id)
			LEFT JOIN `{$this->dbPrefix('product_to_store')}` p2s ON (p.product_id = p2s.product_id)
			LEFT JOIN `{$this->dbPrefix('product_to_category')}` p2c ON (p.product_id = p2c.product_id)
			LEFT JOIN `{$this->dbPrefix('category')}` c ON (c.category_id = p2c.category_id) 
			LEFT JOIN `{$this->dbPrefix('category_to_store')}` c2s ON (c.category_id = c2s.category_id)
			WHERE 
				c.category_id IN (" . implode(', ', $category_ids) . ") 
				AND p.status = '1'
				AND p.date_available <= NOW()
				AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
				AND p2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'
				AND c.status = '1'
				AND c2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'
				AND p.product_id != '{$this->dbEscapeInt($product_id)}'
		";

		if ($this->journal3->settings->get('filterCheckQuantity')) {
			$sql .= ' AND p.quantity > 0';
		}

		$sql .= "
			ORDER BY p.sort_order ASC, LCASE(pd.name) ASC
		";

		if ($limit) {
			$sql .= " LIMIT 0, {$this->dbEscapeNat($limit)}";
		}

		$query = $this->db->query($sql);

		return $this->getProduct($query->rows);
	}

	public function getRelatedProductsByManufacturer($product_id, $limit) {
		$product_ids = $this->getProductIds($product_id);

		if (!$product_ids) {
			return array();
		}

		$sql = "
			SELECT manufacturer_id 
			FROM `{$this->dbPrefix('product')}` p
			WHERE 
				p.product_id IN (" . implode(', ', $product_ids) . ") 
		";

		$query = $this->db->query($sql);

		if (!$query->num_rows) {
			return array();
		}

		$manufacturer_id = $query->row['manufacturer_id'];

		if (!$manufacturer_id) {
			return array();
		}

		$sql = "
			SELECT * 
			FROM `{$this->dbPrefix('product')}` p
			LEFT JOIN `{$this->dbPrefix('product_description')}` pd ON (p.product_id = pd.product_id)
			LEFT JOIN `{$this->dbPrefix('product_to_store')}` p2s ON (p.product_id = p2s.product_id)
			WHERE 
				p.manufacturer_id = '{$this->dbEscapeInt($manufacturer_id)}' 
				AND p.status = '1'
				AND p.date_available <= NOW()
				AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
				AND p2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'
				AND p.product_id != '{$this->dbEscapeInt($product_id)}'
		";

		if ($this->journal3->settings->get('filterCheckQuantity')) {
			$sql .= ' AND p.quantity > 0';
		}

		$sql .= "
			ORDER BY p.sort_order ASC, LCASE(pd.name) ASC
		";

		if ($limit) {
			$sql .= " LIMIT 0, {$this->dbEscapeNat($limit)}";
		}

		$query = $this->db->query($sql);

		return $this->getProduct($query->rows);
	}

	public function getAlsoBoughtProducts($product_id, $limit = 5) {
		$product_ids = $this->getProductIds($product_id);

		if (!$product_ids) {
			return array();
		}

		$sql = "
			SELECT
				DISTINCT op1.product_id
			FROM `{$this->dbPrefix('order_product')}` op1
			LEFT JOIN `{$this->dbPrefix('order_product')}` op2 ON op1.order_id = op2.order_id
			LEFT JOIN `{$this->dbPrefix('product')}` p ON (op1.product_id = p.product_id) 
			LEFT JOIN `{$this->dbPrefix('product_to_store')}` p2s ON (p.product_id = p2s.product_id)
			WHERE
				op2.product_id IN (" . implode(', ', $product_ids) . ")
				AND op1.product_id NOT IN (" . implode(', ', $product_ids) . ")
				AND p.status = '1'
				AND p.date_available <= NOW()
				AND p2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'			 
		";

		if ($this->journal3->settings->get('filterCheckQuantity')) {
			$sql .= ' AND p.quantity > 0';
		}

		if ($limit) {
			$sql .= " LIMIT 0, {$this->dbEscapeNat($limit)}";
		}

		$query = $this->db->query($sql);

		return $this->getProduct($query->rows);
	}

	public function addRecentlyViewedProduct($product_id) {
		$recently_viewed = Arr::get($this->session->data, 'jrv', explode(',', Arr::get($this->request->cookie, 'jrv', '')));

		$recently_viewed = array_filter($recently_viewed, function ($id) use ($product_id) {
			return $id && $id != $product_id;
		});

		array_unshift($recently_viewed, $product_id);

		$recently_viewed = array_splice($recently_viewed, 0, 20);

		$this->session->data['jrv'] = $recently_viewed;

		// setcookie('jrv', implode(',', $recently_viewed), time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
		setcookie('jrv', implode(',', $recently_viewed), time() + 60 * 60 * 24 * 30);
	}

	public function getRecentlyViewedProducts($limit = 5) {
		$recently_viewed = Arr::get($this->session->data, 'jrv', explode(',', Arr::get($this->request->cookie, 'jrv', '')));

		$product_ids = $this->getProductIds($recently_viewed);

		if (!$product_ids) {
			return array();
		}

		$sql = "
			SELECT
				p.product_id
			FROM `{$this->dbPrefix('product')}` p 
			LEFT JOIN `{$this->dbPrefix('product_to_store')}` p2s ON (p.product_id = p2s.product_id)
			WHERE
				p.product_id IN (" . implode(', ', $product_ids) . ")
				AND p.status = '1'
				AND p.date_available <= NOW()
				AND p2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'
		";

		if ($this->journal3->settings->get('filterCheckQuantity')) {
			$sql .= ' AND p.quantity > 0';
		}

		$query = $this->db->query($sql);

		$products = $this->getProduct($query->rows);

		$results = array();

		foreach ($product_ids as $product_id) {
			if ($product = Arr::get($products, $product_id)) {
				$results[$product_id] = $product;
			}
		}

		if ($limit) {
			$results = array_splice($results, 0, $this->dbEscapeNat($limit));
		}

		return $results;
	}

	public function getMostViewedProducts($limit = 5) {
		$sql = "
			SELECT
				p.product_id
			FROM `{$this->dbPrefix('product')}` p 
			LEFT JOIN `{$this->dbPrefix('product_to_store')}` p2s ON (p.product_id = p2s.product_id)
			WHERE
				p.status = '1'
				AND p.date_available <= NOW()
				AND p2s.store_id = '{$this->dbEscapeInt($this->config->get('config_store_id'))}'			
		";

		if ($this->journal3->settings->get('filterCheckQuantity')) {
			$sql .= ' AND p.quantity > 0';
		}

		$sql .= "
			ORDER BY viewed DESC
		";

		if ($limit) {
			$sql .= " LIMIT 0, {$this->dbEscapeNat($limit)}";
		}

		$query = $this->db->query($sql);

		return $this->getProduct($query->rows);
	}

	public function getProductsSold($product_id) {
		$sql = "
			SELECT 
				SUM(op.quantity) AS quantity 
			FROM `{$this->dbPrefix('order_product')}` op 
			LEFT JOIN `{$this->dbPrefix('order')}` o ON op.order_id = o.order_id 
			WHERE o.order_status_id <> 0 AND op.product_id = '{$this->dbEscapeInt($product_id)}'
		";

		return (int)$this->dbQuery($sql)->row['quantity'];
	}

	public function getTotalProducts($filter_data) {
		$this->model_journal3_filter->setFilterData($filter_data);

		return $this->model_journal3_filter->getTotalProducts();
	}

	public function getProducts($filter_data) {
		return $this->model_journal3_filter->getProducts($filter_data);
	}

}
