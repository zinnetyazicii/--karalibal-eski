<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3Categories extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->language('category/category');

		$this->load->model('journal3/filter');
		$this->load->model('journal3/category');
		$this->load->model('catalog/category');
	}

	public function index($args) {
		$data = parent::index($args);

		if (!$data) {
			return null;
		}

		if ($this->settings['sectionsDisplay'] === 'isotope') {
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/isotope/isotope.pkgd.min.js', 'footer');
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
		$default = $parser->getSetting('default');

		$data = array(
			'classes'         => array(
				'module-categories-' . $parser->getSetting('display'),
				'carousel-mode' => $parser->getSetting('carousel'),
				'isotope'       => $parser->getSetting('sectionsDisplay') === 'isotope',
			),
			'image_width'     => $parser->getSetting('imageDimensions.width', $this->journal3->themeConfig('image_category_width')),
			'image_height'    => $parser->getSetting('imageDimensions.height', $this->journal3->themeConfig('image_category_height')),
			'image_resize'    => $parser->getSetting('imageDimensions.resize'),
			'carouselOptions' => $this->journal3->carousel($parser->getJs(), 'carouselStyle'),
		);

		if ($this->journal3->settings->get('performanceLazyLoadImagesStatus')) {
			$data['dummy_image'] = $this->model_journal3_image->transparent($parser->getSetting('imageDimensions.width', $this->journal3->themeConfig('image_category_width')), $parser->getSetting('imageDimensions.height', $this->journal3->themeConfig('image_category_height')));
		}

		$data['default_index'] = $parser->getSetting('sectionsDisplay') === 'isotope' ? 0 : 1;

		if ($default) {
			foreach (Arr::get($this->module_data, 'items') as $index => $item) {
				if ($default === Arr::get($item, 'id')) {
					$data['default_index'] = $index + 1;
					break;
				}
			}
		}

		return $data;
	}

	/**
	 * @param Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		$categories = array();
		$results = array();
		$limit = $parser->getSetting('limit');

		switch ($parser->getSetting('type')) {
			case 'top':
				$results = $this->model_catalog_category->getCategories(0);

				if ($limit) {
					$results = array_slice($results, 0, $limit);
				}

				break;

			case 'sub':
				$results = $this->model_catalog_category->getCategories($parser->getSetting('category'));

				if ($limit) {
					$results = array_slice($results, 0, $limit);
				}

				break;

			case 'custom':
				$custom_categories = $parser->getSetting('categories', array());

				if ($custom_categories) {
					foreach ($custom_categories as $custom_category) {
						$category_info = $this->model_catalog_category->getCategory($custom_category);

						if ($category_info) {
							$results[] = $category_info;
						}
					}
				}

				break;
		}

		foreach ($results as $result) {
			if ($this->settings['images']) {
				if ($result['image']) {
					$image = $this->model_journal3_image->resize($result['image'], $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
					$image2x = $this->model_journal3_image->resize($result['image'], $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
				} else {
					$image = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
					$image2x = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
				}
			} else {
				$image = $image2x = null;
			}

			$categories[$result['category_id']] = array(
				'classes'     => array(
					'swiper-slide' => $this->settings['sectionsDisplay'] !== 'isotope' && $this->settings['carousel'],
					'isotope-item' => $this->settings['sectionsDisplay'] === 'isotope',
				),
				'category_id' => $result['category_id'],
				'thumb'       => $image,
				'thumb2x'     => $image2x,
				'name'        => $result['name'],
				'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, (int)$this->settings['descLimit']) . '..',
				'href'        => $this->url->link('product/category', 'path=' . $result['category_id']),
			);

			if ($this->settings['sectionsDisplay'] === 'isotope') {
				if (!isset($this->settings['categories'][$result['category_id']])) {
					$this->settings['categories'][$result['category_id']] = $categories[$result['category_id']];
				}

				$this->settings['categories'][$result['category_id']]['classes'] = array_merge_recursive($this->settings['categories'][$result['category_id']]['classes'], array($this->settings['id'] . '-section-' . $index));
			}
		}

		return array(
			'tab_classes'   => array(
				'tab-' . $this->item_id,
				'active' => (($this->settings['sectionsDisplay'] === 'tabs') || ($this->settings['sectionsDisplay'] === 'isotope')) && ($index === $this->settings['default_index']),
			),
			'panel_classes' => array(
				'panel-collapse',
				'collapse',
				'in' => ($this->settings['sectionsDisplay'] === 'accordion') && ($index === $this->settings['default_index']),
			),
			'classes'       => array(
				'tab-pane'     => $this->settings['sectionsDisplay'] === 'tabs',
				'active'       => (($this->settings['sectionsDisplay'] === 'tabs') || ($this->settings['sectionsDisplay'] === 'isotope')) && ($index === $this->settings['default_index']),
				'panel'        => $this->settings['sectionsDisplay'] === 'accordion',
				'panel-active' => ($this->settings['sectionsDisplay'] === 'accordion') && ($index === $this->settings['default_index']),
				'swiper-slide' => ($this->settings['sectionsDisplay'] === 'blocks') && $this->settings['carousel'],
			),
			'categories'    => $categories,
		);
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
