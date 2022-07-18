<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Checkout extends Model {

	public static $ADDRESS_FIELDS = array(
		'firstname'      => '',
		'lastname'       => '',
		'company'        => '',
		'address_id'     => '',
		'address_1'      => '',
		'address_2'      => '',
		'city'           => '',
		'postcode'       => '',
		'country_id'     => '',
		'country'        => '',
		'zone_id'        => '',
		'zone'           => '',
		'iso_code_2'     => '',
		'iso_code_3'     => '',
		'address_format' => '',
		'custom_field'   => array(),
	);

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('account/custom_field');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');

		if ($this->journal3->isOC2()) {
			$this->load->model('extension/extension');
		} else {
			$this->load->model('setting/extension');
		}
	}

	public function init() {
		if ($this->customer->isLogged()) {
			$this->session->data['account'] = '';
		} else {
			$this->session->data['account'] = $this->journal3->settings->get('quickCheckoutAuthentication');

			if ($this->session->data['account'] === 'login') {
				$this->session->data['account'] = '';
			}
		}

		$this->session->data['same_address'] = $this->journal3->settings->get('quickCheckoutSameAddress');
		$this->session->data['newsletter'] = $this->journal3->settings->get('quickCheckoutNewsConfirmNewsletterChecked');
		$this->session->data['comment'] = Arr::get($this->session->data, 'comment', '');

		if ($this->customer->isLogged()) {
			$address = $this->model_account_address->getAddress($this->customer->getAddressId());

			if (!$address) {
				$addresses = $this->model_account_address->getAddresses();

				if ($addresses) {
					$address = reset($addresses);
				}
			}

			$this->set_address('payment', $address);
			$this->set_address('shipping', $address);
		} else {
			if ($this->session->data['same_address']) {
				$address = Arr::get($this->session->data, 'shipping_address');

				$this->set_address('payment', $address);
				$this->set_address('shipping', $address);
			} else {
				$this->set_address('payment', Arr::get($this->session->data, 'payment_address'));
				$this->set_address('shipping', Arr::get($this->session->data, 'shipping_address'));
			}
		}

		return $this->sync();
	}

	public function update() {
		$this->session->data['comment'] = Arr::get($this->request->post, 'order_data.comment');
		$this->session->data['account'] = Arr::get($this->request->post, 'account');
		$this->session->data['same_address'] = Arr::get($this->request->post, 'same_address') === 'true';
		$this->session->data['newsletter'] = Arr::get($this->request->post, 'newsletter') === 'true';

		if ($this->customer->isLogged()) {
			if ($this->session->data['same_address']) {
				$this->session->data['payment_address_type'] = Arr::get($this->request->post, 'payment_address_type');
				$this->session->data['shipping_address_type'] = Arr::get($this->request->post, 'payment_address_type');

				if ($this->session->data['payment_address_type'] === 'existing') {
					$address = $this->model_account_address->getAddress($this->request->post['order_data']['payment_address_id']);
				} else {
					$address = $this->extract_address('payment', $this->request->post['order_data']);
				}

				$this->set_address('payment', $address);
				$this->set_address('shipping', $address);
			} else {
				$this->session->data['payment_address_type'] = Arr::get($this->request->post, 'payment_address_type');
				$this->session->data['shipping_address_type'] = Arr::get($this->request->post, 'shipping_address_type');

				if ($this->session->data['payment_address_type'] === 'existing') {
					$address = $this->model_account_address->getAddress($this->request->post['order_data']['payment_address_id']);
				} else {
					$address = $this->extract_address('payment', $this->request->post['order_data']);
				}

				$this->set_address('payment', $address);

				if ($this->session->data['shipping_address_type'] === 'existing') {
					$address = $this->model_account_address->getAddress($this->request->post['order_data']['shipping_address_id']);
				} else {
					$address = $this->extract_address('shipping', $this->request->post['order_data']);
				}

				$this->set_address('shipping', $address);
			}
		} else {
			if ($this->session->data['same_address']) {
				$address = $this->extract_address('payment', $this->request->post['order_data']);

				$this->set_address('payment', $address);
				$this->set_address('shipping', $address);
			} else {
				$this->set_address('payment', $this->extract_address('payment', $this->request->post['order_data']));
				$this->set_address('shipping', $this->extract_address('shipping', $this->request->post['order_data']));
			}
		}

		if (Arr::get($this->request->get, 'confirm') !== 'true') {
			if ($code = Arr::get($this->request->post['order_data'], 'shipping_code')) {
				$this->session->data['shipping_method']['code'] = $code;
			} else {
				unset($this->session->data['shipping_method']);
			}

			if ($code = Arr::get($this->request->post['order_data'], 'payment_code')) {
				$this->session->data['payment_method']['code'] = $code;
			} else {
				unset($this->session->data['payment_method']);
			}
		}

		return $this->sync();
	}

	private function sync() {
		// order_id
		$order_id = Arr::get($this->session->data, 'order_id');

		// load
		$data = $this->model_journal3_order->load($order_id);

		// comment
		$data['comment'] = $this->session->data['comment'];

		// customer_group_id
		if (!$this->customer->isLogged() && isset($this->request->post['order_data'])) {
			$data['customer_group_id'] = $this->request->post['order_data']['customer_group_id'];
		}

		// tax classes
		$this->config->set('config_customer_group_id', $data['customer_group_id']);

		$this->tax->unsetRates();

		$this->tax->setShippingAddress($this->session->data['shipping_address']['country_id'], $this->session->data['shipping_address']['zone_id']);
		$this->tax->setPaymentAddress($this->session->data['payment_address']['country_id'], $this->session->data['payment_address']['zone_id']);
		$this->tax->setStoreAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));

		// custom_fields
		$custom_fields = $this->custom_fields($data);

		foreach ($custom_fields['custom_field'] as $key => $value) {
			if (!isset($data['custom_field'][$key])) {
				$data['custom_field'][$key] = $value;
			}
		}

		unset($custom_fields['custom_field']);
		$data['custom_fields'] = $custom_fields;

		// checkbox fix
		foreach (Arr::get($custom_fields, 'custom_fields.account', array()) as $custom_field) {
			if ($custom_field['type'] === 'checkbox') {
				if (!is_array(Arr::get($data, 'custom_field.' . $custom_field['custom_field_id']))) {
					$data['custom_field'][$custom_field['custom_field_id']] = array();
				}
			}
		}

		foreach (Arr::get($custom_fields, 'custom_fields.address', array()) as $custom_field) {
			if ($custom_field['type'] === 'checkbox') {
				if (!is_array(Arr::get($data, 'payment_custom_field.' . $custom_field['custom_field_id']))) {
					$data['payment_custom_field'][$custom_field['custom_field_id']] = array();
				}

				if (!is_array(Arr::get($data, 'shipping_custom_field.' . $custom_field['custom_field_id']))) {
					$data['shipping_custom_field'][$custom_field['custom_field_id']] = array();
				}
			}
		}

		// custom fields empty array json_encode fix
		if (!is_array($data['custom_field']) || !count($data['custom_field'])) {
			$data['custom_field'] = new stdClass();
		}

		// totals
		$data = array_replace($data, $this->totals());

		// products
		$data = array_replace($data, $this->products());

		// vouchers
		$data['vouchers'] = array();

		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $voucher) {
				$data['vouchers'][] = array(
					'description'      => $voucher['description'],
					'code'             => token(10),
					'to_name'          => $voucher['to_name'],
					'to_email'         => $voucher['to_email'],
					'from_name'        => $voucher['from_name'],
					'from_email'       => $voucher['from_email'],
					'voucher_theme_id' => $voucher['voucher_theme_id'],
					'message'          => $voucher['message'],
					'amount'           => $voucher['amount'],
				);
			}
		}

		// payment address
		$data = array_replace($data, $this->get_address('payment'));

		// shipping address
		$data = array_replace($data, $this->get_address('shipping'));

		// shipping methods
		if ($this->cart->hasShipping()) {
			$this->shipping_methods();
		} else {
			$this->session->data['shipping_methods'] = array();
			$this->session->data['shipping_method'] = '';
		}

		// shipping method
		$data = array_replace($data, $this->shipping_method());

		// payment methods
		$this->payment_methods($data['total']);

		// payment method
		$data = array_replace($data, $this->payment_method());

		// recalculate totals
		$data = array_replace($data, $this->totals());

		// save
		$this->model_journal3_order->save($order_id, $data);

		return $data;
	}

	private function set_address($type, $address) {
		foreach (static::$ADDRESS_FIELDS as $key => $value) {
			$this->session->data[$type . '_address'][$key] = Arr::get($address, $key, $value);
		}

		if (!Arr::get($this->session->data, $type . '_address.country_id')) {
			switch ($this->journal3->settings->get('quickCheckoutAddressDefaultCountry')) {
				case 'store_address':
					$this->session->data[$type . '_address']['country_id'] = $this->config->get('config_country_id');
					break;
				default:
					$this->session->data[$type . '_address']['country_id'] = '';
			}

			switch ($this->journal3->settings->get('quickCheckoutAddressDefaultZone')) {
				case 'store_address':
					$this->session->data[$type . '_address']['zone_id'] = $this->config->get('config_zone_id');
					break;
				default:
					$this->session->data[$type . '_address']['zone_id'] = '';
			}
		}

		$country_info = $this->model_localisation_country->getCountry($this->session->data[$type . '_address']['country_id']);

		if ($country_info) {
			$this->session->data[$type . '_address']['country'] = $country_info['name'];
			$this->session->data[$type . '_address']['iso_code_2'] = $country_info['iso_code_2'];
			$this->session->data[$type . '_address']['iso_code_3'] = $country_info['iso_code_3'];
			$this->session->data[$type . '_address']['address_format'] = $country_info['address_format'];
		} else {
			$this->session->data[$type . '_address']['country'] = '';
			$this->session->data[$type . '_address']['iso_code_2'] = '';
			$this->session->data[$type . '_address']['iso_code_3'] = '';
			$this->session->data[$type . '_address']['address_format'] = '';
		}

		$zone_info = $this->model_localisation_zone->getZone($this->session->data[$type . '_address']['zone_id']);

		if ($zone_info && $zone_info['country_id'] == $this->session->data[$type . '_address']['country_id']) {
			$this->session->data[$type . '_address']['zone'] = $zone_info['name'];
			$this->session->data[$type . '_address']['zone_code'] = $zone_info['code'];
		} else {
			$this->session->data[$type . '_address']['zone'] = '';
			$this->session->data[$type . '_address']['zone_id'] = '';
			$this->session->data[$type . '_address']['zone_code'] = '';
		}

		if ($type === 'shipping') {
			$this->tax->unsetRates();
			$this->tax->setShippingAddress($this->session->data['shipping_address']['country_id'], $this->session->data['shipping_address']['zone_id']);
		}

		if ($type === 'payment') {
			$this->tax->unsetRates();
			$this->tax->setPaymentAddress($this->session->data['payment_address']['country_id'], $this->session->data['payment_address']['zone_id']);
		}
	}

	public function extract_address($type, $data) {
		$result = array();

		foreach (static::$ADDRESS_FIELDS as $key => $value) {
			$result[$key] = Arr::get($data, $type . '_' . $key, $value);
		}

		return $result;
	}

	public function get_address($type) {
		$result = array();

		foreach (static::$ADDRESS_FIELDS as $key => $value) {
			$result[$type . '_' . $key] = $this->session->data[$type . '_address'][$key];
		}

		return $result;
	}

	private function custom_fields($data) {
		$custom_fields = $this->model_account_custom_field->getCustomFields($data['customer_group_id']);

		$result = array(
			'custom_fields'         => array(),
			'custom_field'          => array(),
			'payment_custom_field'  => array(),
			'shipping_custom_field' => array(),
		);

		foreach ($custom_fields as $custom_field) {
			$result['custom_fields'][$custom_field['location']][] = $custom_field;

			if ($custom_field['location'] === 'account') {
				$result['custom_field'][$custom_field['custom_field_id']] = Arr::get($data, 'custom_field.' . $custom_field['custom_field_id'], $custom_field['value']);
			}

			if ($custom_field['location'] === 'address') {
				$result['payment_custom_field'][$custom_field['custom_field_id']] = Arr::get($this->session->data, 'payment_address.custom_field.' . $custom_field['custom_field_id'], $custom_field['value']);
				$result['shipping_custom_field'][$custom_field['custom_field_id']] = Arr::get($this->session->data, 'shipping_address.custom_field.' . $custom_field['custom_field_id'], $custom_field['value']);
			}
		}

		$this->session->data['payment_address']['custom_field'] = $result['payment_custom_field'];
		$this->session->data['shipping_address']['custom_field'] = $result['shipping_custom_field'];

		return $result;
	}

	private function totals() {
		$totals = array();
		$taxes = $this->cart->getTaxes();
		$total = 0;

		// Because __call can not keep var references so we put them into an array.
		$total_data = array(
			'totals' => &$totals,
			'taxes'  => &$taxes,
			'total'  => &$total,
		);

		if ($this->journal3->isOC2()) {
			$this->load->model('extension/extension');

			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('extension/total/' . $result['code']);

					// We have to put the totals in an array so that they pass by reference.
					$this->{'model_extension_total_' . $result['code']}->getTotal($total_data);
				}
			}
		} else {
			$sort_order = array();

			$this->load->model('setting/extension');

			$results = $this->model_setting_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get('total_' . $value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get('total_' . $result['code'] . '_status')) {
					$this->load->model('extension/total/' . $result['code']);

					// We have to put the totals in an array so that they pass by reference.
					$this->{'model_extension_total_' . $result['code']}->getTotal($total_data);
				}
			}
		}

		$sort_order = array();

		foreach ($totals as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $totals);

		return array(
			'total'  => $total,
			'totals' => $totals,
		);
	}

	private function products() {
		$products = array();
		$points = 0;

		foreach ($this->cart->getProducts() as $product) {
			$option_data = array();

			foreach ($product['option'] as $option) {
				$option_data[] = array(
					'product_option_id'       => $option['product_option_id'],
					'product_option_value_id' => $option['product_option_value_id'],
					'option_id'               => $option['option_id'],
					'option_value_id'         => $option['option_value_id'],
					'name'                    => $option['name'],
					'value'                   => $option['value'],
					'type'                    => $option['type'],
				);
			}

			if ($product['points']) {
				$points += $product['points'];
			}

			$products[] = array(
				'product_id' => $product['product_id'],
				'name'       => $product['name'],
				'model'      => $product['model'],
				'option'     => $option_data,
				'download'   => $product['download'],
				'quantity'   => $product['quantity'],
				'subtract'   => $product['subtract'],
				'price'      => $product['price'],
				'total'      => $product['total'],
				'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
				'reward'     => $product['reward'],
			);
		}

		return array(
			'products' => $products,
			'points'   => $points,
		);
	}

	private function shipping_methods() {
		$method_data = array();

		if ($this->journal3->isOC2()) {
			$results = $this->model_extension_extension->getExtensions('shipping');

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('extension/shipping/' . $result['code']);

					$quote = $this->{'model_extension_shipping_' . $result['code']}->getQuote($this->session->data['shipping_address']);

					if ($quote) {
						$method_data[$result['code']] = array(
							'title'      => $quote['title'],
							'quote'      => $quote['quote'],
							'sort_order' => $quote['sort_order'],
							'error'      => $quote['error'],
						);
					}
				}
			}
		} else {
			$results = $this->model_setting_extension->getExtensions('shipping');

			foreach ($results as $result) {
				if ($this->config->get('shipping_' . $result['code'] . '_status')) {
					$this->load->model('extension/shipping/' . $result['code']);

					$quote = $this->{'model_extension_shipping_' . $result['code']}->getQuote($this->session->data['shipping_address']);

					if ($quote) {
						$method_data[$result['code']] = array(
							'title'      => $quote['title'],
							'quote'      => $quote['quote'],
							'sort_order' => $quote['sort_order'],
							'error'      => $quote['error'],
						);
					}
				}
			}

		}

		$sort_order = array();

		foreach ($method_data as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $method_data);

		$this->session->data['shipping_methods'] = $method_data;

		return $method_data;
	}

	private function shipping_method() {
		$code = Arr::get($this->session->data, 'shipping_method.code');

		if ($code) {
			$shipping = explode('.', $code);

			if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
				$code = null;
			}
		} else {
			$code = null;
		}

		if ($code === null && $this->journal3->settings->get('sectionShippingAutoSelect')) {
			foreach ($this->session->data['shipping_methods'] as $shipping_methods) {
				if (is_array($shipping_methods['quote'])) {
					foreach ($shipping_methods['quote'] as $shipping_method) {
						$code = $shipping_method['code'];
						break 2;
					}
				}
			}
		}

		if ($code) {
			$shipping = explode('.', $code);

			$shipping_method = Arr::get($this->session->data, 'shipping_methods.' . $shipping[0] . '.quote.' . $shipping[1]);

			$this->session->data['shipping_method'] = $shipping_method;
		} else {
			unset($this->session->data['shipping_method']);
		}

		return array(
			'shipping_method' => Arr::get($this->session->data, 'shipping_method.title', ''),
			'shipping_code'   => Arr::get($this->session->data, 'shipping_method.code', ''),
		);
	}

	private function payment_methods($total) {
		$method_data = array();

		if ($this->journal3->isOC2()) {
			$results = $this->model_extension_extension->getExtensions('payment');

			$recurring = $this->cart->hasRecurringProducts();

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('extension/payment/' . $result['code']);

					$method = $this->{'model_extension_payment_' . $result['code']}->getMethod($this->session->data['payment_address'], $total);

					if ($method) {
						if ($recurring) {
							if (property_exists($this->{'model_extension_payment_' . $result['code']}, 'recurringPayments') && $this->{'model_extension_payment_' . $result['code']}->recurringPayments()) {
								$method_data[$result['code']] = $method;
							}
						} else {
							$method_data[$result['code']] = $method;
						}
					}
				}
			}
		} else {
			$results = $this->model_setting_extension->getExtensions('payment');

			$recurring = $this->cart->hasRecurringProducts();

			foreach ($results as $result) {
				if ($this->config->get('payment_' . $result['code'] . '_status')) {
					$this->load->model('extension/payment/' . $result['code']);

					$method = $this->{'model_extension_payment_' . $result['code']}->getMethod($this->session->data['payment_address'], $total);

					if ($method) {
						if ($recurring) {
							if (property_exists($this->{'model_extension_payment_' . $result['code']}, 'recurringPayments') && $this->{'model_extension_payment_' . $result['code']}->recurringPayments()) {
								$method_data[$result['code']] = $method;
							}
						} else {
							$method_data[$result['code']] = $method;
						}
					}
				}
			}
		}

		$sort_order = array();

		foreach ($method_data as $key => $value) {
			$sort_order[$key] = $value['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $method_data);

		$this->session->data['payment_methods'] = $method_data;

		return $method_data;
	}

	private function payment_method() {
		$code = Arr::get($this->session->data, 'payment_method.code');

		if (!isset($this->session->data['payment_methods'][$code])) {
			$code = null;
		}

		if ($code === null && $this->journal3->settings->get('sectionPaymentAutoSelect')) {
			foreach ($this->session->data['payment_methods'] as $payment_method) {
				$code = $payment_method['code'];
				break;
			}
		}

		if ($code) {
			$payment_method = Arr::get($this->session->data, 'payment_methods.' . $code);

			$this->session->data['payment_method'] = $payment_method;
		} else {
			unset($this->session->data['payment_method']);
		}

		return array(
			'payment_method' => Arr::get($this->session->data, 'payment_method.title', ''),
			'payment_code'   => Arr::get($this->session->data, 'payment_method.code', ''),
		);
	}

	public function editCustomerId($customer_id) {
		$order_id = Arr::get($this->session->data, 'order_id');

		$this->db->query("UPDATE `" . DB_PREFIX . "order` SET customer_id = '" . (int)$customer_id . "' WHERE order_id = '" . (int)$order_id . "'");
	}

	public function addAddress($customer_id, $data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', city = '" . $this->db->escape($data['city']) . "', zone_id = '" . (int)$data['zone_id'] . "', country_id = '" . (int)$data['country_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : '') . "'");

		$address_id = $this->db->getLastId();

		return $address_id;
	}

	public function setCheckoutId() {
		$this->session->data['j3_checkout_id'] = md5(time());

		return $this->session->data['j3_checkout_id'];
	}

	public function checkCheckoutId($checkout_id) {
		return Arr::get($this->session->data, 'j3_checkout_id') === $checkout_id;
	}

}
