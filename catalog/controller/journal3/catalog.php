<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3Catalog extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('catalog/category');
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/product');
		$this->load->model('journal3/category');
		$this->load->model('journal3/product');
	}

	public function index($args) {
		$data = parent::index($args);

		if (!$data) {
			return null;
		}

		if ($this->settings['carousel']) {
			$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/swiper/swiper.min.css');
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/swiper/swiper.min.js', 'footer');
		}

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		$data = array(
			'classes'         => array(
				'carousel-mode'  => $parser->getSetting('carousel'),
				'image-on-hover' => $parser->getSetting('changeImageOnHover'),
			),
			'carouselOptions' => $this->journal3->carousel($parser->getJs(), 'carouselStyle'),
		);

		if ($this->journal3->settings->get('performanceLazyLoadImagesStatus')) {
			$data['dummy_image'] = $this->model_journal3_image->transparent($parser->getSetting('imageDimensions.width'), $parser->getSetting('imageDimensions.height'));
		}

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		$data = array(
			'classes' => array(
				'swiper-slide' => $this->settings['carousel'],
			),
			'items'   => array(),
			'image'   => '',
			'name'    => '',
			'href'    => '',
		);

		switch ($parser->getSetting('type')) {
			case 'category':
				$category_info = $this->model_catalog_category->getCategory($parser->getSetting('category'));

				if (!$category_info) {
					return null;
				}

				$category_path = (string)$parser->getSetting('category');

				if ($category_prefix = (string)Arr::get($this->module_args, 'category_prefix')) {
					$category_prefix_info = $this->model_catalog_category->getCategory($category_prefix);

					if ($category_prefix_info && ($category_path !== $category_prefix)) {
						$category_path = $category_prefix . '_' . $category_path;
					}
				}

				$data['href'] = $this->url->link('product/category', 'path=' . $category_path);
				$data['name'] = $category_info['name'];

				if ($this->settings['images']) {
					$data['image'] = $this->model_journal3_image->resize($category_info['image'], $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']);
					$data['image2x'] = $this->model_journal3_image->resize($category_info['image'], $this->settings['imageDimensions']['width'] * 2, $this->settings['imageDimensions']['height'] * 2, $this->settings['imageDimensions']['resize']);
				}

				switch ($parser->getSetting('subtype')) {
					case 'category':
						$data['total'] = $this->model_journal3_category->getTotalCategories($parser->getSetting('category'));

						$results = $this->model_journal3_category->getCategories($parser->getSetting('category'), $parser->getSetting('limit'));

						foreach ($results as $result) {
							$data['items'][] = array(
								'name'    => $result['name'],
								'href'    => $this->url->link('product/category', 'path=' . $category_path . '_' . $result['category_id']),
								'image'   => $this->settings['images'] ? $this->model_journal3_image->resize($result['image'], $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']) : '',
								'image2x' => $this->settings['images'] ? $this->model_journal3_image->resize($result['image'], $this->settings['imageDimensions']['width'] * 2, $this->settings['imageDimensions']['height'] * 2, $this->settings['imageDimensions']['resize']) : '',
							);
						}

						break;

					case 'product':
						$filter_data = array(
							'filter_category_id' => $parser->getSetting('category'),
							'limit'              => $parser->getSetting('limit'),
							'sort'               => 'p.sort_order',
						);

						$data['total'] = $this->model_journal3_product->getTotalProducts($filter_data);

						$results = $this->model_journal3_product->getProducts($filter_data);

						foreach ($results as $result) {
							$data['items'][] = array(
								'name'    => $result['name'],
								'href'    => $this->url->link('product/product', 'path=' . $category_path . '&product_id=' . $result['product_id']),
								'image'   => $this->settings['images'] ? $this->model_journal3_image->resize($result['image'], $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']) : '',
								'image2x' => $this->settings['images'] ? $this->model_journal3_image->resize($result['image'], $this->settings['imageDimensions']['width'] * 2, $this->settings['imageDimensions']['height'] * 2, $this->settings['imageDimensions']['resize']) : '',
							);
						}

						break;

					default:
						return null;
				}

				break;

			case 'manufacturer';
				$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($parser->getSetting('manufacturer'));

				if (!$manufacturer_info) {
					return null;
				}

				$data['href'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $parser->getSetting('manufacturer'));
				$data['name'] = $manufacturer_info['name'];

				if ($this->settings['images']) {
					$data['image'] = $this->model_journal3_image->resize($manufacturer_info['image'], $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']);
					$data['image2x'] = $this->model_journal3_image->resize($manufacturer_info['image'], $this->settings['imageDimensions']['width'] * 2, $this->settings['imageDimensions']['height'] * 2, $this->settings['imageDimensions']['resize']);
				}

				$filter_data = array(
					'filter_manufacturer_id' => $parser->getSetting('manufacturer'),
					'limit'                  => $parser->getSetting('limit'),
					'sort'                   => 'p.sort_order',
				);

				$data['total'] = $this->model_journal3_product->getTotalProducts($filter_data);

				$results = $this->model_journal3_product->getProducts($filter_data);

				foreach ($results as $result) {
					$data['items'][] = array(
						'name'    => $result['name'],
						'href'    => $this->url->link('product/product', 'manufacturer_id=' . $result['manufacturer_id'] . '&product_id=' . $result['product_id']),
						'image'   => $this->settings['images'] ? $this->model_journal3_image->resize($result['image'], $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']) : '',
						'image2x' => $this->settings['images'] ? $this->model_journal3_image->resize($result['image'], $this->settings['imageDimensions']['width'] * 2, $this->settings['imageDimensions']['height'] * 2, $this->settings['imageDimensions']['resize']) : '',
					);
				}

				break;

			default:
				return null;
		}

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		return array();
	}

}
