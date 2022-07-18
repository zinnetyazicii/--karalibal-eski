<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;
use Journal3\Options\Range;
use Journal3\Utils\Arr;
use Journal3\Utils\Profiler;

class ControllerJournal3Filter extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->language('product/category');

		$this->load->model('catalog/category');
		$this->load->model('catalog/manufacturer');
		$this->load->model('catalog/product');
		$this->load->model('journal3/filter');
	}

	public function index($args) {
		// check routes
		if (!in_array(Arr::get($this->request->get, 'route', ''), array(
			'product/catalog',
			'product/category',
			'product/manufacturer/info',
			'product/search',
			'product/special',
		))) {
			return null;
		}

		if ($this->request->get['route'] === 'product/search' && empty($this->request->get['search'])) {
			return null;
		}

		// check for products
		if (!$this->model_journal3_filter->getTotalProducts() && !$this->model_journal3_filter->hasFilterData('price')) {
			return null;
		}

		// module settings
		$this->module_id = (int)Arr::get($args, 'module_id');
		$this->module_type = Arr::get($args, 'module_type');
		$this->_cache_key = $this->module_type . '.' . $this->module_id;

		if ($this->_cache === false) {
			$this->module_data = $this->model_journal3_module->get($this->module_id, $this->module_type);

			if (!$this->module_data) {
				return null;
			}

			$parser = new Parser('module/' . $this->module_type . '/general', Arr::get($this->module_data, 'general'), null, array($this->module_id));

			$this->css = $parser->getCss();
			$this->fonts = $parser->getFonts();

			$this->settings = array_merge_recursive(
				$parser->getPhp(),
				array(
					'status'    => $parser->getSetting('status'),
					'id'        => uniqid($this->module_type . '-'),
					'module_id' => $this->module_id,
					'classes'   => array('module', 'module-' . $this->module_type, 'module-' . $this->module_type . '-' . $this->module_id),
				),
				$this->parseGeneralSettings($parser, $this->module_id)
			);

			if (Arr::get($this->settings, 'items') === null) {
				$this->settings['items'] = array();

				$items = Arr::get($this->module_data, 'items', array());

				foreach ($items as $item_id => $item) {
					$parser = new Parser('module/' . $this->module_type . '/item', $item, null, array($this->module_id, $item_id));

					if ($parser->getSetting('status') === false) {
						continue;
					}

					$item_settings = $this->parseItemSettings($parser, $item_id);

					if ($item_settings === null) {
						continue;
					}

					$this->css .= $parser->getCss();
					$fonts = $parser->getFonts();
					$this->fonts = Arr::merge($this->fonts, $fonts);

					$this->settings['items'][$item_id] = array_merge_recursive(
						$parser->getPhp(),
						array(
							'id'      => $this->module_id . '-' . $item_id,
							'classes' => array('module-item', 'module-item-' . $item_id),
						),
						$item_settings
					);
				}
			}

			$this->_cache = array(
				'css'      => $this->css,
				'fonts'    => $this->fonts,
				'settings' => $this->settings,
			);
		} else {
			$this->css = $this->_cache['css'];
			$this->fonts = $this->_cache['fonts'];
			$this->settings = $this->_cache['settings'];
		}

		if ($this->settings['status'] === false) {
			return null;
		}

		if (!Range::inRange(Arr::get($this->settings, 'schedule'))) {
			return null;
		}

		$this->beforeRender();

		if ($this->settings === null) {
			return null;
		}

		$output = $this->renderView('journal3/module/' . $this->module_type, $this->settings);

		if (!$output) {
			return null;
		}

		$this->afterRender();

		if ($this->css) {
			$this->journal3->document->addCss($this->css, "{$this->module_type}-{$this->module_id}");
		}

		if ($this->fonts) {
			$this->journal3->document->addFonts($this->fonts);
		}

		return $output;
	}

	/**
	 * @param Parser $parser
	 * @param $module_id
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $module_id) {
		$data = array();

		$data['image_width'] = $parser->getSetting('imageDimensions.width');
		$data['image_height'] = $parser->getSetting('imageDimensions.height');
		$data['image_resize'] = $parser->getSetting('imageDimensions.resize');

		$data['currency_left'] = $this->currency->getSymbolLeft($this->session->data['currency']);
		$data['currency_right'] = $this->currency->getSymbolRight($this->session->data['currency']);

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		$data = array(
			'type'          => $index[0],
			'key'           => $index[0],
			'classes'       => array(
				'text-only'  => $parser->getSetting('input') !== 'select' && $parser->getSetting('display') === 'text',
				'image-only' => $parser->getSetting('input') !== 'select' && $parser->getSetting('display') === 'image',
				'panel',
			),
			'panel_classes' => array(
				'panel-collapse',
				'collapse',
			),
			'image_only'    => $parser->getSetting('display') === 'image',
			'collapsed'     => $parser->getSetting('collapsed') === null ? $this->settings['collapsed'] : $parser->getSetting('collapsed'),
		);

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

	protected function beforeRender() {
		$items = array();

		// price
		if ($item = Arr::get($this->settings['items'], 'p')) {
			Profiler::start('journal3/filter/price');

			$price_range = $this->model_journal3_filter->getPriceRange();

			Profiler::end('journal3/filter/price');

			if ($price_range['min'] !== $price_range['max']) {
				$item['price_range'] = $price_range;

				$item['current_price_range']['min'] = Arr::get($this->model_journal3_filter->getFilterData(), 'price.min', $price_range['min']);
				$item['current_price_range']['max'] = Arr::get($this->model_journal3_filter->getFilterData(), 'price.max', $price_range['max']);

				if (!$item['collapsed'] || $item['current_price_range']['min'] !== $price_range['min'] || $item['current_price_range']['max'] !== $price_range['max']) {
					$item['collapsed'] = false;
					$item['classes'][] = 'panel-active';
					$item['panel_classes'][] = 'in';
				}

				$items[] = $item;
			}
		}

		// categories
		if ($item = Arr::get($this->settings['items'], 'c')) {
			Profiler::start('journal3/filter/categories');

			$categories = $this->model_journal3_filter->getCategories();

			Profiler::end('journal3/filter/categories');

			if ($categories) {
				foreach ($categories as &$category) {
					$category['checked'] = $this->model_journal3_filter->hasFilterData('categories', $category['id']);

					if ($item['display'] === 'text') {
						$category['image'] = false;
						$category['image2x'] = false;
					} else {
						$image = $category['image'];

						if ($image) {
							$category['image'] = $this->model_journal3_image->resize($image, $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
							$category['image2x'] = $this->model_journal3_image->resize($image, $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
						} else {
							$category['image'] = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
							$category['image2x'] = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
						}
					}
				}

				$item['items'] = $categories;

				if (!$item['collapsed'] || isset($this->request->get['fc'])) {
					$item['collapsed'] = false;
					$item['classes'][] = 'panel-active';
					$item['panel_classes'][] = 'in';
				}

				$items[] = $item;
			}
		}

		// manufacturers
		if ($item = Arr::get($this->settings['items'], 'm')) {
			Profiler::start('journal3/filter/manufacturers');

			$manufacturers = $this->model_journal3_filter->getManufacturers();

			Profiler::end('journal3/filter/manufacturers');

			if ($manufacturers) {
				foreach ($manufacturers as &$manufacturer) {
					$manufacturer['checked'] = $this->model_journal3_filter->hasFilterData('manufacturers', $manufacturer['id']);

					if ($item['display'] === 'text') {
						$manufacturer['image'] = false;
						$manufacturer['image2x'] = false;
					} else {
						$image = $manufacturer['image'];

						if ($image) {
							$manufacturer['image'] = $this->model_journal3_image->resize($image, $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
							$manufacturer['image2x'] = $this->model_journal3_image->resize($image, $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
						} else {
							$manufacturer['image'] = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
							$manufacturer['image2x'] = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
						}
					}
				}

				$item['items'] = $manufacturers;

				if (!$item['collapsed'] || isset($this->request->get['fm'])) {
					$item['collapsed'] = false;
					$item['classes'][] = 'panel-active';
					$item['panel_classes'][] = 'in';
				}

				$items[] = $item;
			}
		}

		// attributes
		if (Arr::hasKeyStartingWith($this->settings['items'], 'a') && Arr::get($this->settings, 'attributes')) {
			Profiler::start('journal3/filter/attributes');

			$all_attributes = $this->model_journal3_filter->getAttributes();

			Profiler::end('journal3/filter/attributes');

			foreach ($all_attributes as $attributes) {
				$item = Arr::get($this->settings['items'], 'a' . $attributes['attribute_id']);

				if ($item) {
					foreach ($attributes['values'] as &$attribute) {
						$attribute['checked'] = $this->model_journal3_filter->hasFilterData('attributes.' . $attributes['attribute_id'], $attribute['id']);
						$attribute['id'] = rawurlencode(htmlspecialchars_decode($attribute['id']));
					}

					usort($attributes['values'], function ($a, $b) {
						return strnatcmp($a['value'], $b['value']);
					});

					$item['key'] .= $attributes['attribute_id'];
					$item['items'] = $attributes['values'];

					if (!$item['collapsed'] || isset($this->request->get['fa' . $attributes['attribute_id']])) {
						$item['collapsed'] = false;
						$item['classes'][] = 'panel-active';
						$item['panel_classes'][] = 'in';
					}

					$items[] = $item;
				}
			}
		}

		// options
		if (Arr::hasKeyStartingWith($this->settings['items'], 'o') && Arr::get($this->settings, 'options')) {
			Profiler::start('journal3/filter/options');

			$all_options = $this->model_journal3_filter->getOptions();

			Profiler::end('journal3/filter/options');

			foreach ($all_options as $options) {
				$item = Arr::get($this->settings['items'], 'o' . $options['option_id']);

				if ($item) {
					foreach ($options['values'] as &$option) {
						$option['checked'] = $this->model_journal3_filter->hasFilterData('options.' . $options['option_id'], $option['id']);

						if ($item['display'] === 'text') {
							$option['image'] = false;
							$option['image2x'] = false;
						} else {
							$image = $option['image'];

							if ($image) {
								$option['image'] = $this->model_journal3_image->resize($image, $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
								$option['image2x'] = $this->model_journal3_image->resize($image, $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
							} else {
								$option['image'] = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
								$option['image2x'] = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
							}
						}
					}

					$item['key'] .= $options['option_id'];
					$item['items'] = $options['values'];

					if (!$item['collapsed'] || isset($this->request->get['fo' . $options['option_id']])) {
						$item['collapsed'] = false;
						$item['classes'][] = 'panel-active';
						$item['panel_classes'][] = 'in';
					}

					$items[] = $item;
				}
			}
		}

		// filters
		if (Arr::hasKeyStartingWith($this->settings['items'], 'f') && Arr::get($this->settings, 'filters')) {
			Profiler::start('journal3/filter/filters');

			$all_filters = $this->model_journal3_filter->getFilters(array(
				'filtersCategoryCheck' => Arr::get($this->settings, 'filtersCategoryCheck')
			));

			Profiler::end('journal3/filter/filters');

			foreach ($all_filters as $filters) {
				$item = Arr::get($this->settings['items'], 'f' . $filters['filter_group_id']);

				if ($item) {
					foreach ($filters['values'] as &$filter) {
						$filter['checked'] = $this->model_journal3_filter->hasFilterData('filters.' . $filters['filter_group_id'], $filter['id']);
					}

					$item['key'] .= $filters['filter_group_id'];
					$item['items'] = $filters['values'];

					if (!$item['collapsed'] || isset($this->request->get['ff' . $filters['filter_group_id']])) {
						$item['collapsed'] = false;
						$item['classes'][] = 'panel-active';
						$item['panel_classes'][] = 'in';
					}

					$items[] = $item;
				}
			}
		}

		// tags
		if ($item = Arr::get($this->settings['items'], 't')) {
			Profiler::start('journal3/filter/tags');

			$tags = $this->model_journal3_filter->getTags();

			Profiler::end('journal3/filter/tags');

			if ($tags) {
				foreach ($tags as &$tag) {
					$tag['checked'] = $this->model_journal3_filter->hasFilterData('tags', $tag['id']);
					$tag['id'] = rawurlencode(htmlspecialchars_decode($tag['id']));
				}

				usort($tags, function ($a, $b) {
					return strnatcmp($a['value'], $b['value']);
				});

				$item['items'] = $tags;

				if (!$item['collapsed'] || isset($this->request->get['ft'])) {
					$item['collapsed'] = false;
					$item['classes'][] = 'panel-active';
					$item['panel_classes'][] = 'in';
				}

				$items[] = $item;
			}
		}

		// stock
		if (!$this->journal3->settings->get('filterCheckQuantity')) {
			$item = Arr::get($this->settings['items'], 'q');

			if ($item) {
				Profiler::start('journal3/filter/availability');

				$availability = $this->model_journal3_filter->getAvailability();

				Profiler::end('journal3/filter/availability');


				if ($availability['instock'] || $availability['outofstock']) {
					if ($availability['instock']) {
						$item['items'][] = array(
							'id'      => '1',
							'value'   => $item['inStockText'],
							'total'   => $availability['instock'],
							'checked' => $this->model_journal3_filter->hasFilterData('availability', '1'),
						);
					}

					if ($availability['outofstock']) {
						$item['items'][] = array(
							'id'      => '0',
							'value'   => $item['outOfStockText'],
							'total'   => $availability['outofstock'],
							'checked' => $this->model_journal3_filter->hasFilterData('availability', '0'),
						);
					}

					if (!$item['collapsed'] || isset($this->request->get['fq'])) {
						$item['collapsed'] = false;
						$item['classes'][] = 'panel-active';
						$item['panel_classes'][] = 'in';
					}

					$items[] = $item;
				}
			}
		}

		$this->settings['items'] = $items;
	}

	protected function afterRender() {
		$this->journal3->document->addJs(array(
			'currency_left'          => $this->settings['currency_left'],
			'currency_right'         => $this->settings['currency_right'],
			'currency_decimal'       => $this->language->get('decimal_point'),
			'currency_thousand'      => $this->language->get('thousand_point'),
			'mobileFilterButtonText' => $this->settings['mobileText'],
			'filterBase'             => htmlspecialchars_decode($this->model_journal3_filter->filterBase()),
		));

		$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/ion-rangeSlider/ion.rangeSlider.css');

		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/ion-rangeSlider/ion.rangeSlider.min.js', 'footer');
		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/accounting/accounting.min.js', 'footer');
		$this->journal3->document->addScript('catalog/view/theme/journal3/js/filter.js', 'footer');
	}

}
