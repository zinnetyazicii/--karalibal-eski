<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Layout extends Model {

	private static $current_layout_id;
	private static $layout_data;

	public function getCurrentLayoutId() {
		if (self::$current_layout_id === null) {
			$this->load->model('design/layout');
			$this->load->model('journal3/blog');

			if (isset($this->request->get['route'])) {
				$route = (string)$this->request->get['route'];
			} else {
				$route = 'common/home';
			}

			// quickview fix
			if ($route === 'journal3/product') {
				$route = 'product/product';
			}

			$this->journal3->document->addClass('route-' . str_replace('/', '-', $route));
			$this->journal3->document->setPageRoute($route);

			$layout_id = 0;

			if ($route == 'product/category' && isset($this->request->get['path'])) {
				$path = explode('_', (string)$this->request->get['path']);
				$category_id = end($path);

				$this->load->model('catalog/category');

				$layout_id = $this->model_catalog_category->getCategoryLayoutId($category_id);

				$this->journal3->document->setPageId($category_id);

				$this->journal3->document->addClass('category-' . $category_id);
			}

			if ($route == 'product/manufacturer/info' && isset($this->request->get['manufacturer_id'])) {
				$manufacturer_id = $this->request->get['manufacturer_id'];

				$this->journal3->document->setPageId($manufacturer_id);

				$this->journal3->document->addClass('manufacturer-' . $manufacturer_id);
			}

			if ($route == 'product/product' && isset($this->request->get['product_id'])) {
				$product_id = $this->request->get['product_id'];

				$this->load->model('catalog/product');

				$layout_id = $this->model_catalog_product->getProductLayoutId($product_id);

				$this->journal3->document->setPageId($product_id);

				$this->journal3->document->addClass('product-' . $product_id);
			}

			if ($route == 'information/information' && isset($this->request->get['information_id'])) {
				$information_id = $this->request->get['information_id'];

				$this->load->model('catalog/information');

				$layout_id = $this->model_catalog_information->getInformationLayoutId($information_id);

				$this->journal3->document->setPageId($information_id);

				$this->journal3->document->addClass('information-' . $information_id);
			}

			if ($route == 'journal3/blog' && isset($this->request->get['journal_blog_category_id'])) {
				$journal_blog_category_id = $this->request->get['journal_blog_category_id'];

				$layout_id = $this->model_journal3_blog->getBlogCategoryLayoutId($journal_blog_category_id);

				$this->journal3->document->setPageId($journal_blog_category_id);

				$this->journal3->document->addClass('blog-category-' . $journal_blog_category_id);
			}

			if ($route == 'journal3/blog/post' && isset($this->request->get['journal_blog_post_id'])) {
				$journal_blog_post_id = $this->request->get['journal_blog_post_id'];

				$layout_id = $this->model_journal3_blog->getBlogPostLayoutId($journal_blog_post_id);

				$this->journal3->document->setPageId($journal_blog_post_id);

				$this->journal3->document->addClass('blog-post-' . $journal_blog_post_id);
			}

			if (!$layout_id) {
				$layout_id = $this->model_design_layout->getLayout($route);
			}

			if (!$layout_id) {
				$layout_id = $this->config->get('config_layout_id');
			}

			self::$current_layout_id = $layout_id;
		}

		return self::$current_layout_id;
	}

	public function get($id) {
		if (self::$layout_data === null) {
			$result = array();

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

			self::$layout_data = $result;
		}

		return self::$layout_data;
	}

}
