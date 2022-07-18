<?php

use Journal3\Utils\Arr;
use Journal3\Utils\Request;

class ModelJournal3Links extends \Journal3\Opencart\Model {

	public function url($route, $args = '', $secure = false) {
		return $this->url->link($route, $args, Request::isHttps() || $secure);
	}

	public function link($link) {
		$result = array(
			'type'    => Arr::get($link, 'type'),
			'id'      => Arr::get($link, 'id'),
			'href'    => '',
			'name'    => '',
			'total'   => null,
			'attrs'   => array(),
			'classes' => array(),
		);

		if (Arr::get($link, 'target') === 'true') {
			$result['attrs']['target'] = 'target="_blank"';
		}

		if ($rel = Arr::get($link, 'rel')) {
			$result['attrs'][$rel] = 'rel="' . $rel . '"';
		}

		switch ($result['type']) {
			case 'none':
				$result['href'] = '';
				break;

			case 'custom':
				$result['href'] = Arr::get($link, 'url');
				break;

			case 'page':
				$page = Arr::get($link, 'page');

				if ($page) {
					if (version_compare(VERSION, '2', '>=') && $page === 'account/return/insert') {
						$page = 'account/return/add';
					}

					if (version_compare(VERSION, '3', '>=') && $page === 'affiliate/account') {
						$page = 'affiliate/login';
					}

					$result['href'] = $this->url($page, '', Request::isHttps());

					switch ($page) {
						case 'common/home':
							$result['href'] = str_replace('index.php?route=common/home', '', $result['href']);
							break;

						case 'checkout/cart':
							$result['classes'][] = 'cart-badge';
							$result['total'] = '{{ $cart }}';
							break;

						case 'account/wishlist':
							$result['classes'][] = 'wishlist-badge';
							$result['total'] = '{{ $wishlist }}';
							break;

						case 'product/compare':
							$result['classes'][] = 'compare-badge';
							$result['total'] = '{{ $compare }}';
							break;
					}
				}
				break;

			case 'category':
				$this->load->model('catalog/category');
				$category = $this->model_catalog_category->getCategory($result['id']);
				if ($category) {
					$result['name'] = $category['name'];
					$result['href'] = $this->url('product/category', 'path=' . $result['id'], Request::isHttps());
				}
				break;

			case 'product':
				$this->load->model('catalog/product');
				$product = $this->model_catalog_product->getProduct($result['id']);
				if ($product) {
					$result['name'] = $product['name'];
					$result['href'] = $this->url('product/product', 'product_id=' . $result['id'], Request::isHttps());
				}
				break;

			case 'manufacturer':
				$this->load->model('catalog/manufacturer');
				$manufacturer = $this->model_catalog_manufacturer->getManufacturer($result['id']);
				if ($manufacturer) {
					$result['name'] = $manufacturer['name'];
					$result['href'] = $this->url('product/manufacturer/info', 'manufacturer_id=' . $result['id'], Request::isHttps());
				}
				break;

			case 'information':
				$this->load->model('catalog/information');
				$information = $this->model_catalog_information->getInformation($result['id']);
				if ($information) {
					$result['name'] = $information['title'];
					$result['href'] = $this->url('information/information', 'information_id=' . $result['id'], Request::isHttps());
				}
				break;

			case 'blog_home':
				$result['href'] = $this->url('journal3/blog', '', Request::isHttps());
				break;

			case 'blog_post':
				$result['href'] = $this->url('journal3/blog/post', 'journal_blog_post_id=' . $result['id'], Request::isHttps());
				break;

			case 'blog_category':
				$result['href'] = $this->url('journal3/blog', 'journal_blog_category_id=' . $result['id'], Request::isHttps());
				break;

			case 'popup':
				$result['href'] = 'javascript:open_popup(' . (int)$result['id'] . ')';
				unset($result['attrs']['target']);
				break;

			case 'login_popup':
				$result['href'] = 'javascript:open_login_popup()';
				unset($result['attrs']['target']);
				break;

			case 'register_popup':
				$result['href'] = 'javascript:open_register_popup()';
				unset($result['attrs']['target']);
				break;

			case 'scroll':
				$result['href'] = 'javascript:$(\'html, body\').animate({ scrollTop: ' . (int)Arr::get($link, 'scroll') . ' });';
				break;
		}

		return $result;
	}

	public function getInformation($information_id) {
		if (!$information_id) {
			return null;
		}

		$this->load->model('catalog/information');
		$this->load->language('account/register');

		$information_info = $this->model_catalog_information->getInformation($information_id);

		if (!$information_info) {
			return null;
		}

		return array(
			'text'  => sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $information_id, true), $information_info['title'], $information_info['title']),
			'error' => sprintf($this->language->get('error_agree'), $information_info['title']),
		);
	}
}
