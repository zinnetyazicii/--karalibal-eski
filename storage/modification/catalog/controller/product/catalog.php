<?php

class ControllerProductCatalog extends Controller {
	public function index() {
		$this->load->language('product/manufacturer');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			
            if (defined('JOURNAL3_ACTIVE')) {
                $sort = $this->journal3->settings->get('productSort');
            } else {
                $sort = 'p.sort_order';
            }
            
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			
            if (defined('JOURNAL3_ACTIVE')) {
                $order = $this->journal3->settings->get('productOrder');
            } else {
                $order = 'ASC';
            }
            
		}

		if (isset($this->request->get['page'])) {
			$page = max(1, (int)$this->request->get['page']); // Journal 3 fix
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = (int)$this->request->get['limit'];
		} else {
			$limit = $this->journal3->themeConfig('product_limit');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home'),
		);

		$this->document->setTitle($this->journal3->settings->get('allProductsPageMetaTitle'));
		$this->document->setDescription($this->journal3->settings->get('allProductsPageMetaDescription'));
		$this->document->setKeywords($this->journal3->settings->get('allProductsPageMetaKeywords'));

		$data['heading_title'] = $this->journal3->settings->get('allProductsPageTitle');

		if (defined('JOURNAL3_ACTIVE')) {
                $data['text_compare'] = $this->journal3->countBadge($this->language->get('text_compare'), isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0);
            } else {
                $data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
            }

		// Set the last category breadcrumb
		$data['breadcrumbs'][] = array(
			'text' => $this->journal3->settings->get('allProductsPageTitle'),
			'href' => $this->url->link('product/catalog'),
		);


		$data['compare'] = $this->url->link('product/compare');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$data['thumb'] = null;
		$data['description'] = null;
		$data['categories'] = array();
		$data['button_grid'] = null;
		$data['button_list'] = null;
		$data['text_sort'] = $this->language->get('text_sort');
		$data['text_limit'] = $this->language->get('text_limit');
		$data['text_tax'] = $this->language->get('text_tax');
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['text_empty'] = $this->language->get('text_empty');
		$data['button_continue'] = $this->language->get('button_continue');

		$data['products'] = array();

		$filter_data = array(
			'filter_category_id' => 0,
			'sort'               => $sort,
			'order'              => $order,
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit,
		);

		
            if (defined('JOURNAL3_ACTIVE')) {
                $this->load->model('journal3/filter');

                $filter_data = array_merge($this->model_journal3_filter->parseFilterData(), $filter_data);

                $this->model_journal3_filter->setFilterData($filter_data);

                \Journal3\Utils\Profiler::start('journal3/filter/total_products');

                $product_total = $this->model_journal3_filter->getTotalProducts();

                \Journal3\Utils\Profiler::end('journal3/filter/total_products');
            } else {
                $product_total = $this->model_catalog_product->getTotalProducts($filter_data);
            }
            

		
            if (defined('JOURNAL3_ACTIVE')) {
                \Journal3\Utils\Profiler::start('journal3/filter/products');

                $results = $this->model_journal3_filter->getProducts($filter_data);

                \Journal3\Utils\Profiler::end('journal3/filter/products');
            } else {
                $results = $this->model_catalog_product->getProducts($filter_data);
            }
            

            if (defined('JOURNAL3_ACTIVE')) {
                $this->load->model('journal3/product');

                $data['image_width'] = $this->journal3->settings->get('image_dimensions_product.width');
                $data['image_height'] = $this->journal3->settings->get('image_dimensions_product.height');

                if ($this->journal3->settings->get('performanceLazyLoadImagesStatus')) {
			        $data['dummy_image'] = $this->model_journal3_image->transparent($data['image_width'], $data['image_width']);
                }
            }
            

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_journal3_image->resize($result['image'], $this->journal3->themeConfig('image_product_width'), $this->journal3->themeConfig('image_product_height'), $this->journal3->themeConfig('image_product_resize'));
			} else {
				$image = $this->model_journal3_image->resize('placeholder.png', $this->journal3->themeConfig('image_product_width'), $this->journal3->themeConfig('image_product_height'), $this->journal3->themeConfig('image_product_resize'));
			}

			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			} else {
				$price = false;
			}

			if ((float)$result['special']) {
				$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			} else {
				$special = false;
			}

			if ($this->config->get('config_tax')) {
				$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
			} else {
				$tax = false;
			}

			if ($this->config->get('config_review_status')) {
				$rating = (int)$result['rating'];
			} else {
				$rating = false;
			}


            if (defined('JOURNAL3_ACTIVE')) {
                if ($result['image']) {
                    $image2x = $this->model_journal3_image->resize($result['image'], $this->journal3->settings->get('image_dimensions_product.width') * 2, $this->journal3->settings->get('image_dimensions_product.height') * 2, $this->journal3->settings->get('image_dimensions_product.resize'));
                } else {
                    $image2x = $this->model_journal3_image->resize('placeholder.png', $this->journal3->settings->get('image_dimensions_product.width') * 2, $this->journal3->settings->get('image_dimensions_product.height') * 2, $this->journal3->settings->get('image_dimensions_product.resize'));
                }

                if ($this->journal3->document->isDesktop() && $this->journal3->settings->get('globalProductGridSecondImageStatus') && ($additional_image = $this->journal3->productSecondImage($result))) {
                    $second_image = $this->model_journal3_image->resize($additional_image, $this->journal3->settings->get('image_dimensions_product.width'), $this->journal3->settings->get('image_dimensions_product.height'), $this->journal3->settings->get('image_dimensions_product.resize'));
                    $second_image2x = $this->model_journal3_image->resize($additional_image, $this->journal3->settings->get('image_dimensions_product.width') * 2, $this->journal3->settings->get('image_dimensions_product.height') * 2, $this->journal3->settings->get('image_dimensions_product.resize'));
                } else {
                    $second_image = false;
                    $second_image2x = false;
                }
            }
            
			$data['products'][] = array(

                'classes'        => array(
					defined('JOURNAL3_ACTIVE') ? $this->journal3->productExcludeButton($result, $price, $special) : null,
				),
                'quantity'       => defined('JOURNAL3_ACTIVE') ? $result['quantity'] : null,
				'stock_status'   => defined('JOURNAL3_ACTIVE') ? $result['stock_status'] : null,
				'thumb2x'        => defined('JOURNAL3_ACTIVE') ? $image2x : null,
				'second_thumb'   => defined('JOURNAL3_ACTIVE') ? $second_image : null,
				'second_thumb2x' => defined('JOURNAL3_ACTIVE') ? $second_image2x : null,
				'labels'         => defined('JOURNAL3_ACTIVE') ? $this->journal3->productLabels($result, $price, $special) : null,
				'extra_buttons'  => defined('JOURNAL3_ACTIVE') ? $this->journal3->productExtraButton($result, $price, $special) : null,
				'date_end'       => defined('JOURNAL3_ACTIVE') ? $this->journal3->productCountdown($result) : null,
				'price_value'    => defined('JOURNAL3_ACTIVE') ? ($result['special'] ? $result['special'] > 0 : $result['price'] > 0) : null,
				'stat1'          => defined('JOURNAL3_ACTIVE') ? $this->journal3->productStat($result, $this->journal3->settings->get('globalProductStat1')) : null,
				'stat2'          => defined('JOURNAL3_ACTIVE') ? $this->journal3->productStat($result, $this->journal3->settings->get('globalProductStat2')) : null,
            
				'product_id'  => $result['product_id'],
				'thumb'       => $image,
				'name'        => $result['name'],
				'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, (int)$this->journal3->themeConfig('product_description_length')) . '..',
				'price'       => $price,
				'special'     => $special,
				'tax'         => $tax,
				'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
				'rating'      => $result['rating'],
				'href'        => $this->url->link('product/product', '&product_id=' . $result['product_id'] . $url),
			);
		}

		$url = '';

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}


            if (defined('JOURNAL3_ACTIVE')) {
                $url .= $this->model_journal3_filter->buildFilterData($filter_data);
            }
            
		$data['sorts'] = array();

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_default'),
			'value' => 'p.sort_order-ASC',
			'href'  => $this->url->link('product/catalog', '&sort=p.sort_order&order=ASC' . $url),
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_asc'),
			'value' => 'pd.name-ASC',
			'href'  => $this->url->link('product/catalog', '&sort=pd.name&order=ASC' . $url),
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_name_desc'),
			'value' => 'pd.name-DESC',
			'href'  => $this->url->link('product/catalog', '&sort=pd.name&order=DESC' . $url),
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_price_asc'),
			'value' => 'p.price-ASC',
			'href'  => $this->url->link('product/catalog', '&sort=p.price&order=ASC' . $url),
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_price_desc'),
			'value' => 'p.price-DESC',
			'href'  => $this->url->link('product/catalog', '&sort=p.price&order=DESC' . $url),
		);

		if ($this->config->get('config_review_status')) {
			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC',
				'href'  => $this->url->link('product/catalog', '&sort=rating&order=DESC' . $url),
			);

			$data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
				'href'  => $this->url->link('product/catalog', '&sort=rating&order=ASC' . $url),
			);
		}

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_model_asc'),
			'value' => 'p.model-ASC',
			'href'  => $this->url->link('product/catalog', '&sort=p.model&order=ASC' . $url),
		);

		$data['sorts'][] = array(
			'text'  => $this->language->get('text_model_desc'),
			'value' => 'p.model-DESC',
			'href'  => $this->url->link('product/catalog', '&sort=p.model&order=DESC' . $url),
		);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['limits'] = array();

		$limits = array_unique(array($this->journal3->themeConfig('product_limit'), 25, 50, 75, 100));

		sort($limits);

            if (defined('JOURNAL3_ACTIVE')) {
                $url .= $this->model_journal3_filter->buildFilterData($filter_data);
            }
            

		foreach ($limits as $value) {
			$data['limits'][] = array(
				'text'  => $value,
				'value' => $value,
				'href'  => $this->url->link('product/catalog', $url . '&limit=' . $value),
			);
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}


            if (defined('JOURNAL3_ACTIVE')) {
                $url .= $this->model_journal3_filter->buildFilterData($filter_data);
            }
            
		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('product/catalog', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

		// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
		if ($page == 1) {
			$this->document->addLink($this->url->link('product/catalog'), 'canonical');
		} else {
			$this->document->addLink($this->url->link('product/catalog', '&page=' . $page), 'canonical');
		}

		if ($page > 1) {
			$this->document->addLink($this->url->link('product/catalog', (($page - 2) ? '&page=' . ($page - 1) : '')), 'prev');
		}

		if ($limit && ceil($product_total / $limit) > $page) {
			$this->document->addLink($this->url->link('product/catalog', '&page=' . ($page + 1)), 'next');
		}

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['limit'] = $limit;

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('product/category', $data));
	}
}
