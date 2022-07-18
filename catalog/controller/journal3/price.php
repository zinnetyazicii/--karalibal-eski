<?php

use Journal3\Opencart\Controller;
use Journal3\Utils\Arr;

class ControllerJournal3Price extends Controller {

	public function index() {
		$this->load->model('catalog/product');
		$this->load->model('journal3/product');
		$this->load->language('product/product');

		$product_id = Arr::get($this->request->post, 'product_id');
		$popup = (bool)Arr::get($this->request->get, 'popup');
		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			$quantity = (int)Arr::get($this->request->post, 'quantity', 1);

			// stock
			$data['in_stock'] = $product_info['quantity'] > 0;
			$data['quantity'] = $product_info['quantity'];

			// options price
			$options_price = 0;

			// options weight
			$options_weight = 0;

			$product_option_values = $this->model_journal3_product->getProductOptionValues($product_id, Arr::get($this->request->post, 'option', array()));

			foreach ($product_option_values as $product_option_value) {
				if ($product_option_value['price_prefix'] === '+') {
					$options_price += $product_option_value['price'];
				}

				if ($product_option_value['price_prefix'] === '-') {
					$options_price -= $product_option_value['price'];
				}

				if ($product_option_value['weight_prefix'] === '+') {
					$options_weight += $product_option_value['weight'];
				}

				if ($product_option_value['weight_prefix'] === '-') {
					$options_weight -= $product_option_value['weight'];
				}

				if ($product_option_value['subtract']) {
					if ($product_option_value['quantity'] < $data['quantity']) {
						$data['quantity'] = $product_option_value['quantity'];
					}

					if (!$product_option_value['quantity'] || $product_option_value['quantity'] < $quantity) {
						$data['in_stock'] = false;
					}
				}
			}

			// stock status
			if ($data['quantity'] < $quantity) {
				$data['stock'] = $product_info['stock_status'];
				$data['in_stock'] = false;
			} elseif ($this->config->get('config_stock_display')) {
				$data['stock'] = $data['quantity'];
			} else {
				$data['stock'] = $this->journal3->settings->get($popup ? 'quickviewPageStyleProductInStockText' : 'productPageStyleProductInStockText');

				// some third party addons for in stock status
				if (isset($product_info['in_stock_status']) && $product_info['in_stock_status']) {
					$data['stock'] = $product_info['in_stock_status'];
				}
			}

			// base price
			$product_discount_query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity <= '" . (int)$quantity . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity DESC, priority ASC, price ASC LIMIT 1");

			if ($product_discount_query->num_rows) {
				$base_price = $product_discount_query->row['price'];
			} else {
				$base_price = $product_info['price'];
			}

			// weight
			$data['weight'] = $this->weight->format((float)$product_info['weight'] + (float)$options_weight, $product_info['weight_class_id']);

			// price
			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$data['price'] = $this->currency->format($this->tax->calculate($base_price + $options_price, $product_info['tax_class_id'], $this->config->get('config_tax')) * $quantity, $this->session->data['currency']);
			} else {
				$data['price'] = false;
			}

			// special
			if ((float)$product_info['special']) {
				$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'] + $options_price, $product_info['tax_class_id'], $this->config->get('config_tax')) * $quantity, $this->session->data['currency']);
			} else {
				$data['special'] = false;
			}

			// ex tax
			if ($this->config->get('config_tax')) {
				$tax = (float)$product_info['special'] ? $product_info['special'] : $base_price;
				$tax = ($tax + $options_price) * $quantity;
				$data['tax'] = $this->language->get('text_tax') . ' ' . $this->currency->format($tax, $this->session->data['currency']);
			} else {
				$data['tax'] = false;
			}

			// discounts
			$data['discounts'] = array();

			foreach ($this->model_catalog_product->getProductDiscounts($product_id) as $discount) {
				$discount_price = $this->currency->format($this->tax->calculate($discount['price'] + $options_price, $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				$data['discounts'][] = $discount['quantity'] . $this->language->get('text_discount') . $discount_price;
			}

			$this->renderJson('success', $data);
		} else {
			$this->renderJson('error', array(
				'message' => $this->language->get('text_error'),
			));
		}

	}

}
