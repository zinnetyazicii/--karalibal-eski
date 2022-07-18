<?php

use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class ControllerJournal3Checkout extends \Journal3\Opencart\Controller {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('account/address');
		$this->load->model('account/customer');
		$this->load->model('account/customer_group');
		$this->load->model('catalog/information');
		$this->load->model('journal3/checkout');
		$this->load->model('journal3/order');
		$this->load->model('journal3/links');
		$this->load->model('journal3/image');
		$this->load->model('journal3/newsletter');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$this->load->model('tool/upload');

		$this->load->language('extension/total/coupon');
		$this->load->language('extension/total/voucher');
		$this->load->language('extension/total/reward');
		$this->load->language('checkout/cart');
		$this->load->language('checkout/checkout');

		if (isset($this->request->post['order_data'])) {
			foreach ($this->request->post['order_data'] as $key => &$value) {
				if (is_string($value)) {
					$value = trim($value);
				}
			}
		}
	}

	public function index() {
		if (!$this->customer->isLogged() && $this->config->get('config_customer_price')) {
			$this->response->redirect($this->model_journal3_links->url('account/login', '', true));
			exit;
		}

		if (!$this->journal3->isAdmin() && ((Arr::get($this->request->get, 'route') === 'journal3/checkout') || (Arr::get($this->request->get, '_route_') === 'journal3/checkout'))) {
			$this->response->redirect($this->model_journal3_links->url('checkout/checkout', '', true));
		}

		if (!$this->checkCart()) {
			$this->response->redirect($this->model_journal3_links->url('checkout/cart', '', true));
		}

		$this->document->setTitle($this->journal3->settings->get('checkoutTitle'));

		$data['heading_title'] = $this->journal3->settings->get('checkoutTitle');

		$this->journal3->settings->set('performanceHTMLMinify', false);
		$this->journal3->settings->set('performanceCSSMinify', false);
		$this->journal3->settings->set('performanceCSSInline', false);
		$this->journal3->settings->set('performanceJSMinify', false);
		$this->journal3->settings->set('performanceJSDefer', false);

		if ($this->journal3->isDev()) {
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/vue/vue.js', 'footer');
		} else {
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/vue/vue.min.js', 'footer');
		}

		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/he/he.js', 'footer');
		$this->journal3->document->addScript('catalog/view/theme/journal3/js/checkout.js', 'footer');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}

		// breadcrumbs
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->model_journal3_links->url('common/home'),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_cart'),
			'href' => $this->model_journal3_links->url('checkout/cart'),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->model_journal3_links->url('checkout/checkout', '', true),
		);

		// checkout data
		$data['checkout_data'] = $this->getCheckoutData($this->model_journal3_checkout->init());

		// hide payment details for iframe payments
		$payments = Arr::get($data['checkout_data'], 'quickCheckoutPaymentsPopup', array());

		if (is_array($payments) && count($payments)) {
			foreach ($payments as $payment) {
				$this->journal3->document->addCss('.quick-checkout-wrapper .payment-' . $payment . ' { display: none; }');
			}
		}

		// custom fields sort order
		$css = array();

		$custom_fields = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field`")->rows;

		foreach ($custom_fields as $custom_field) {
			$order = (int)$custom_field['sort_order'];

			if ($order) {
				if ($custom_field['location'] === 'account') {
					$css[] = '#account-custom-field' . $custom_field['custom_field_id'] . ' { order: ' . $order . ' }';
				}

				if ($custom_field['location'] === 'address') {
					$css[] = '#shipping-custom-field' . $custom_field['custom_field_id'] . ' { order: ' . $order . ' }';
					$css[] = '#payment-custom-field' . $custom_field['custom_field_id'] . ' { order: ' . $order . ' }';
				}
			}
		}

		if ($css) {
			$this->journal3->document->addCss(implode(PHP_EOL, $css));
		}

		$data['login_block'] = $this->renderView('journal3/checkout/login', array(
			'entry_email'    => htmlspecialchars($this->language->get('entry_email')),
			'entry_password' => $this->language->get('entry_password'),
			'forgotten'      => $this->model_journal3_links->url('account/forgotten', '', true),
			'text_forgotten' => $this->language->get('text_forgotten'),
			'text_loading'   => $this->language->get('text_loading'),
			'button_login'   => $this->language->get('button_login'),
		));

		$data['register_block'] = $this->renderView('journal3/checkout/register', array(
			'customer_groups'      => $this->getCustomerGroups(),
			'entry_customer_group' => $this->language->get('entry_customer_group'),
			'entry_firstname'      => $this->language->get('entry_firstname'),
			'entry_lastname'       => $this->language->get('entry_lastname'),
			'entry_email'          => htmlspecialchars($this->language->get('entry_email')),
			'entry_telephone'      => $this->language->get('entry_telephone'),
			'entry_fax'            => $this->language->get('entry_fax'),
			'text_select'          => $this->language->get('text_select'),
			'entry_password'       => $this->language->get('entry_password'),
			'entry_confirm'        => $this->language->get('entry_confirm'),
			'button_upload'        => $this->language->get('button_upload'),
		));

		$data['payment_address_block'] = $this->renderView('journal3/checkout/address', array(
			'type'                  => 'payment',
			'entry_shipping'        => $this->language->get('entry_shipping'),
			'entry_firstname'       => $this->language->get('entry_firstname'),
			'entry_lastname'        => $this->language->get('entry_lastname'),
			'entry_company'         => $this->language->get('entry_company'),
			'entry_address_1'       => $this->language->get('entry_address_1'),
			'entry_address_2'       => $this->language->get('entry_address_2'),
			'entry_city'            => $this->language->get('entry_city'),
			'entry_postcode'        => $this->language->get('entry_postcode'),
			'entry_country'         => $this->language->get('entry_country'),
			'entry_zone'            => $this->language->get('entry_zone'),
			'text_address_existing' => $this->language->get('text_address_existing'),
			'text_address_new'      => $this->language->get('text_address_new'),
			'text_select'           => $this->language->get('text_select'),
			'text_none'             => $this->language->get('text_none'),
			'button_upload'         => $this->language->get('button_upload'),
		));

		$data['shipping_address_block'] = $this->renderView('journal3/checkout/address', array(
			'type'                  => 'shipping',
			'entry_shipping'        => $this->language->get('entry_shipping'),
			'entry_firstname'       => $this->language->get('entry_firstname'),
			'entry_lastname'        => $this->language->get('entry_lastname'),
			'entry_company'         => $this->language->get('entry_company'),
			'entry_address_1'       => $this->language->get('entry_address_1'),
			'entry_address_2'       => $this->language->get('entry_address_2'),
			'entry_city'            => $this->language->get('entry_city'),
			'entry_postcode'        => $this->language->get('entry_postcode'),
			'entry_country'         => $this->language->get('entry_country'),
			'entry_zone'            => $this->language->get('entry_zone'),
			'text_address_existing' => $this->language->get('text_address_existing'),
			'text_address_new'      => $this->language->get('text_address_new'),
			'text_select'           => $this->language->get('text_select'),
			'text_none'             => $this->language->get('text_none'),
			'button_upload'         => $this->language->get('button_upload'),
		));

		$data['shipping_method_block'] = $this->renderView('journal3/checkout/shipping_method', array(
			'error_warning' => sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact')),
		));

		$data['payment_method_block'] = $this->renderView('journal3/checkout/payment_method', array(
			'error_warning' => sprintf($this->language->get('error_no_payment'), $this->url->link('information/contact')),
		));

		$data['coupon_voucher_reward_block'] = $this->renderView('journal3/checkout/coupon_voucher_reward', array(
			'text_loading'   => $this->language->get('text_loading'),
			'entry_coupon'   => $this->language->get('entry_coupon'),
			'button_coupon'  => $this->language->get('button_coupon'),
			'entry_voucher'  => $this->language->get('entry_voucher'),
			'button_voucher' => $this->language->get('button_voucher'),
			'entry_reward'   => sprintf($this->language->get('entry_reward'), $data['checkout_data']['order_data']['points']),
			'button_reward'  => $this->language->get('button_reward'),
			'button_submit'  => $this->language->get('button_submit'),
		));

		$data['cart_block'] = $this->renderView('journal3/checkout/cart', array(
			'column_image'        => $this->language->get('column_image'),
			'column_name'         => $this->language->get('column_name'),
			'column_model'        => $this->language->get('column_model'),
			'column_quantity'     => $this->language->get('column_quantity'),
			'column_price'        => $this->language->get('column_price'),
			'column_total'        => $this->language->get('column_total'),
			'text_recurring_item' => $this->language->get('text_recurring_item'),
			'button_update'       => $this->language->get('button_update'),
			'button_remove'       => $this->language->get('button_remove'),
			'error_warning'       => $this->language->get('error_stock'),
		));

		// Captcha
		if (!$this->customer->isLogged() && $this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('guest', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'));
			if ($this->config->get('config_captcha') === 'google') {
				$captcha = str_replace('<script src="//www.google.com/recaptcha/api.js" type="text/javascript"></script>', '', $captcha);
				$this->document->addScript('https://www.google.com/recaptcha/api.js');
			}
		} else {
			$captcha = '';
		}

		$newsletter = $this->journal3->settings->get('quickCheckoutConfirmNewsletter') ? sprintf($this->language->get('entry_newsletter'), $this->config->get('config_name')) : false;

		if ($this->customer->isLogged() && ($this->model_journal3_newsletter->isSubscribed($this->customer->getEmail()) || $this->customer->getNewsletter())) {
			$newsletter = false;
		}

		$data['confirm_block'] = $this->renderView('journal3/checkout/confirm', array(
			'captcha'         => $captcha,
			'text_loading'    => $this->language->get('text_loading'),
			'button_continue' => $this->language->get('button_continue'),
			'text_comments'   => $this->language->get('text_comments'),
			'newsletter'      => $newsletter,
			'agree'           => Arr::get($this->model_journal3_links->getInformation($this->config->get('config_checkout_id')), 'text'),
			'privacy'         => $this->customer->isLogged() || ($this->config->get('config_checkout_id') == $this->config->get('config_account_id')) ? null : Arr::get($this->model_journal3_links->getInformation($this->config->get('config_account_id')), 'text'),
			'comment'         => Arr::get($data, 'checkout_data.order_data.comment'),
		));

		$data['checkout_data']['checkout_id'] = $this->model_journal3_checkout->setCheckoutId();

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->renderOutput('journal3/checkout/checkout', $data);
	}

	public function save() {
		$json = array();
		$error = array();

		if (!$this->model_journal3_checkout->checkCheckoutId(Arr::get($this->request->post, 'checkout_id'))) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', true);
			$this->renderJson('success', $json);

			return;
		}

		if ($this->config->get($this->journal3->isOC2() ? 'coupon_status' : 'total_coupon_status') && $this->request->post['coupon']) {
			$this->load->language('extension/total/coupon');
			$this->load->model('extension/total/coupon');
			$coupon_info = $this->model_extension_total_coupon->getCoupon($this->request->post['coupon']);

			if ($coupon_info) {
				$this->session->data['coupon'] = $this->request->post['coupon'];
				$json['coupon_message'] = $this->language->get('text_success');
			} else {
				$error['coupon'] = $this->language->get('error_coupon');
				unset($this->session->data['coupon']);
			}
		} else {
			unset($this->session->data['coupon']);
		}

		if ($this->config->get($this->journal3->isOC2() ? 'voucher_status' : 'total_voucher_status') && $this->request->post['voucher']) {
			$this->load->language('extension/total/voucher');
			$this->load->model('extension/total/voucher');
			$voucher_info = $this->model_extension_total_voucher->getVoucher($this->request->post['voucher']);

			if ($voucher_info) {
				$this->session->data['voucher'] = $this->request->post['voucher'];
				$json['voucher_message'] = $this->language->get('text_success');
			} else {
				$error['voucher'] = $this->language->get('error_voucher');
				unset($this->session->data['voucher']);
			}
		} else {
			unset($this->session->data['voucher']);
		}

		if ($this->config->get($this->journal3->isOC2() ? 'reward_status' : 'total_reward_status') && $this->request->post['reward']) {
			$this->load->language('extension/total/reward');

			$points = $this->customer->getRewardPoints();

			$points_total = 0;

			foreach ($this->cart->getProducts() as $product) {
				if ($product['points']) {
					$points_total += $product['points'];
				}
			}

			if (empty($this->request->post['reward'])) {
				$error['reward'] = $this->language->get('error_reward');
				unset($this->session->data['reward']);
			} else if ($this->request->post['reward'] > $points) {
				$error['reward'] = sprintf($this->language->get('error_points'), $this->request->post['reward']);
				unset($this->session->data['reward']);
			} else if ($this->request->post['reward'] > $points_total) {
				$error['reward'] = sprintf($this->language->get('error_maximum'), $points_total);
				unset($this->session->data['reward']);
			} else {
				$this->session->data['reward'] = abs($this->request->post['reward']);
			}
		} else {
			unset($this->session->data['reward']);
		}

		$data = $this->model_journal3_checkout->update();

		if ($this->checkCart()) {
			$json = array_replace($this->getCheckoutData($data), $json);

			if (Arr::get($this->request->get, 'confirm') === 'true') {
				if (!$this->customer->isLogged() && $this->config->get('captcha_' . $this->config->get('config_captcha') . '_status') && in_array('guest', (array)$this->config->get('config_captcha_page'))) {
					$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

					if ($captcha) {
						$error['captcha'] = $captcha;
					}
				}

				if (!Arr::get($data, 'payment_code')) {
					$error['payment_code'] = $this->language->get('error_payment');
				}

				if (!Arr::get($data, 'shipping_code') && $this->cart->hasShipping()) {
					$error['shipping_code'] = $this->language->get('error_shipping');
				}

				$agree = $this->model_journal3_links->getInformation($this->config->get('config_checkout_id'));

				if ($agree && !$this->validateInformation('agree')) {
					$error['agree'] = $agree['error'];
				}

				if ($this->journal3->settings->get('quickCheckoutComments') === 'required' && !Arr::get($this->request->post, 'order_data.comment')) {
					$error['comments'] = true;
				}

				if (!$this->customer->isLogged()) {
					$error = array_replace($error, $this->validateAccount($json['custom_fields']));

					if ($this->config->get('config_checkout_id') != $this->config->get('config_account_id')) {
						$privacy = $this->model_journal3_links->getInformation($this->config->get('config_account_id'));

						if ($privacy && !$this->validateInformation('privacy')) {
							$error['privacy'] = $privacy['error'];
						}
					}
				}

				if ($err = $this->validateAddress('payment', $json['custom_fields'])) {
					$error = array_replace($error, $err);
					$error['payment_address_error'] = $this->journal3->settings->get('confirmOrderAddressErrorText');
				}

				if (!$this->session->data['same_address'] && $this->cart->hasShipping()) {
					if ($err = $this->validateAddress('shipping', $json['custom_fields'])) {
						$error = array_replace($error, $err);
						$error['shipping_address_error'] = $this->journal3->settings->get('confirmOrderAddressErrorText');
					}
				}

				if (!$error) {
					if ($this->customer->isLogged()) {
						if ($this->session->data['payment_address_type'] === 'new') {
							$this->addAccountAddress('payment');
						}

						if (!$this->session->data['same_address'] && $this->session->data['shipping_address_type'] === 'new') {
							$this->addAccountAddress('shipping');
						}

						if (Arr::get($this->request->post, 'newsletter') === 'true') {
							$this->model_account_customer->editNewsletter(1);
						}
					} else if ($this->session->data['account'] === 'register') {
						$this->registerAccount($json['order_data']);
					} else {
						$this->registerGuest($json['order_data']);
					}
				}
			}
		} else {
			$json['redirect'] = $this->model_journal3_links->url('checkout/cart', '', true);
		}

		$json['error'] = $error ? $error : null;

		$this->renderJson('success', $json);
	}

	public function cart_update() {
		if (!$this->model_journal3_checkout->checkCheckoutId(Arr::get($this->request->post, 'checkout_id'))) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', true);
			$this->renderJson('success', $json);

			return;
		}

		$key = Arr::get($this->request->post, 'key');
		$qty = Arr::get($this->request->post, 'quantity');

		$this->cart->update($key, $qty);

		$json = array();

		if ($this->checkCart()) {
			$json = $this->getCheckoutData($this->model_journal3_checkout->update());
		} else {
			$json['redirect'] = $this->model_journal3_links->url('checkout/cart', '', true);
		}

		$this->renderJson('success', $json);
	}

	public function cart_delete() {
		if (!$this->model_journal3_checkout->checkCheckoutId(Arr::get($this->request->post, 'checkout_id'))) {
			$json['redirect'] = $this->url->link('checkout/checkout', '', true);
			$this->renderJson('success', $json);

			return;
		}

		$key = Arr::get($this->request->post, 'key');

		$this->cart->remove($key);

		unset($this->session->data['vouchers'][$key]);

		$json = array();

		if ($this->checkCart()) {
			$json = $this->getCheckoutData($this->model_journal3_checkout->update());
		} else {
			$json['redirect'] = $this->model_journal3_links->url('checkout/cart', '', true);
		}

		$this->renderJson('success', $json);
	}

	public function payment() {
		$this->response->setOutput($this->load->controller('extension/payment/' . Arr::get($this->session->data, 'payment_method.code')));
	}

	private function totals($totals) {
		$result = array();

		foreach ($totals as $total) {
			$result[] = array(
				'title' => $total['title'],
				'text'  => $this->currency->format($total['value'], $this->session->data['currency']),
			);
		}

		return $result;
	}

	private function vouchers() {
		$result = array();

		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $key => $voucher) {
				$result[] = array(
					'key'         => $key,
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'], $this->session->data['currency']),
					'remove'      => $this->url->link('checkout/cart', 'remove=' . $key),
				);
			}
		}

		return $result;
	}

	private function products() {
		$result = array();

		foreach ($this->cart->getProducts() as $product) {
			$option_data = array();

			foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['value'];
				} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

					if ($upload_info) {
						$value = $upload_info['name'];
					} else {
						$value = '';
					}
				}

				$option_data[] = array(
					'name'  => $option['name'],
					'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
				);
			}

			$recurring = '';

			if ($product['recurring']) {
				$frequencies = array(
					'day'        => $this->language->get('text_day'),
					'week'       => $this->language->get('text_week'),
					'semi_month' => $this->language->get('text_semi_month'),
					'month'      => $this->language->get('text_month'),
					'year'       => $this->language->get('text_year'),
				);

				if ($product['recurring']['trial']) {
					$recurring = sprintf($this->language->get('text_trial_description'), $this->currency->format($this->tax->calculate($product['recurring']['trial_price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']), $product['recurring']['trial_cycle'], $frequencies[$product['recurring']['trial_frequency']], $product['recurring']['trial_duration']) . ' ';
				}

				if ($product['recurring']['duration']) {
					$recurring .= sprintf($this->language->get('text_payment_description'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
				} else {
					$recurring .= sprintf($this->language->get('text_payment_cancel'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
				}
			}

			if ($product['image']) {
				$thumb = $this->model_journal3_image->resize($product['image'], $this->journal3->themeConfig('image_cart_width'), $this->journal3->themeConfig('image_cart_height'));
				$thumb2x = $this->model_journal3_image->resize($product['image'], $this->journal3->themeConfig('image_cart_width') * 2, $this->journal3->themeConfig('image_cart_height') * 2);
			} else {
				$thumb = '';
				$thumb2x = '';
			}

			$result[] = array(
				'cart_id'    => $product['cart_id'],
				'product_id' => $product['product_id'],
				'name'       => $product['name'],
				'model'      => $product['model'],
				'option'     => $option_data,
				'recurring'  => $recurring,
				'quantity'   => $product['quantity'],
				'stock'      => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
				'subtract'   => $product['subtract'],
				'price'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']),
				'total'      => $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'], $this->session->data['currency']),
				'href'       => str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $product['product_id'])),
				'thumb'      => $thumb,
				'thumb2x'    => $thumb2x,
			);
		}

		return $result;
	}

	private function checkCart() {
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			return false;
		}

		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				return false;
			}
		}

		return true;
	}

	private function getCustomerGroups() {
		$results = array();

		if (is_array($this->config->get('config_customer_group_display'))) {
			$customer_groups = $this->model_account_customer_group->getCustomerGroups();

			foreach ($customer_groups as $customer_group) {
				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$results[] = $customer_group;
				}
			}
		}

		return $results;
	}

	private function getCountries() {
		$countries = $this->model_localisation_country->getCountries();

		$result = array();

		foreach ($countries as $country) {
			$result[] = array(
				'country_id' => $country['country_id'],
				'name'       => $country['name'],
			);
		}

		return $result;
	}

	private function getZones($country_id) {
		$zones = $this->model_localisation_zone->getZonesByCountryId($country_id);

		$result = array();

		foreach ($zones as $zone) {
			$result[] = array(
				'zone_id' => $zone['zone_id'],
				'name'    => $zone['name'],
			);
		}

		return $result;
	}

	private function getCheckoutData($data) {
		if ($this->customer->isLogged()) {
			$customer_id = $this->customer->getId();
			$addresses = $this->model_account_address->getAddresses();
		} else {
			$customer_id = '';
			$addresses = array();
		}

		$total_items = $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0);

		return array(
			'stock_warning'              => !$this->cart->hasStock() && $this->config->get('config_stock_warning'),
			'shipping_required'          => $this->cart->hasShipping(),
			'account'                    => $this->session->data['account'],
			'login_email'                => '',
			'login_password'             => '',
			'guest'                      => (bool)$this->config->get('config_checkout_guest') && !$this->cart->hasDownload(),
			'same_address'               => $this->session->data['same_address'],
			'password'                   => '',
			'password2'                  => '',
			'customer_id'                => $customer_id,
			'addresses'                  => $addresses,
			'order_data'                 => $data,
			'custom_fields'              => $data['custom_fields'],
			'payment_address_type'       => $addresses ? 'existing' : 'new',
			'shipping_address_type'      => $addresses ? 'existing' : 'new',
			'shipping_methods'           => $this->session->data['shipping_methods'],
			'payment_methods'            => $this->session->data['payment_methods'],
			'countries'                  => $this->getCountries(),
			'shipping_zones'             => $this->getZones($data['shipping_country_id']),
			'payment_zones'              => $this->getZones($data['payment_country_id']),
			'products'                   => $this->products(),
			'vouchers'                   => $this->vouchers(),
			'totals'                     => $this->totals($data['totals']),
			'total'                      => sprintf($this->language->get('text_items'), $total_items, $this->journal3->currencyFormat($data['total'])),
			'total_items'                => $total_items,
			'coupon_status'              => $this->config->get($this->journal3->isOC2() ? 'coupon_status' : 'total_coupon_status'),
			'coupon'                     => Arr::get($this->session->data, 'coupon'),
			'voucher_status'             => $this->config->get($this->journal3->isOC2() ? 'voucher_status' : 'total_voucher_status'),
			'voucher'                    => Arr::get($this->session->data, 'voucher'),
			'reward_status'              => $this->config->get($this->journal3->isOC2() ? 'reward_status' : 'total_reward_status'),
			'reward'                     => Arr::get($this->session->data, 'reward'),
			'newsletter'                 => $this->session->data['newsletter'],
			'agree'                      => false,
			'privacy'                    => false,
			'session'                    => $this->journal3->isDev() ? $this->session->data : null,
			'error'                      => null,
			'cart'                       => $this->load->controller('common/cart'),
			'quickCheckoutPaymentsPopup' => array_map('trim', explode(',', $this->journal3->settings->get('quickCheckoutPaymentsPopup'))),
			'coupon_message'             => null,
			'voucher_message'            => null,
			'reward_message'             => null,
		);
	}

	private function validateInformation($type) {
		return $this->request->post[$type] === 'true';
	}

	private function validateAccount($custom_fields) {
		$error = array();

		// email
		if ((utf8_strlen(Arr::get($this->request->post, 'order_data.email')) > 96) || !filter_var(Arr::get($this->request->post, 'order_data.email'), FILTER_VALIDATE_EMAIL)) {
			$error['email'] = $this->language->get('error_email');
		} else if (($this->session->data['account'] === 'register') && $this->model_account_customer->getTotalCustomersByEmail(Arr::get($this->request->post, 'order_data.email'))) {
			$error['email'] = $this->language->get('error_exists');
		}

		// telephone
		if ($this->journal3->settings->get('quickCheckoutAccountTelephoneField') === 'required') {
			if ((utf8_strlen(Arr::get($this->request->post, 'order_data.telephone')) < 1) || (utf8_strlen(Arr::get($this->request->post, 'order_data.telephone')) > 32)) {
				$error['telephone'] = $this->language->get('error_telephone');
			}
		}

		// passwords
		if ($this->session->data['account'] === 'register') {
			if ((utf8_strlen(Arr::get($this->request->post, 'password')) < 4) || (utf8_strlen(Arr::get($this->request->post, 'password')) > 20)) {
				$error['password'] = $this->language->get('error_password');
			}

			if (Arr::get($this->request->post, 'password2') != Arr::get($this->request->post, 'password')) {
				$error['password2'] = $this->language->get('error_confirm');
			}
		}

		foreach (Arr::get($custom_fields, 'custom_fields.account', array()) as $custom_field) {
			$value = Arr::get($this->request->post, 'order_data.custom_field.' . $custom_field['custom_field_id']);

			if ($custom_field['required'] && empty($value)) {
				$error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			} elseif (($custom_field['type'] == 'text') && !empty($custom_field['validation']) && !filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
				$error['custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			}
		}

		return $error;
	}

	private function validateAddress($type, $custom_fields) {
		// do not validate existing address, may create issues if fields are required after address has been registered
		if (
			$this->customer->isLogged()
			&& Arr::get($this->session->data, $type . '_address.address_id')
			&& Arr::get($this->session->data, $type . '_address_type') === 'existing'
		) {
			return array();
		}

		$error = array();

		// firstname
		if (!$this->customer->isLogged() && $type === 'payment') {
			if ($this->journal3->settings->get('quickCheckoutAccountFirstNameField') === 'required') {
				if ((utf8_strlen(Arr::get($this->session->data, $type . '_address.firstname')) < 1) || (utf8_strlen(Arr::get($this->session->data, $type . '_address.firstname')) > 32)) {
					$error[$type . '_firstname'] = $this->language->get('error_firstname');
				}
			}
		} else {
			if ($this->journal3->settings->get('quickCheckoutAddressFirstNameField') === 'required') {
				if ((utf8_strlen(Arr::get($this->session->data, $type . '_address.firstname')) < 1) || (utf8_strlen(Arr::get($this->session->data, $type . '_address.firstname')) > 32)) {
					$error[$type . '_firstname'] = $this->language->get('error_firstname');
				}
			}
		}

		// lastname
		if (!$this->customer->isLogged() && $type === 'payment') {
			if ($this->journal3->settings->get('quickCheckoutAccountLastNameField') === 'required') {
				if ((utf8_strlen(Arr::get($this->session->data, $type . '_address.lastname')) < 1) || (utf8_strlen(Arr::get($this->session->data, $type . '_address.lastname')) > 32)) {
					$error[$type . '_lastname'] = $this->language->get('error_lastname');
				}
			}
		} else {
			if ($this->journal3->settings->get('quickCheckoutAddressLastNameField') === 'required') {
				if ((utf8_strlen(Arr::get($this->session->data, $type . '_address.lastname')) < 1) || (utf8_strlen(Arr::get($this->session->data, $type . '_address.lastname')) > 32)) {
					$error[$type . '_lastname'] = $this->language->get('error_lastname');
				}
			}
		}

		// address
		if ($this->journal3->settings->get('quickCheckoutAddressCompanyField') === 'required') {
			if ((utf8_strlen(trim(Arr::get($this->session->data, $type . '_address.company'))) < 1)) {
				$error[$type . '_company'] = $this->language->get('error_company');
			}
		}

		if ($this->journal3->settings->get('quickCheckoutAddressAddress1Field') === 'required') {
			if ((utf8_strlen(trim(Arr::get($this->session->data, $type . '_address.address_1'))) < 3) || (utf8_strlen(trim(Arr::get($this->session->data, $type . '_address.address_1'))) > 128)) {
				$error[$type . '_address_1'] = $this->language->get('error_address_1');
			}
		}

		if ($this->journal3->settings->get('quickCheckoutAddressAddress2Field') === 'required') {
			if ((utf8_strlen(trim(Arr::get($this->session->data, $type . '_address.address_2'))) < 3) || (utf8_strlen(trim(Arr::get($this->session->data, $type . '_address.address_2'))) > 128)) {
				$error[$type . '_address_2'] = $this->language->get('error_address_2');
			}
		}

		if ($this->journal3->settings->get('quickCheckoutAddressCityField') === 'required') {
			if ((utf8_strlen(trim(Arr::get($this->session->data, $type . '_address.city'))) < 2) || (utf8_strlen(trim(Arr::get($this->session->data, $type . '_address.city'))) > 128)) {
				$error[$type . '_city'] = $this->language->get('error_city');
			}
		}

		$country_info = $this->model_localisation_country->getCountry(Arr::get($this->session->data, $type . '_address.country_id'));

		if ($this->journal3->settings->get('quickCheckoutAddressPostcodeField') === 'required') {
			if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim(Arr::get($this->session->data, $type . '_address.postcode'))) < 2 || utf8_strlen(trim(Arr::get($this->session->data, $type . '_address.postcode'))) > 10)) {
				$error[$type . '_postcode'] = $this->language->get('error_postcode');
			}
		}

		if ($this->journal3->settings->get('quickCheckoutAddressCountryField') === 'required') {
			if (!Arr::get($this->session->data, $type . '_address.country_id')) {
				$error[$type . '_country'] = $this->language->get('error_country');
			}
		}

		if ($this->journal3->settings->get('quickCheckoutAddressRegionField') === 'required') {
			if (!Arr::get($this->session->data, $type . '_address.zone_id')) {
				$error[$type . '_zone'] = $this->language->get('error_zone');
			}
		}

		foreach (Arr::get($custom_fields, 'custom_fields.address', array()) as $custom_field) {
			$value = Arr::get($this->request->post, 'order_data.' . $type . '_custom_field.' . $custom_field['custom_field_id']);

			if ($custom_field['required'] && empty($value)) {
				$error[$type . '_custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			} elseif (($custom_field['type'] == 'text') && !empty($custom_field['validation']) && !filter_var($value, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $custom_field['validation'])))) {
				$error[$type . '_custom_field'][$custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
			}
		}

		return $error;
	}

	private function registerGuest($order_data) {
		$account_data = array();
		$payment_address = array();
		$shipping_address = array();

		foreach ($order_data as $key => $value) {
			if ($key === 'custom_field') {
				$value = array('account' => $value);
			} else if (($key === 'payment_custom_field') || ($key === 'shipping_custom_field')) {
				$value = array('address' => $value);
			}

			if (Str::startsWith($key, 'payment_')) {
				$payment_address[str_replace('payment_', '', $key)] = $value;
			} else if (Str::startsWith($key, 'shipping_')) {
				$shipping_address[str_replace('shipping_', '', $key)] = $value;
			} else if (in_array($key, array('firstname', 'lastname', 'email', 'telephone', 'fax', 'custom_field', 'customer_group_id'))) {
				$account_data[$key] = $value;
			}
		}

		if (Arr::get($this->request->post, 'newsletter') === 'true') {
			if (!$this->model_journal3_newsletter->isSubscribed($order_data['email'])) {
				$this->model_journal3_newsletter->subscribe($order_data['email']);
			}
		} else {
			if ($this->model_journal3_newsletter->isSubscribed($order_data['email'])) {
				$this->model_journal3_newsletter->unsubscribe($order_data['email']);
			}
		}

		$this->session->data['guest'] = $account_data;
	}

	private function registerAccount($order_data) {
		$order_data['password'] = $this->request->post['password'];

		$account_data = array();
		$payment_address = array();
		$shipping_address = array();

		foreach ($order_data as $key => $value) {
			if ($key === 'custom_field') {
				$value = array('account' => $value);
			} else if (($key === 'payment_custom_field') || ($key === 'shipping_custom_field')) {
				$value = array('address' => $value);
			}

			if (Str::startsWith($key, 'payment_')) {
				$payment_address[str_replace('payment_', '', $key)] = $value;
			} else if (Str::startsWith($key, 'shipping_')) {
				$shipping_address[str_replace('shipping_', '', $key)] = $value;
			} else if (in_array($key, array('firstname', 'lastname', 'email', 'telephone', 'fax', 'custom_field', 'customer_group_id', 'password', 'company'))) {
				$account_data[$key] = $value;
			}
		}

		$account_data['newsletter'] = Arr::get($this->request->post, 'newsletter') === 'true';

		if ($this->journal3->isOC2()) {
			$customer_id = $this->model_account_customer->addCustomer(Arr::merge($account_data, $payment_address));

			if (!$this->session->data['same_address']) {
				$this->model_journal3_checkout->addAddress($customer_id, $shipping_address);
			}
		} else {
			$customer_id = $this->model_account_customer->addCustomer($account_data);

			$address_id = $this->model_account_address->addAddress($customer_id, $payment_address);

			$this->model_account_customer->editAddressId($customer_id, $address_id);

			if (!$this->session->data['same_address']) {
				$this->model_account_address->addAddress($customer_id, $shipping_address);
			}
		}

		$this->model_journal3_checkout->editCustomerId($customer_id);

		$this->model_account_customer->deleteLoginAttempts($order_data['email']);

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($order_data['customer_group_id']);

		if ($customer_group_info && !$customer_group_info['approval']) {
			$this->customer->login($order_data['email'], $order_data['password']);
		} else {
			return $this->url->link('account/success');
		}

		return null;
	}

	private function addAccountAddress($type) {
		$address = $this->model_journal3_checkout->extract_address($type, $this->model_journal3_checkout->get_address($type));

		if ($this->journal3->isOC2()) {
			$this->model_account_address->addAddress($address);
		} else {
			$custom_field = $address['custom_field'];
			unset($address['custom_field']);
			$address['custom_field']['address'] = $custom_field;

			$address_id = $this->model_account_address->addAddress($this->customer->getId(), $address);

			if (!$this->customer->getAddressId()) {
				$this->model_account_customer->editAddressId($this->customer->getId(), $address_id);
			}
		}
	}

}
