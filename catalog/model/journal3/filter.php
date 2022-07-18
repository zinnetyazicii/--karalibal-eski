<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Filter extends Model {

	private $config_customer_group_id;
	private $config_language_id;
	private $config_store_id;
	private $config_tax;

	private static $SORT = array(
		'pd.name',
		'p.model',
		'p.quantity',
		'p.price',
		'rating',
		'p.sort_order',
		'p.date_added',
		'random',
		'p.viewed',
		'sales',
	);

	private static $ORDER = array(
		'ASC',
		'DESC',
	);

	private static $filter_data = null;

	public function __construct($registry) {
		parent::__construct($registry);

		$this->config_customer_group_id = $this->customer->isLogged() ? $this->customer->getGroupId() : $this->config->get('config_customer_group_id');
		$this->config_language_id = $this->config->get('config_language_id');
		$this->config_tax = $this->config->get('config_tax');
		$this->config_store_id = $this->config->get('config_store_id');

		$this->load->model('journal3/product');
	}

	public function filterBase() {
		switch (Arr::get($this->request->get, 'route')) {
			case 'product/catalog':
				return $this->url->link('product/catalog', '', true);

			case 'product/category':
				return $this->url->link('product/category', 'path=' . Arr::get($this->request->get, 'path'), true);

			case 'product/manufacturer/info':
				return $this->url->link('product/manufacturer/info', 'manufacturer_id=' . Arr::get($this->request->get, 'manufacturer_id'), true);

			case 'product/search':
				$url = '';

				if (isset($this->request->get['search'])) {
					$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
				}

				if (isset($this->request->get['tag'])) {
					$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
				}

				if (isset($this->request->get['description'])) {
					$url .= '&description=' . $this->request->get['description'];
				}

				if (isset($this->request->get['category_id'])) {
					$url .= '&category_id=' . $this->request->get['category_id'];
				}

				if (isset($this->request->get['sub_category'])) {
					$url .= '&sub_category=' . $this->request->get['sub_category'];
				}

				return $this->url->link('product/search', $url, true);

			case 'product/special':
				return $this->url->link('product/special', '', true);

			default:
				return null;
		}
	}

	public function parseFilterData() {
		$separator = $this->journal3->settings->get('filterUrlValuesSeparator');

		if (!$separator) {
			$separator = ',';
		}

		$filter_data = array();

		foreach ($this->request->get as $k => $v) {
			if ($k[0] !== 'f') {
				continue;
			}

			switch ($k) {
				case 'fmin';
					$filter_data['price']['min'] = (float)$v;
					break;

				case 'fmax';
					$filter_data['price']['max'] = (float)$v;
					break;

				case 'fc';
					$filter_data['categories'] = array_map('intval', explode($separator, $v));
					break;

				case 'fm';
					$filter_data['manufacturers'] = array_map('intval', explode($separator, $v));
					break;

				case 'fq';
					$filter_data['availability'] = array_map('intval', explode($separator, $v));
					break;

				case 'fr';
					$filter_data['ratings'] = array_map('intval', explode($separator, $v));
					break;

				case 'ft';
					$filter_data['tags'] = explode($separator, $v);
					break;

				default:
					switch (substr($k, 0, 2)) {
						case 'fa';
							$filter_data['attributes'][(int)substr($k, 2)] = explode($separator, $v);
							break;

						case 'fo';
							$filter_data['options'][(int)substr($k, 2)] = explode($separator, $v);
							break;

						case 'ff';
							$filter_data['filters'][(int)substr($k, 2)] = explode($separator, $v);
							break;
					}
			}
		}

		return $filter_data;
	}

	public function buildFilterData($filter_data) {
		$separator = $this->journal3->settings->get('filterUrlValuesSeparator');

		if (!$separator) {
			$separator = ',';
		}

		$result = array();

		foreach ($filter_data as $k => $v) {
			switch ($k) {
				case 'price':
					if (isset($v['min'])) {
						$result['fmin'] = $v['min'];
					}

					if (isset($v['max'])) {
						$result['fmax'] = $v['max'];
					}
					break;

				case 'categories':
					$result['fc'] = implode($separator, $v);
					break;

				case 'manufacturers':
					$result['fm'] = implode($separator, $v);
					break;

				case 'availability':
					$result['fq'] = implode($separator, $v);
					break;

				case 'ratings':
					$result['fr'] = implode($separator, $v);
					break;

				case 'tags':
					$result['ft'] = implode($separator, $v);
					break;

				case 'attributes':
					foreach ($v as $kk => $vv) {
						array_walk($vv, function (&$item) {
							$item = htmlspecialchars_decode($item);
						});
						$result['fa' . $kk] = implode($separator, $vv);
					}
					break;

				case 'options':
					foreach ($v as $kk => $vv) {
						$result['fo' . $kk] = implode($separator, $vv);
					}
					break;

				case 'filters':
					foreach ($v as $kk => $vv) {
						$result['ff' . $kk] = implode($separator, $vv);
					}
					break;
			}
		}

		if (!$result) {
			return null;
		}

		return '&' . rawurldecode(http_build_query($result));
	}

	public function setFilterData($filter_data) {
		static::$filter_data = $filter_data;
	}

	public function getFilterData() {
		return static::$filter_data;
	}

	public function hasFilterData($key, $value = null) {
		$values = Arr::get(static::$filter_data, $key);

		if ($value === null) {
			return $values !== null;
		}

		if (!is_array($values)) {
			return $values === $value;
		}

		return in_array($value, $values);
	}

	public function getPriceRange() {
		$discount = "
			(
				SELECT price 
				FROM `" . DB_PREFIX . "product_discount` pd2 
				WHERE 
					pd2.product_id = p.product_id 
					AND pd2.customer_group_id = '" . (int)$this->config_customer_group_id . "' 
					AND pd2.quantity = '1' 
					AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) 
					AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) 
				ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1
			)
		";

		$special = "
			(
				SELECT price 
				FROM `" . DB_PREFIX . "product_special` ps 
				WHERE 
					ps.product_id = p.product_id 
					AND ps.customer_group_id = '" . (int)$this->config_customer_group_id . "' 
					AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) 
					AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) 
				ORDER BY ps.priority ASC, ps.price ASC LIMIT 1
			)
		";

		$sql = "
			SELECT
				MIN(COALESCE(" . $special . ", " . $discount . ", p.price)) AS min,
				MAX(COALESCE(" . $special . ", " . $discount . ", p.price)) AS max
			FROM `" . DB_PREFIX . "product` p			
		";

		$sql .= $this->addFilters(static::$filter_data, 'price');

		$row = $this->dbQuery($sql, 'PRICE')->row;

		return array(
			'min' => floor($this->applyTax($row['min'])),
			'max' => ceil($this->applyTax($row['max'])),
		);
	}

	public function getCategories() {
		$sql = "
			SELECT
				MAX(c.category_id) id, 
				MAX(cd.name) value,
				MAX(c.image) image,
				COUNT(*) total 
			FROM `{$this->dbPrefix('category')}` c 
			LEFT JOIN `{$this->dbPrefix('category_description')}` cd ON (c.category_id = cd.category_id) 
			LEFT JOIN `{$this->dbPrefix('category_to_store')}` c2s ON (c.category_id = c2s.category_id) 
			LEFT JOIN `{$this->dbPrefix('product_to_category')}`p2c ON (c.category_id = p2c.category_id)  
			LEFT JOIN `{$this->dbPrefix('product')}` p ON (p.product_id = p2c.product_id)
		";

		$sql .= $this->addFilters(static::$filter_data, 'category');

		$sql .= " 
			AND cd.language_id = '" . (int)$this->config_language_id . "' 
			AND c2s.store_id = '" . (int)$this->config_store_id . "' 
			AND c.status = '1'
		";

		if (is_numeric($filter_category_id = Arr::get(static::$filter_data, 'filter_category_id'))) {
			$sql .= " AND c.parent_id = '" . $this->db->escape($filter_category_id) . "'";
		}

		$sql .= " 
			GROUP BY c.category_id 
			HAVING COUNT(*) > 0 
			ORDER BY c.sort_order, LCASE(cd.name) ASC
		";

		return $this->dbQuery($sql, 'CATEGORIES')->rows;
	}

	public function getManufacturers() {
		if (Arr::get(static::$filter_data, 'filter_manufacturer_id')) {
			return array();
		}

		$sql = "
			SELECT 
				max(m.manufacturer_id) id, 
				MAX(m.name) value, 
				MAX(m.image) image, 
				COUNT(*) total 
			FROM `" . DB_PREFIX . "manufacturer` m 
			LEFT JOIN `" . DB_PREFIX . "manufacturer_to_store` m2s ON (m.manufacturer_id = m2s.manufacturer_id) 
			LEFT JOIN `" . DB_PREFIX . "product` p ON (p.manufacturer_id = m.manufacturer_id)
		";

		$sql .= $this->addFilters(static::$filter_data, 'manufacturer');

		$sql .= " AND m2s.store_id = '" . (int)$this->config_store_id . "'";

		$sql .= " 
			GROUP BY m.manufacturer_id 
			HAVING COUNT(*) > 0 
			ORDER BY m.sort_order ASC, m.name ASC
		";

		return $this->dbQuery($sql, 'MANUFACTURERS')->rows;
	}

	public function getAttributes() {
		$attribute_table = $this->journal3->settings->get('filterAttributeValuesSeparator') ? 'journal3_product_attribute' : 'product_attribute';

		$sql = "
			SELECT 
				MAX(a.attribute_id) attribute_id, 
				MAX(ad.name) attribute_name, 
				MAX(pa.text) value, 
				COUNT(*) total 
			FROM `" . DB_PREFIX . "product` p
			LEFT JOIN `" . DB_PREFIX . $attribute_table . "` pa ON (p.product_id = pa.product_id)
			LEFT JOIN `" . DB_PREFIX . "attribute` a ON (a.attribute_id = pa.attribute_id) 
			LEFT JOIN `" . DB_PREFIX . "attribute_description` ad ON (ad.attribute_id = a.attribute_id)
		";

		$sql .= $this->addFilters(static::$filter_data, 'ATTRIBUTES');

		$sql .= "
				AND pa.language_id = '" . (int)$this->config_language_id . "' 
				AND ad.language_id = '" . (int)$this->config_language_id . "' 
			GROUP BY lower(pa.text), a.attribute_id 
			HAVING COUNT(*) > 0
		";

		$query = $this->dbQuery($sql, 'attributes');

		$results = array();

		foreach ($query->rows as $row) {
			if (!isset($results[$row['attribute_id']])) {
				$results[$row['attribute_id']] = array(
					'attribute_id'   => $row['attribute_id'],
					'attribute_name' => $row['attribute_name'],
					'values'         => array(),
				);
			}
			$results[$row['attribute_id']]['values'][$row['value']] = array(
				'id'    => $row['value'],
				'value' => $row['value'],
				'total' => $row['total'],
			);
		}

		if (isset(static::$filter_data['attributes'])) {
			foreach (static::$filter_data['attributes'] as $attribute_id => $attribute) {
				$filter_data = static::$filter_data;
				unset($filter_data['attributes'][$attribute_id]);

				$sql = "
					SELECT 
						MAX(a.attribute_id) attribute_id, 
						MAX(ad.name) attribute_name, 
						MAX(pa.text) value, 
						COUNT(*) total 
					FROM `" . DB_PREFIX . "product` p
					LEFT JOIN `" . DB_PREFIX . $attribute_table . "` pa ON (p.product_id = pa.product_id)
					LEFT JOIN `" . DB_PREFIX . "attribute` a ON (a.attribute_id = pa.attribute_id) 
					LEFT JOIN `" . DB_PREFIX . "attribute_description` ad ON (ad.attribute_id = a.attribute_id)
				";

				$sql .= $this->addFilters($filter_data, 'ATTRIBUTES');

				$sql .= "
						AND pa.language_id = '" . (int)$this->config_language_id . "' 
						AND ad.language_id = '" . (int)$this->config_language_id . "' 
					GROUP BY lower(pa.text), a.attribute_id 
					HAVING COUNT(*) > 0
				";

				$query = $this->dbQuery($sql, 'attributes');

				foreach ($query->rows as $row) {
					if ($row['attribute_id'] == $attribute_id) {
						$results[$row['attribute_id']]['values'][$row['value']] = array(
							'id'    => $row['value'],
							'value' => $row['value'],
							'total' => $row['total'],
						);
					}
				}
			}
		}

		return $results;
	}

	public function getOptions() {
		$sql = "
			SELECT 
				MAX(pov.option_id) option_id, 
				MAX(od.name) option_name, 
				MAX(ovd.option_value_id) id, 
				MAX(ovd.name) value, 
				COUNT(*) total, 
				ov.image image
			FROM `" . DB_PREFIX . "product` p
			LEFT JOIN `" . DB_PREFIX . "product_option_value` pov ON (p.product_id = pov.product_id)
			LEFT JOIN `" . DB_PREFIX . "option_value` ov ON (pov.option_value_id = ov.option_value_id) 
			LEFT JOIN `" . DB_PREFIX . "option_value_description` ovd ON (pov.option_value_id = ovd.option_value_id) 
			LEFT JOIN `" . DB_PREFIX . "option_description` od ON (pov.option_id = od.option_id)
		";

		$sql .= $this->addFilters(static::$filter_data, 'options');

		$sql .= "
				AND od.language_id = '" . (int)$this->config_language_id . "' 
				AND ovd.language_id = '" . (int)$this->config_language_id . "'
		";

		if ($this->journal3->settings->get('filterCheckOptionsQuantity')) {
			$sql .= " AND pov.quantity > 0 ";
		}

		$sql .= "
			GROUP BY 
				pov.option_value_id 
			HAVING 
				COUNT(*) > 0 
			ORDER BY 
				ov.sort_order, ovd.name
		";

		$query = $this->dbQuery($sql, 'OPTIONS');

		$results = array();

		foreach ($query->rows as $row) {
			if (!isset($results[$row['option_id']])) {
				$results[$row['option_id']] = array(
					'option_id'   => $row['option_id'],
					'option_name' => $row['option_name'],
					'values'      => array(),
				);
			}
			$results[$row['option_id']]['values'][$row['id']] = array(
				'id'    => $row['id'],
				'value' => $row['value'],
				'image' => $row['image'],
				'total' => $row['total'],
			);
		}

		if (isset(static::$filter_data['options'])) {
			foreach (static::$filter_data['options'] as $option_id => $option) {
				$filter_data = static::$filter_data;
				unset($filter_data['options'][$option_id]);

				$sql = "
					SELECT 
						MAX(pov.option_id) option_id, 
						MAX(od.name) option_name, 
						MAX(ovd.option_value_id) id, 
						MAX(ovd.name) value, 
						COUNT(*) total, 
						ov.image image
					FROM `" . DB_PREFIX . "product` p
					LEFT JOIN `" . DB_PREFIX . "product_option_value` pov ON (p.product_id = pov.product_id)
					LEFT JOIN `" . DB_PREFIX . "option_value` ov ON (pov.option_value_id = ov.option_value_id) 
					LEFT JOIN `" . DB_PREFIX . "option_value_description` ovd ON (pov.option_value_id = ovd.option_value_id) 
					LEFT JOIN `" . DB_PREFIX . "option_description` od ON (pov.option_id = od.option_id)
				";

				$sql .= $this->addFilters($filter_data, 'options');

				$sql .= "
						AND od.language_id = '" . (int)$this->config_language_id . "' 
						AND ovd.language_id = '" . (int)$this->config_language_id . "'
				";

				if ($this->journal3->settings->get('filterCheckOptionsQuantity')) {
					$sql .= " AND pov.quantity > 0 ";
				}

				$sql .= "
					GROUP BY 
						pov.option_value_id 
					HAVING 
						COUNT(*) > 0 
					ORDER BY 
						ov.sort_order, ovd.name
				";

				$query = $this->dbQuery($sql, 'OPTIONS');

				foreach ($query->rows as $row) {
					if ($row['option_id'] == $option_id) {
						$results[$row['option_id']]['values'][$row['id']] = array(
							'id'    => $row['id'],
							'value' => $row['value'],
							'image' => $row['image'],
							'total' => $row['total'],
						);
					}
				}
			}
		}

		return $results;
	}

	public function getFilters($opts = array()) {
		$sql = "
			SELECT
				f.filter_id id,
				fd.name filter_name,
				fg.filter_group_id filter_group_id,
				fgd.name filter_group_name,
				COUNT(*) total
			FROM `" . DB_PREFIX . "product` p
			LEFT JOIN `" . DB_PREFIX . "product_filter` pf ON (p.product_id = pf.product_id)
			LEFT JOIN `" . DB_PREFIX . "filter` f ON (f.filter_id = pf.filter_id)
			LEFT JOIN `" . DB_PREFIX . "filter_description` fd ON (fd.filter_id = pf.filter_id)
			LEFT JOIN `" . DB_PREFIX . "filter_group` fg ON (fg.filter_group_id = fd.filter_group_id)
			LEFT JOIN `" . DB_PREFIX . "filter_group_description` fgd ON (fd.filter_group_id = fgd.filter_group_id)
		";

		if (($filter_category_id = (int)Arr::get(static::$filter_data, 'filter_category_id')) && Arr::get($opts, 'filtersCategoryCheck')) {
			$sql .= "
				LEFT JOIN `" . DB_PREFIX . "category_filter` cf ON (f.filter_id = cf.filter_id)
			";
		}

		$sql .= $this->addFilters(static::$filter_data, 'filters');

		if (($filter_category_id = (int)Arr::get(static::$filter_data, 'filter_category_id')) && Arr::get($opts, 'filtersCategoryCheck')) {
			$sql .= "
				AND cf.category_id = '" . (int)$filter_category_id . "'
			";
		}

		$sql .= "
				AND fd.language_id = '" . (int)$this->config_language_id . "' 
				AND fgd.language_id = '" . (int)$this->config_language_id . "'
			GROUP BY pf.filter_id 
			HAVING COUNT(*) > 0 
			ORDER BY 
				f.sort_order, fd.name
		";

		$query = $this->dbQuery($sql, 'FILTERS');

		$results = array();

		foreach ($query->rows as $row) {
			if (!isset($results[$row['filter_group_id']])) {
				$results[$row['filter_group_id']] = array(
					'filter_group_id'   => $row['filter_group_id'],
					'filter_group_name' => $row['filter_group_name'],
					'values'            => array(),
				);
			}
			$results[$row['filter_group_id']]['values'][$row['id']] = array(
				'id'    => $row['id'],
				'value' => $row['filter_name'],
				'total' => $row['total'],
			);
		}

		if (isset(static::$filter_data['filters'])) {
			foreach (static::$filter_data['filters'] as $filter_id => $filter) {
				$filter_data = static::$filter_data;
				unset($filter_data['filters'][$filter_id]);

				$sql = "
					SELECT
						f.filter_id id,
						fd.name filter_name,
						fg.filter_group_id filter_group_id,
						fgd.name filter_group_name,
						COUNT(*) total
					FROM `" . DB_PREFIX . "product` p
					LEFT JOIN `" . DB_PREFIX . "product_filter` pf ON (p.product_id = pf.product_id)
					LEFT JOIN `" . DB_PREFIX . "filter` f ON (f.filter_id = pf.filter_id)
					LEFT JOIN `" . DB_PREFIX . "filter_description` fd ON (fd.filter_id = pf.filter_id)
					LEFT JOIN `" . DB_PREFIX . "filter_group` fg ON (fg.filter_group_id = fd.filter_group_id)
					LEFT JOIN `" . DB_PREFIX . "filter_group_description` fgd ON (fd.filter_group_id = fgd.filter_group_id)
				";

				if (($filter_category_id = (int)Arr::get(static::$filter_data, 'filter_category_id')) && Arr::get($opts, 'filtersCategoryCheck')) {
					$sql .= "
						LEFT JOIN `" . DB_PREFIX . "category_filter` cf ON (f.filter_id = cf.filter_id)
					";
				}

				$sql .= $this->addFilters($filter_data, 'filters');

				if (($filter_category_id = (int)Arr::get(static::$filter_data, 'filter_category_id')) && Arr::get($opts, 'filtersCategoryCheck')) {
					$sql .= "
						AND cf.category_id = '" . (int)$filter_category_id . "'
					";
				}

				$sql .= "
						AND fd.language_id = '" . (int)$this->config_language_id . "' 
						AND fgd.language_id = '" . (int)$this->config_language_id . "'
					GROUP BY pf.filter_id 
					HAVING COUNT(*) > 0 
					ORDER BY 
						f.sort_order, fd.name
				";

				$query = $this->dbQuery($sql, 'FILTERS');


				foreach ($query->rows as $row) {
					if ($row['filter_group_id'] == $filter_id) {
						$results[$row['filter_group_id']]['values'][$row['id']] = array(
							'id'    => $row['id'],
							'value' => $row['filter_name'],
							'total' => $row['total'],
						);
					}
				}
			}
		}

		return $results;
	}

	public function getTags() {
		$sql = "
			SELECT tag 
			FROM `" . DB_PREFIX . "product` p
		";

		$sql .= $this->addFilters(static::$filter_data, 'tag');

		$query = $this->dbQuery($sql, 'TAGS');

		$results = array();

		foreach ($query->rows as $row) {
			foreach (explode(",", $row['tag']) as $value) {
				$value = trim($value);

				if (strlen($value) <= 1) {
					continue;
				}

				if (!isset($results[$value])) {
					$results[$value] = array(
						'id'    => $value,
						'value' => $value,
						'total' => 1,
					);
				} else {
					$results[$value]['total']++;
				}
			}
		}

		return $results;
	}

	public function getAvailability() {
		$sql = "
			SELECT 
				IF(p.quantity > 0, 1, 0) AS availability, 
				COUNT(*) AS total 
			FROM `" . DB_PREFIX . "product` p
		";

		$sql .= $this->addFilters(static::$filter_data, 'availability');

		$sql .= "
			GROUP BY
				CASE
					WHEN p.quantity > 0 THEN 1
					ELSE 0
				END				
		";

		$query = $this->dbQuery($sql, 'AVAILABILITY');

		$results = array(
			'instock'    => 0,
			'outofstock' => 0,
		);

		foreach ($query->rows as $row) {
			if ($row['availability'] == '1') {
				$results['instock'] = $row['total'];
			} else {
				$results['outofstock'] = $row['total'];
			}
		}

		return $results;
	}

	public function getProductIds($filter_data = null) {
		if ($filter_data === null) {
			$filter_data = static::$filter_data;
		}

		if (Arr::get($filter_data, 'sort') === 'ps.price') {
			$filter_data['sort'] = 'p.price';
		} else if (!in_array(Arr::get($filter_data, 'sort'), self::$SORT)) {
			$filter_data['sort'] = self::$SORT[0];
		}

		if (!in_array(Arr::get($filter_data, 'order'), self::$ORDER)) {
			$filter_data['order'] = self::$ORDER[0];
		}

		$sql = "
			SELECT 
				p.product_id, 
				(
					SELECT AVG(rating) total 
					FROM `" . DB_PREFIX . "review` r1 
					WHERE 
						r1.product_id = p.product_id 
						AND r1.status = '1' 
					GROUP BY r1.product_id
				) rating, 
				(
					SELECT price 
					FROM `" . DB_PREFIX . "product_discount` pd2 
					WHERE 
						pd2.product_id = p.product_id 
						AND pd2.customer_group_id = '" . (int)$this->config_customer_group_id . "' 
						AND pd2.quantity = '1' 
						AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) 
						AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) 
					ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1
				) discount, 
				(
					SELECT price 
					FROM `" . DB_PREFIX . "product_special` ps 
					WHERE 
						ps.product_id = p.product_id 
						AND ps.customer_group_id = '" . (int)$this->config_customer_group_id . "' 
						AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) 
						AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) 
					ORDER BY ps.priority ASC, ps.price ASC LIMIT 1
				) special,
				p.viewed 			
		";

		if (Arr::get($filter_data, 'sort') === 'sales') {
			$sql .= "
				, SUM(op.quantity) AS sales
				FROM `" . DB_PREFIX . "order_product` op
				LEFT JOIN `" . DB_PREFIX . "order` o ON (o.order_id = op.order_id)
				LEFT JOIN `" . DB_PREFIX . "product` p ON (p.product_id = op.product_id)
			";
		} else {
			$sql .= " FROM `" . DB_PREFIX . "product` p";
		}

		$sql .= $this->addFilters($filter_data);

		if (Arr::get($filter_data, 'bestseller')) {
			$sql .= " AND o.order_status_id > '0'";
		}

		$sql .= " GROUP BY p.product_id";

		if ($filter_data['sort'] === 'random') {
			$sql .= " ORDER BY RAND()";
		} else {
			if ($filter_data['sort'] === 'pd.name' || $filter_data['sort'] === 'p.model') {
				$sql .= " ORDER BY LCASE(" . $filter_data['sort'] . ")";
			} elseif ($filter_data['sort'] === 'p.price') {
				$sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
			} else {
				$sql .= " ORDER BY " . $filter_data['sort'];
			}

			if ($filter_data['order'] === 'DESC') {
				$sql .= " DESC, LCASE(pd.name) DESC";
			} else {
				$sql .= " ASC, LCASE(pd.name) ASC";
			}

		}

		$start = (int)Arr::get($filter_data, 'start', 0);
		$limit = (int)Arr::get($filter_data, 'limit', 0);

		if ($limit) {
			$sql .= " LIMIT {$this->dbEscapeNat($start)}, {$this->dbEscapeNat($limit)}";
		}

		return $this->dbQuery($sql, 'PRODUCTS')->rows;
	}

	public function getProducts($filter_data = null) {
		$products = $this->getProductIds($filter_data);

		$product_ids = array();

		foreach ($products as $product) {
			$product_ids[$product['product_id']] = (int)$product['product_id'];
		}

		return $this->model_journal3_product->getProduct($product_ids);
	}

	public function getTotalProducts() {
		$sql = "
			SELECT COUNT(DISTINCT p.product_id) total 
			FROM `" . DB_PREFIX . "product` p
		";

		$sql .= $this->addFilters(static::$filter_data);

		return $this->dbQuery($sql, 'TOTAL_PRODUCTS')->row['total'];
	}

	private function addFilters($filter_data, $query = null) {
		$sql = "";

		if ($query !== 'category' && (Arr::get($filter_data, 'categories') || Arr::get($filter_data, 'filter_category_id'))) {
			$sql .= " LEFT JOIN `" . DB_PREFIX . "product_to_category` p2c ON (p2c.product_id = p.product_id)";

			if (Arr::get($filter_data, 'filter_sub_category')) {
				$sql .= " LEFT JOIN `" . DB_PREFIX . "category_path` cp ON (cp.category_id = p2c.category_id)";
			}
		}

		$sql .= " 
			LEFT JOIN `" . DB_PREFIX . "product_description` pd ON (p.product_id = pd.product_id)
			LEFT JOIN `" . DB_PREFIX . "product_to_store` p2s ON (p.product_id = p2s.product_id)
			WHERE 
				p.status = '1' 
				AND p.date_available <= NOW() 
				AND p2s.store_id = '" . (int)$this->config_store_id . "'
				AND pd.language_id = '" . (int)$this->config_language_id . "'
		";

		if ($query !== 'category' && (Arr::get($filter_data, 'categories') || Arr::get($filter_data, 'filter_category_id'))) {
			if (Arr::get($filter_data, 'filter_sub_category')) {
				if (Arr::get($filter_data, 'categories')) {
					$sql .= " AND cp.path_id IN (" . implode(",", array_map('intval', $filter_data['categories'])) . ")";
				} else {
					$sql .= " AND cp.path_id = '" . (int)$filter_data['filter_category_id'] . "'";
				}
			} else {
				if (Arr::get($filter_data, 'categories')) {
					$sql .= " AND p2c.category_id IN (" . implode(",", array_map('intval', $filter_data['categories'])) . ")";
				} else {
					$sql .= " AND p2c.category_id = '" . (int)$filter_data['filter_category_id'] . "'";
				}
			}
		}

		if ($query !== 'manufacturer') {
			if (Arr::get($filter_data, 'manufacturers')) {
				$sql .= " AND p.manufacturer_id IN (" . implode(",", array_map('intval', $filter_data['manufacturers'])) . ")";
			} else if (Arr::get($filter_data, 'filter_manufacturer_id')) {
				$sql .= " AND p.manufacturer_id = '" . (int)$filter_data['filter_manufacturer_id'] . "'";
			}
		}

		if ($query !== 'attribute' && Arr::get($filter_data, 'attributes')) {
			$attribute_table = $this->journal3->settings->get('filterAttributeValuesSeparator') ? 'journal3_product_attribute' : 'product_attribute';

			foreach ($filter_data['attributes'] as $attribute_id => $attribute_values) {
				$temp = array();

				foreach ($attribute_values as $key => $value) {
					$temp[] = "TRIM(pai.text) = '" . $this->db->escape($value) . "'";
				}

				$sql .= " AND EXISTS (SELECT * FROM `" . DB_PREFIX . $attribute_table . "` pai WHERE p.product_id = pai.product_id AND pai.attribute_id = " . (int)$attribute_id . " AND (" . implode(' OR ', $temp) . "))";
			}
		}

		if ($query !== 'option' && Arr::get($filter_data, 'options')) {
			foreach ($filter_data['options'] as $options) {
				$sql .= " AND EXISTS (
							SELECT * FROM `" . DB_PREFIX . "product_option_value` povi 
							WHERE
								p.product_id = povi.product_id AND povi.option_value_id IN (" . implode(', ', array_map('intval', $options)) . ")
				";

				if ($this->journal3->settings->get('filterCheckOptionsQuantity')) {
					$sql .= " AND povi.quantity > 0 ";
				}

				$sql .= ")";
			}
		}

		if ($query !== 'filter' && Arr::get($filter_data, 'filters')) {
			foreach ($filter_data['filters'] as $filters) {
				$sql .= " AND EXISTS (SELECT * FROM `" . DB_PREFIX . "product_filter` pfi WHERE p.product_id = pfi.product_id AND pfi.filter_id IN (" . implode(', ', array_map('intval', $filters)) . "))";
			}
		}

		if (Arr::get($filter_data, 'special')) {
			$sql .= " AND EXISTS (SELECT product_id FROM `" . DB_PREFIX . "product_special` ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$this->config_customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())))";
		}

		if (Arr::get($filter_data, 'filter_name') || Arr::get($filter_data, 'filter_tag')) {
			$sql .= " AND (";

			if (isset($filter_data['filter_name']) && strlen($filter_data['filter_name']) > 0) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $filter_data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = " pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (isset($filter_data['description']) && $filter_data['description'] == 1) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($filter_data['filter_name']) . "%'";
				} else if (isset($filter_data['filter_description']) && $filter_data['filter_description']) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($filter_data['filter_name']) . "%'";
				}
			}

			if ((isset($filter_data['filter_name']) && strlen($filter_data['filter_name']) > 0) && (isset($filter_data['filter_tag']) && !empty($filter_data['filter_tag']))) {
				$sql .= " OR ";
			}

			if (!empty($filter_data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $filter_data['filter_tag'])));

				foreach ($words as $word) {
					$implode[] = "pd.tag LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}
			}

			if (isset($filter_data['filter_name']) && strlen($filter_data['filter_name']) > 0) {
				$sql .= " OR LCASE(p.model) LIKE '%" . $this->db->escape(utf8_strtolower($filter_data['filter_name'])) . "%'";
			}

			if (isset($filter_data['filter_name']) && strlen($filter_data['filter_name']) > 0) {
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($filter_data['filter_name'])) . "'";
			}

			if (isset($filter_data['filter_name']) && strlen($filter_data['filter_name']) > 0) {
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($filter_data['filter_name'])) . "'";
			}

			if (isset($filter_data['filter_name']) && strlen($filter_data['filter_name']) > 0) {
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($filter_data['filter_name'])) . "'";
			}

			if (isset($filter_data['filter_name']) && strlen($filter_data['filter_name']) > 0) {
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($filter_data['filter_name'])) . "'";
			}

			if (isset($filter_data['filter_name']) && strlen($filter_data['filter_name']) > 0) {
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($filter_data['filter_name'])) . "'";
			}

			if (isset($filter_data['filter_name']) && strlen($filter_data['filter_name']) > 0) {
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($filter_data['filter_name'])) . "'";
			}

			$sql .= ")";
		}

		if (isset($filter_data['tags']) && !empty($filter_data['tags'])) {
			$sql .= " AND (";

			foreach ($filter_data['tags'] as $key => $tag) {
				if ($key == 0) {
					$sql .= " pd.tag LIKE '%" . $this->db->escape($tag) . "%'";
				} else {
					$sql .= " OR pd.tag LIKE '%" . $this->db->escape($tag) . "%'";
				}
			}

			$sql .= ")";
		}

		if ($query !== 'price') {
			$discount = "
				(
					SELECT price 
					FROM `" . DB_PREFIX . "product_discount` pd2 
					WHERE 
						pd2.product_id = p.product_id 
						AND pd2.customer_group_id = '" . (int)$this->config_customer_group_id . "' 
						AND pd2.quantity = '1' 
						AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) 
						AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) 
					ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1
				)
			";

			$special = "
				(
					SELECT price 
					FROM `" . DB_PREFIX . "product_special` ps 
					WHERE 
						ps.product_id = p.product_id 
						AND ps.customer_group_id = '" . (int)$this->config_customer_group_id . "' 
						AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) 
						AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) 
					ORDER BY ps.priority ASC, ps.price ASC LIMIT 1
				)
			";

			if (is_numeric(Arr::get($filter_data, 'price.min')) && is_numeric(Arr::get($filter_data, 'price.max'))) {
				$sql .= " AND COALESCE(" . $special . ", " . $discount . ", p.price) BETWEEN " . (float)$this->undoTax($filter_data['price']['min'], 'min') . " AND " . (float)$this->undoTax($filter_data['price']['max'], 'max') . "";
			} else if (is_numeric(Arr::get($filter_data, 'price.min'))) {
				$sql .= " AND COALESCE(" . $special . ", " . $discount . ", p.price) >= " . (float)$this->undoTax($filter_data['price']['min'], 'min');
			} else if (is_numeric(Arr::get($filter_data, 'price.max'))) {
				$sql .= " AND COALESCE(" . $special . ", " . $discount . ", p.price) <= " . (float)$this->undoTax($filter_data['price']['max'], 'max');
			}
		}

		if ($query !== 'quantity') {
			if (is_numeric(Arr::get($filter_data, 'quantity.min'))) {
				$sql .= " AND p.quantity >= " . (int)$filter_data['quantity']['min'];
			}

			if (is_numeric(Arr::get($filter_data, 'quantity.max'))) {
				$sql .= " AND p.quantity <= " . (int)$filter_data['quantity']['max'];
			}
		}

		if (!Arr::get($filter_data, 'ignore_stock')) {
			if ($this->journal3->settings->get('filterCheckQuantity')) {
				$sql .= ' AND p.quantity > 0';
			} else if ($query !== 'availability' && ($availability = Arr::get($filter_data, 'availability'))) {
				$quantity = null;

				if (is_array($availability) && count($availability) === 1) {
					if ($availability[0] === 0) {
						$quantity = false;
					} else if ($availability[0] === 1) {
						$quantity = true;
					}
				} else {
					if ($availability === 0) {
						$quantity = false;
					} else if ($availability === 1) {
						$quantity = true;
					}
				}

				if ($quantity === true) {
					$sql .= ' AND p.quantity > 0';
				} else if ($quantity === false) {
					$sql .= ' AND p.quantity <= 0';
				}
			}
		}

		return $sql;
	}

	private function applyTax($price) {
		if ($this->journal3->settings->get('filterTaxClassId')) {
			$price = $this->tax->calculate($price, $this->journal3->settings->get('filterTaxClassId'));
		}

		return $price * $this->currency->getValue($this->session->data['currency']);
	}

	private function undoTax($price, $type = null) {
		if (!$price) {
			return $price;
		}

		$price = $price / $this->currency->getValue($this->session->data['currency']);

		if ($this->journal3->settings->get('filterTaxClassId')) {
			$tax_rates = $this->tax->getRates($price, $this->journal3->settings->get('filterTaxClassId'));

			$percent = 0;

			foreach ($tax_rates as $tax_rate) {
				if ($tax_rate['type'] == 'F') {
					$price -= $tax_rate['rate'];
				} elseif ($tax_rate['type'] == 'P') {
					$percent += $tax_rate['rate'];
				}
			}

			if ($percent != 0) {
				$price /= (1 + ($percent / 100));
			}
		}

		if ($type === 'min') {
			return floor($price * 100) / 100;
		}

		if ($type === 'max') {
			return ceil($price * 100) / 100;
		}

		return $price;
	}

	protected function dbQuery($sql, $tag = null) {
		\Journal3\Utils\Log::debug($sql, $tag);

		$start = microtime(true);

		$result = parent::dbQuery($sql, $tag);

		$end = microtime(true);

		$time = ($end - $start) * 1000;

		\Journal3\Utils\Log::debug(json_encode($result, JSON_PRETTY_PRINT), $tag . '_RESULT___' . $time);

		return $result;
	}

}
