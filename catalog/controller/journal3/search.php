<?php

use Journal3\Opencart\Controller;
use Journal3\Utils\Arr;

class ControllerJournal3Search extends Controller {

	public function index() {
		$search = Arr::get($this->request->get, 'search');
		$category_id = Arr::get($this->request->get, 'category_id');
		$sub_category = Arr::get($this->request->get, 'sub_category');

		$url = '';

		if ($search) {
			$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
		}

		$limit = (int)$this->journal3->settings->get('searchStyleSearchAutoSuggestLimit');

		if (!$limit) {
			$limit = 10;
		}

		$filter_data = array(
			'filter_name'        => $search,
			'filter_description' => $this->journal3->settings->get('searchStyleSearchAutoSuggestDescription'),
			'start'              => 0,
			'limit'              => $limit,
		);

		if ($category_id) {
			$filter_data['filter_category_id'] = $category_id;
		}

		if ($sub_category && $this->journal3->settings->get('searchStyleSearchAutoSuggestSubCategories')) {
			$filter_data['filter_sub_category'] = true;
		}

		$this->load->model('journal3/filter');
		$this->load->model('journal3/image');

		$products = array();

		$results = $this->model_journal3_filter->getProducts($filter_data);

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_journal3_image->resize($result['image'], $this->journal3->settings->get('image_dimensions_autosuggest.width'), $this->journal3->settings->get('image_dimensions_autosuggest.height'), $this->journal3->settings->get('image_dimensions_autosuggest.resize'));
				$image2 = $this->model_journal3_image->resize($result['image'], $this->journal3->settings->get('image_dimensions_autosuggest.width') * 2, $this->journal3->settings->get('image_dimensions_autosuggest.height') * 2, $this->journal3->settings->get('image_dimensions_autosuggest.resize'));
			} else {
				$image = $this->model_journal3_image->resize('placeholder.png', $this->journal3->settings->get('image_dimensions_autosuggest.width'), $this->journal3->settings->get('image_dimensions_autosuggest.height'), $this->journal3->settings->get('image_dimensions_autosuggest.resize'));
				$image2 = $this->model_journal3_image->resize('placeholder.png', $this->journal3->settings->get('image_dimensions_autosuggest.width') * 2, $this->journal3->settings->get('image_dimensions_autosuggest.height') * 2, $this->journal3->settings->get('image_dimensions_autosuggest.resize'));
			}

			$price = false;
			$special = false;

			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				}
			}

			$products[] = array(
				'quantity'    => (int)$result['quantity'],
				'price_value' => $result['special'] ? $result['special'] > 0 : $result['price'] > 0,
				'product_id'  => $result['product_id'],
				'name'        => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'),
				'thumb'       => $image,
				'thumb2'      => $image2,
				'price'       => $price,
				'special'     => $special,
				'href'        => $this->url->link('product/product', '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8')) . '&product_id=' . $result['product_id'] . $url),
			);
		}

		if ($products) {
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . urlencode(html_entity_decode($this->request->get['search'], ENT_QUOTES, 'UTF-8'));
			}

			if ($this->journal3->settings->get('searchStyleSearchAutoSuggestDescription')) {
				$url .= '&description=true';
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			$products[] = array(
				'view_more' => true,
				'name'      => $this->journal3->settings->get('searchStyleSearchViewMoreText'),
				'href'      => $this->url->link('product/search', $url),
			);
		} else {
			$products[] = array(
				'no_results' => true,
				'name'       => $this->journal3->settings->get('searchStyleSearchNoResultsText'),
			);
		}

		$this->renderJson('success', $products);
	}

}
