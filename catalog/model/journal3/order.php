<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Order extends Model {

	public function load($order_id) {
		$order_data = array();

		$order_data['customer_id'] = 0;
		$order_data['customer_group_id'] = $this->config->get('config_customer_group_id');
		$order_data['firstname'] = '';
		$order_data['lastname'] = '';
		$order_data['email'] = '';
		$order_data['telephone'] = '';
		$order_data['custom_field'] = array();

		if ($this->journal3->isOC2()) {
			$order_data['fax'] = '';
		}

		if ($this->customer->isLogged()) {
			$order_data['customer_id'] = $this->customer->getId();
			$order_data['customer_group_id'] = $this->customer->getGroupId();
			$order_data['firstname'] = $this->customer->getFirstName();
			$order_data['lastname'] = $this->customer->getLastName();
			$order_data['email'] = $this->customer->getEmail();
			$order_data['telephone'] = $this->customer->getTelephone();

			$this->load->model('account/customer');
			$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
			$order_data['custom_field'] = json_decode($customer_info['custom_field'], true);

			if ($this->journal3->isOC2()) {
				$order_data['fax'] = $this->customer->getFax();
			}
		} else if ($order_id) {
			$order_info = $this->getOrder($order_id);

			if ($order_info) {
				$order_data['customer_id'] = 0;
				$order_data['customer_group_id'] = $order_info['customer_group_id'];
				$order_data['firstname'] = $order_info['firstname'];
				$order_data['lastname'] = $order_info['lastname'];
				$order_data['email'] = $order_info['email'];
				$order_data['telephone'] = $order_info['telephone'];
				$order_data['custom_field'] = $order_info['custom_field'];

				if ($this->journal3->isOC2()) {
					$order_data['fax'] = $order_info['fax'];
				}
			}
		}

		return $order_data;
	}

	public function save($order_id, $order_data) {
		// update data
		if (!$this->customer->isLogged() && isset($this->request->post['order_data'])) {
			$order_data['customer_group_id'] = Arr::get($this->request->post, 'order_data.customer_group_id', '');
			$order_data['firstname'] = Arr::get($this->request->post, 'order_data.payment_firstname', '');
			$order_data['lastname'] = Arr::get($this->request->post, 'order_data.payment_lastname', '');
			$order_data['email'] = Arr::get($this->request->post, 'order_data.email', '');
			$order_data['telephone'] = Arr::get($this->request->post, 'order_data.telephone', '');
			$order_data['custom_field'] = Arr::get($this->request->post, 'order_data.custom_field', array());

			if ($this->journal3->isOC2()) {
				$order_data['fax'] = $this->request->post['order_data']['fax'];
			}
		}

		// store
		$order_data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
		$order_data['store_id'] = $this->config->get('config_store_id');
		$order_data['store_name'] = $this->config->get('config_name');

		if ($order_data['store_id']) {
			$order_data['store_url'] = $this->config->get('config_url');
		} else {
			if ($this->request->server['HTTPS']) {
				$order_data['store_url'] = HTTPS_SERVER;
			} else {
				$order_data['store_url'] = HTTP_SERVER;
			}
		}

		// tracking
		if (isset($this->request->cookie['tracking'])) {
			$order_data['tracking'] = $this->request->cookie['tracking'];

			$subtotal = $this->cart->getSubTotal();

			// Affiliate
			if ($this->journal3->isOC2()) {
				$this->load->model('affiliate/affiliate');

				$affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);

				if ($affiliate_info) {
					$order_data['affiliate_id'] = $affiliate_info['affiliate_id'];
					$order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
				} else {
					$order_data['affiliate_id'] = 0;
					$order_data['commission'] = 0;
				}
			} else {
				$affiliate_info = $this->model_account_customer->getAffiliateByTracking($this->request->cookie['tracking']);

				if ($affiliate_info) {
					$order_data['affiliate_id'] = $affiliate_info['customer_id'];
					$order_data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
				} else {
					$order_data['affiliate_id'] = 0;
					$order_data['commission'] = 0;
				}
			}

			// Marketing
			$this->load->model('checkout/marketing');

			$marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

			if ($marketing_info) {
				$order_data['marketing_id'] = $marketing_info['marketing_id'];
			} else {
				$order_data['marketing_id'] = 0;
			}
		} else {
			$order_data['affiliate_id'] = 0;
			$order_data['commission'] = 0;
			$order_data['marketing_id'] = 0;
			$order_data['tracking'] = '';
		}

		// info
		$order_data['language_id'] = $this->config->get('config_language_id');
		$order_data['language_code'] = 'code';
		$order_data['currency_id'] = $this->currency->getId($this->session->data['currency']);
		$order_data['currency_code'] = $this->session->data['currency'];
		$order_data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
		$order_data['ip'] = $this->request->server['REMOTE_ADDR'];

		if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
			$order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
		} elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
			$order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
		} else {
			$order_data['forwarded_ip'] = '';
		}

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
		} else {
			$order_data['user_agent'] = '';
		}

		if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
			$order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
		} else {
			$order_data['accept_language'] = '';
		}

		// comment
		$order_data['comment'] = $this->session->data['comment'];

		// save
		if ($order_id) {
			$this->editOrder($order_id, $order_data);
		} else {
			$this->session->data['order_id'] = $this->addOrder($order_data);
		}
	}

	private function addOrder($data) {
		if ($this->journal3->isOC2()) {
			$this->db->query("
				INSERT INTO `" . DB_PREFIX . "order` 
				SET 
					invoice_prefix = '" . $this->db->escape($data['invoice_prefix']) . "', 
					store_id = '" . (int)$data['store_id'] . "', 
					store_name = '" . $this->db->escape($data['store_name']) . "', 
					store_url = '" . $this->db->escape($data['store_url']) . "', 
					customer_id = '" . (int)$data['customer_id'] . "', 
					customer_group_id = '" . (int)$data['customer_group_id'] . "', 
					firstname = '" . $this->db->escape($data['firstname']) . "', 
					lastname = '" . $this->db->escape($data['lastname']) . "', 
					email = '" . $this->db->escape($data['email']) . "', 
					telephone = '" . $this->db->escape($data['telephone']) . "', 
					fax = '" . $this->db->escape($data['fax']) . "', 
					custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "', 
					payment_firstname = '" . $this->db->escape($data['payment_firstname']) . "', 
					payment_lastname = '" . $this->db->escape($data['payment_lastname']) . "', 
					payment_company = '" . $this->db->escape($data['payment_company']) . "', 
					payment_address_1 = '" . $this->db->escape($data['payment_address_1']) . "', 
					payment_address_2 = '" . $this->db->escape($data['payment_address_2']) . "', 
					payment_city = '" . $this->db->escape($data['payment_city']) . "', 
					payment_postcode = '" . $this->db->escape($data['payment_postcode']) . "', 
					payment_country = '" . $this->db->escape($data['payment_country']) . "', 
					payment_country_id = '" . (int)$data['payment_country_id'] . "', 
					payment_zone = '" . $this->db->escape($data['payment_zone']) . "', 
					payment_zone_id = '" . (int)$data['payment_zone_id'] . "', 
					payment_address_format = '" . $this->db->escape($data['payment_address_format']) . "', 
					payment_custom_field = '" . $this->db->escape(isset($data['payment_custom_field']) ? json_encode($data['payment_custom_field']) : '') . "', 
					payment_method = '" . $this->db->escape($data['payment_method']) . "', 
					payment_code = '" . $this->db->escape($data['payment_code']) . "', 
					shipping_firstname = '" . $this->db->escape($data['shipping_firstname']) . "', 
					shipping_lastname = '" . $this->db->escape($data['shipping_lastname']) . "', 
					shipping_company = '" . $this->db->escape($data['shipping_company']) . "', 
					shipping_address_1 = '" . $this->db->escape($data['shipping_address_1']) . "', 
					shipping_address_2 = '" . $this->db->escape($data['shipping_address_2']) . "', 
					shipping_city = '" . $this->db->escape($data['shipping_city']) . "', 
					shipping_postcode = '" . $this->db->escape($data['shipping_postcode']) . "', 
					shipping_country = '" . $this->db->escape($data['shipping_country']) . "', 
					shipping_country_id = '" . (int)$data['shipping_country_id'] . "', 
					shipping_zone = '" . $this->db->escape($data['shipping_zone']) . "', 
					shipping_zone_id = '" . (int)$data['shipping_zone_id'] . "', 
					shipping_address_format = '" . $this->db->escape($data['shipping_address_format']) . "', 
					shipping_custom_field = '" . $this->db->escape(isset($data['shipping_custom_field']) ? json_encode($data['shipping_custom_field']) : '') . "', 
					shipping_method = '" . $this->db->escape($data['shipping_method']) . "', 
					shipping_code = '" . $this->db->escape($data['shipping_code']) . "', 
					comment = '" . $this->db->escape($data['comment']) . "', 
					total = '" . (float)$data['total'] . "', 
					affiliate_id = '" . (int)$data['affiliate_id'] . "', 
					commission = '" . (float)$data['commission'] . "', 
					marketing_id = '" . (int)$data['marketing_id'] . "', 
					tracking = '" . $this->db->escape($data['tracking']) . "', 
					language_id = '" . (int)$data['language_id'] . "', 
					currency_id = '" . (int)$data['currency_id'] . "', 
					currency_code = '" . $this->db->escape($data['currency_code']) . "', 
					currency_value = '" . (float)$data['currency_value'] . "', 
					ip = '" . $this->db->escape($data['ip']) . "', 
					forwarded_ip = '" . $this->db->escape($data['forwarded_ip']) . "', 
					user_agent = '" . $this->db->escape($data['user_agent']) . "', 
					accept_language = '" . $this->db->escape($data['accept_language']) . "', 
					date_added = NOW(), 
					date_modified = NOW()
			");
		} else {
			$this->db->query("
				INSERT INTO `" . DB_PREFIX . "order` 
				SET 
					invoice_prefix = '" . $this->db->escape($data['invoice_prefix']) . "', 
					store_id = '" . (int)$data['store_id'] . "', 
					store_name = '" . $this->db->escape($data['store_name']) . "', 
					store_url = '" . $this->db->escape($data['store_url']) . "', 
					customer_id = '" . (int)$data['customer_id'] . "', 
					customer_group_id = '" . (int)$data['customer_group_id'] . "', 
					firstname = '" . $this->db->escape($data['firstname']) . "', 
					lastname = '" . $this->db->escape($data['lastname']) . "', 
					email = '" . $this->db->escape($data['email']) . "', 
					telephone = '" . $this->db->escape($data['telephone']) . "', 
					custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "', 
					payment_firstname = '" . $this->db->escape($data['payment_firstname']) . "', 
					payment_lastname = '" . $this->db->escape($data['payment_lastname']) . "', 
					payment_company = '" . $this->db->escape($data['payment_company']) . "', 
					payment_address_1 = '" . $this->db->escape($data['payment_address_1']) . "', 
					payment_address_2 = '" . $this->db->escape($data['payment_address_2']) . "', 
					payment_city = '" . $this->db->escape($data['payment_city']) . "', 
					payment_postcode = '" . $this->db->escape($data['payment_postcode']) . "', 
					payment_country = '" . $this->db->escape($data['payment_country']) . "', 
					payment_country_id = '" . (int)$data['payment_country_id'] . "', 
					payment_zone = '" . $this->db->escape($data['payment_zone']) . "', 
					payment_zone_id = '" . (int)$data['payment_zone_id'] . "', 
					payment_address_format = '" . $this->db->escape($data['payment_address_format']) . "', 
					payment_custom_field = '" . $this->db->escape(isset($data['payment_custom_field']) ? json_encode($data['payment_custom_field']) : '') . "', 
					payment_method = '" . $this->db->escape($data['payment_method']) . "', 
					payment_code = '" . $this->db->escape($data['payment_code']) . "', 
					shipping_firstname = '" . $this->db->escape($data['shipping_firstname']) . "', 
					shipping_lastname = '" . $this->db->escape($data['shipping_lastname']) . "', 
					shipping_company = '" . $this->db->escape($data['shipping_company']) . "', 
					shipping_address_1 = '" . $this->db->escape($data['shipping_address_1']) . "', 
					shipping_address_2 = '" . $this->db->escape($data['shipping_address_2']) . "', 
					shipping_city = '" . $this->db->escape($data['shipping_city']) . "', 
					shipping_postcode = '" . $this->db->escape($data['shipping_postcode']) . "', 
					shipping_country = '" . $this->db->escape($data['shipping_country']) . "', 
					shipping_country_id = '" . (int)$data['shipping_country_id'] . "', 
					shipping_zone = '" . $this->db->escape($data['shipping_zone']) . "', 
					shipping_zone_id = '" . (int)$data['shipping_zone_id'] . "', 
					shipping_address_format = '" . $this->db->escape($data['shipping_address_format']) . "', 
					shipping_custom_field = '" . $this->db->escape(isset($data['shipping_custom_field']) ? json_encode($data['shipping_custom_field']) : '') . "', 
					shipping_method = '" . $this->db->escape($data['shipping_method']) . "', 
					shipping_code = '" . $this->db->escape($data['shipping_code']) . "', 
					comment = '" . $this->db->escape($data['comment']) . "', 
					total = '" . (float)$data['total'] . "', 
					affiliate_id = '" . (int)$data['affiliate_id'] . "', 
					commission = '" . (float)$data['commission'] . "', 
					marketing_id = '" . (int)$data['marketing_id'] . "', 
					tracking = '" . $this->db->escape($data['tracking']) . "', 
					language_id = '" . (int)$data['language_id'] . "', 
					currency_id = '" . (int)$data['currency_id'] . "', 
					currency_code = '" . $this->db->escape($data['currency_code']) . "', 
					currency_value = '" . (float)$data['currency_value'] . "', 
					ip = '" . $this->db->escape($data['ip']) . "', 
					forwarded_ip = '" . $this->db->escape($data['forwarded_ip']) . "', 
					user_agent = '" . $this->db->escape($data['user_agent']) . "', 
					accept_language = '" . $this->db->escape($data['accept_language']) . "', 
					date_added = NOW(), 
					date_modified = NOW()
			");
		}

		$order_id = $this->db->getLastId();

		// Products
		if (isset($data['products'])) {
			foreach ($data['products'] as $product) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET order_id = '" . (int)$order_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $this->db->escape($product['name']) . "', model = '" . $this->db->escape($product['model']) . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "', tax = '" . (float)$product['tax'] . "', reward = '" . (int)$product['reward'] . "'");

				$order_product_id = $this->db->getLastId();

				foreach ($product['option'] as $option) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "order_option SET order_id = '" . (int)$order_id . "', order_product_id = '" . (int)$order_product_id . "', product_option_id = '" . (int)$option['product_option_id'] . "', product_option_value_id = '" . (int)$option['product_option_value_id'] . "', name = '" . $this->db->escape($option['name']) . "', `value` = '" . $this->db->escape($option['value']) . "', `type` = '" . $this->db->escape($option['type']) . "'");
				}
			}
		}

		// Gift Voucher
		$this->load->model('extension/total/voucher');

		// Vouchers
		if (isset($data['vouchers'])) {
			foreach ($data['vouchers'] as $voucher) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_voucher SET order_id = '" . (int)$order_id . "', description = '" . $this->db->escape($voucher['description']) . "', code = '" . $this->db->escape($voucher['code']) . "', from_name = '" . $this->db->escape($voucher['from_name']) . "', from_email = '" . $this->db->escape($voucher['from_email']) . "', to_name = '" . $this->db->escape($voucher['to_name']) . "', to_email = '" . $this->db->escape($voucher['to_email']) . "', voucher_theme_id = '" . (int)$voucher['voucher_theme_id'] . "', message = '" . $this->db->escape($voucher['message']) . "', amount = '" . (float)$voucher['amount'] . "'");

				$order_voucher_id = $this->db->getLastId();

				$voucher_id = $this->model_extension_total_voucher->addVoucher($order_id, $voucher);

				$this->db->query("UPDATE " . DB_PREFIX . "order_voucher SET voucher_id = '" . (int)$voucher_id . "' WHERE order_voucher_id = '" . (int)$order_voucher_id . "'");
			}
		}

		// Totals
		if (isset($data['totals'])) {
			foreach ($data['totals'] as $total) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_total SET order_id = '" . (int)$order_id . "', code = '" . $this->db->escape($total['code']) . "', title = '" . $this->db->escape($total['title']) . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "'");
			}
		}

		return $order_id;
	}

	private function editOrder($order_id, $data) {
		if ($this->journal3->isOC2()) {
			$this->db->query("
				UPDATE `" . DB_PREFIX . "order` 
				SET 
					invoice_prefix = '" . $this->db->escape($data['invoice_prefix']) . "', 
					store_id = '" . (int)$data['store_id'] . "', 
					store_name = '" . $this->db->escape($data['store_name']) . "', 
					store_url = '" . $this->db->escape($data['store_url']) . "', 
					customer_id = '" . (int)$data['customer_id'] . "', 
					customer_group_id = '" . (int)$data['customer_group_id'] . "', 
					firstname = '" . $this->db->escape($data['firstname']) . "', 
					lastname = '" . $this->db->escape($data['lastname']) . "', 
					email = '" . $this->db->escape($data['email']) . "', 
					telephone = '" . $this->db->escape($data['telephone']) . "', 
					fax = '" . $this->db->escape($data['fax']) . "', 
					custom_field = '" . $this->db->escape(json_encode($data['custom_field'])) . "', 
					payment_firstname = '" . $this->db->escape($data['payment_firstname']) . "', 
					payment_lastname = '" . $this->db->escape($data['payment_lastname']) . "', 
					payment_company = '" . $this->db->escape($data['payment_company']) . "', 
					payment_address_1 = '" . $this->db->escape($data['payment_address_1']) . "', 
					payment_address_2 = '" . $this->db->escape($data['payment_address_2']) . "', 
					payment_city = '" . $this->db->escape($data['payment_city']) . "', 
					payment_postcode = '" . $this->db->escape($data['payment_postcode']) . "', 
					payment_country = '" . $this->db->escape($data['payment_country']) . "', 
					payment_country_id = '" . (int)$data['payment_country_id'] . "', 
					payment_zone = '" . $this->db->escape($data['payment_zone']) . "', 
					payment_zone_id = '" . (int)$data['payment_zone_id'] . "', 
					payment_address_format = '" . $this->db->escape($data['payment_address_format']) . "', 
					payment_custom_field = '" . $this->db->escape(json_encode($data['payment_custom_field'])) . "', 
					payment_method = '" . $this->db->escape($data['payment_method']) . "', 
					payment_code = '" . $this->db->escape($data['payment_code']) . "', 
					shipping_firstname = '" . $this->db->escape($data['shipping_firstname']) . "', 
					shipping_lastname = '" . $this->db->escape($data['shipping_lastname']) . "', 
					shipping_company = '" . $this->db->escape($data['shipping_company']) . "', 
					shipping_address_1 = '" . $this->db->escape($data['shipping_address_1']) . "', 
					shipping_address_2 = '" . $this->db->escape($data['shipping_address_2']) . "', 
					shipping_city = '" . $this->db->escape($data['shipping_city']) . "', 
					shipping_postcode = '" . $this->db->escape($data['shipping_postcode']) . "', 
					shipping_country = '" . $this->db->escape($data['shipping_country']) . "', 
					shipping_country_id = '" . (int)$data['shipping_country_id'] . "', 
					shipping_zone = '" . $this->db->escape($data['shipping_zone']) . "', 
					shipping_zone_id = '" . (int)$data['shipping_zone_id'] . "', 
					shipping_address_format = '" . $this->db->escape($data['shipping_address_format']) . "', 
					shipping_custom_field = '" . $this->db->escape(json_encode($data['shipping_custom_field'])) . "', 
					shipping_method = '" . $this->db->escape($data['shipping_method']) . "', 
					shipping_code = '" . $this->db->escape($data['shipping_code']) . "', 
					comment = '" . $this->db->escape($data['comment']) . "', 
					total = '" . (float)$data['total'] . "', 
					affiliate_id = '" . (int)$data['affiliate_id'] . "', 
					commission = '" . (float)$data['commission'] . "', 
					marketing_id = '" . (int)$data['marketing_id'] . "', 
					tracking = '" . $this->db->escape($data['tracking']) . "', 
					language_id = '" . (int)$data['language_id'] . "', 
					currency_id = '" . (int)$data['currency_id'] . "', 
					currency_code = '" . $this->db->escape($data['currency_code']) . "', 
					currency_value = '" . (float)$data['currency_value'] . "', 
					ip = '" . $this->db->escape($data['ip']) . "', 
					forwarded_ip = '" . $this->db->escape($data['forwarded_ip']) . "', 
					user_agent = '" . $this->db->escape($data['user_agent']) . "', 
					accept_language = '" . $this->db->escape($data['accept_language']) . "', 
					date_added = NOW(), 
					date_modified = NOW() 
				WHERE order_id = '" . (int)$order_id . "'");
		} else {
			$this->db->query("
				UPDATE `" . DB_PREFIX . "order` 
				SET 
					invoice_prefix = '" . $this->db->escape($data['invoice_prefix']) . "', 
					store_id = '" . (int)$data['store_id'] . "', 
					store_name = '" . $this->db->escape($data['store_name']) . "', 
					store_url = '" . $this->db->escape($data['store_url']) . "', 
					customer_id = '" . (int)$data['customer_id'] . "', 
					customer_group_id = '" . (int)$data['customer_group_id'] . "', 
					firstname = '" . $this->db->escape($data['firstname']) . "', 
					lastname = '" . $this->db->escape($data['lastname']) . "', 
					email = '" . $this->db->escape($data['email']) . "', 
					telephone = '" . $this->db->escape($data['telephone']) . "', 
					custom_field = '" . $this->db->escape(json_encode($data['custom_field'])) . "', 
					payment_firstname = '" . $this->db->escape($data['payment_firstname']) . "', 
					payment_lastname = '" . $this->db->escape($data['payment_lastname']) . "', 
					payment_company = '" . $this->db->escape($data['payment_company']) . "', 
					payment_address_1 = '" . $this->db->escape($data['payment_address_1']) . "', 
					payment_address_2 = '" . $this->db->escape($data['payment_address_2']) . "', 
					payment_city = '" . $this->db->escape($data['payment_city']) . "', 
					payment_postcode = '" . $this->db->escape($data['payment_postcode']) . "', 
					payment_country = '" . $this->db->escape($data['payment_country']) . "', 
					payment_country_id = '" . (int)$data['payment_country_id'] . "', 
					payment_zone = '" . $this->db->escape($data['payment_zone']) . "', 
					payment_zone_id = '" . (int)$data['payment_zone_id'] . "', 
					payment_address_format = '" . $this->db->escape($data['payment_address_format']) . "', 
					payment_custom_field = '" . $this->db->escape(json_encode($data['payment_custom_field'])) . "', 
					payment_method = '" . $this->db->escape($data['payment_method']) . "', 
					payment_code = '" . $this->db->escape($data['payment_code']) . "', 
					shipping_firstname = '" . $this->db->escape($data['shipping_firstname']) . "', 
					shipping_lastname = '" . $this->db->escape($data['shipping_lastname']) . "', 
					shipping_company = '" . $this->db->escape($data['shipping_company']) . "', 
					shipping_address_1 = '" . $this->db->escape($data['shipping_address_1']) . "', 
					shipping_address_2 = '" . $this->db->escape($data['shipping_address_2']) . "', 
					shipping_city = '" . $this->db->escape($data['shipping_city']) . "', 
					shipping_postcode = '" . $this->db->escape($data['shipping_postcode']) . "', 
					shipping_country = '" . $this->db->escape($data['shipping_country']) . "', 
					shipping_country_id = '" . (int)$data['shipping_country_id'] . "', 
					shipping_zone = '" . $this->db->escape($data['shipping_zone']) . "', 
					shipping_zone_id = '" . (int)$data['shipping_zone_id'] . "', 
					shipping_address_format = '" . $this->db->escape($data['shipping_address_format']) . "', 
					shipping_custom_field = '" . $this->db->escape(json_encode($data['shipping_custom_field'])) . "', 
					shipping_method = '" . $this->db->escape($data['shipping_method']) . "', 
					shipping_code = '" . $this->db->escape($data['shipping_code']) . "', 
					comment = '" . $this->db->escape($data['comment']) . "', 
					total = '" . (float)$data['total'] . "', 
					affiliate_id = '" . (int)$data['affiliate_id'] . "', 
					commission = '" . (float)$data['commission'] . "', 
					marketing_id = '" . (int)$data['marketing_id'] . "', 
					tracking = '" . $this->db->escape($data['tracking']) . "', 
					language_id = '" . (int)$data['language_id'] . "', 
					currency_id = '" . (int)$data['currency_id'] . "', 
					currency_code = '" . $this->db->escape($data['currency_code']) . "', 
					currency_value = '" . (float)$data['currency_value'] . "', 
					ip = '" . $this->db->escape($data['ip']) . "', 
					forwarded_ip = '" . $this->db->escape($data['forwarded_ip']) . "', 
					user_agent = '" . $this->db->escape($data['user_agent']) . "', 
					accept_language = '" . $this->db->escape($data['accept_language']) . "',  
					date_added = NOW(), 
					date_modified = NOW() 
				WHERE order_id = '" . (int)$order_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "'");

		// Products
		if (isset($data['products'])) {
			foreach ($data['products'] as $product) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET order_id = '" . (int)$order_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $this->db->escape($product['name']) . "', model = '" . $this->db->escape($product['model']) . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "', tax = '" . (float)$product['tax'] . "', reward = '" . (int)$product['reward'] . "'");

				$order_product_id = $this->db->getLastId();

				foreach ($product['option'] as $option) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "order_option SET order_id = '" . (int)$order_id . "', order_product_id = '" . (int)$order_product_id . "', product_option_id = '" . (int)$option['product_option_id'] . "', product_option_value_id = '" . (int)$option['product_option_value_id'] . "', name = '" . $this->db->escape($option['name']) . "', `value` = '" . $this->db->escape($option['value']) . "', `type` = '" . $this->db->escape($option['type']) . "'");
				}
			}
		}

		// Gift Voucher
		$this->load->model('extension/total/voucher');

		$this->db->query("DELETE FROM " . DB_PREFIX . "order_voucher WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "voucher WHERE order_id = '" . (int)$order_id . "'");

		if (isset($data['vouchers'])) {
			foreach ($data['vouchers'] as $voucher) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_voucher SET order_id = '" . (int)$order_id . "', description = '" . $this->db->escape($voucher['description']) . "', code = '" . $this->db->escape($voucher['code']) . "', from_name = '" . $this->db->escape($voucher['from_name']) . "', from_email = '" . $this->db->escape($voucher['from_email']) . "', to_name = '" . $this->db->escape($voucher['to_name']) . "', to_email = '" . $this->db->escape($voucher['to_email']) . "', voucher_theme_id = '" . (int)$voucher['voucher_theme_id'] . "', message = '" . $this->db->escape($voucher['message']) . "', amount = '" . (float)$voucher['amount'] . "'");

				$order_voucher_id = $this->db->getLastId();

				$voucher_id = $this->model_extension_total_voucher->addVoucher($order_id, $voucher);

				$this->db->query("UPDATE " . DB_PREFIX . "order_voucher SET voucher_id = '" . (int)$voucher_id . "' WHERE order_voucher_id = '" . (int)$order_voucher_id . "'");
			}
		}

		// Totals
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "'");

		if (isset($data['totals'])) {
			foreach ($data['totals'] as $total) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_total SET order_id = '" . (int)$order_id . "', code = '" . $this->db->escape($total['code']) . "', title = '" . $this->db->escape($total['title']) . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "'");
			}
		}
	}

	private function getOrder($order_id) {
		$order_query = $this->db->query("SELECT *, (SELECT os.name FROM `" . DB_PREFIX . "order_status` os WHERE os.order_status_id = o.order_status_id AND os.language_id = o.language_id) AS order_status FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows) {
			return array(
				'customer_group_id'       => $order_query->row['customer_group_id'],
				'firstname'               => $order_query->row['firstname'],
				'lastname'                => $order_query->row['lastname'],
				'email'                   => $order_query->row['email'],
				'telephone'               => $order_query->row['telephone'],
				'fax'                     => $this->journal3->isOC2() ? $order_query->row['fax'] : '',
				'custom_field'            => json_decode($order_query->row['custom_field'], true),
				'payment_firstname'       => $order_query->row['payment_firstname'],
				'payment_lastname'        => $order_query->row['payment_lastname'],
				'payment_company'         => $order_query->row['payment_company'],
				'payment_address_1'       => $order_query->row['payment_address_1'],
				'payment_address_2'       => $order_query->row['payment_address_2'],
				'payment_postcode'        => $order_query->row['payment_postcode'],
				'payment_city'            => $order_query->row['payment_city'],
				'payment_zone_id'         => $order_query->row['payment_zone_id'],
				'payment_zone'            => $order_query->row['payment_zone'],
				'payment_country_id'      => $order_query->row['payment_country_id'],
				'payment_country'         => $order_query->row['payment_country'],
				'payment_address_format'  => $order_query->row['payment_address_format'],
				'payment_custom_field'    => json_decode($order_query->row['payment_custom_field'], true),
				'payment_method'          => $order_query->row['payment_method'],
				'payment_code'            => $order_query->row['payment_code'],
				'shipping_firstname'      => $order_query->row['shipping_firstname'],
				'shipping_lastname'       => $order_query->row['shipping_lastname'],
				'shipping_company'        => $order_query->row['shipping_company'],
				'shipping_address_1'      => $order_query->row['shipping_address_1'],
				'shipping_address_2'      => $order_query->row['shipping_address_2'],
				'shipping_postcode'       => $order_query->row['shipping_postcode'],
				'shipping_city'           => $order_query->row['shipping_city'],
				'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
				'shipping_zone'           => $order_query->row['shipping_zone'],
				'shipping_country_id'     => $order_query->row['shipping_country_id'],
				'shipping_country'        => $order_query->row['shipping_country'],
				'shipping_address_format' => $order_query->row['shipping_address_format'],
				'shipping_custom_field'   => json_decode($order_query->row['shipping_custom_field'], true),
				'shipping_method'         => $order_query->row['shipping_method'],
				'shipping_code'           => $order_query->row['shipping_code'],
			);
		} else {
			return array();
		}
	}

}
