<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3Manufacturers extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->language('catalog/manufacturer');

		$this->load->model('catalog/manufacturer');
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
				'module-manufacturers-' . $parser->getSetting('display'),
				'carousel-mode' => $parser->getSetting('carousel'),
				'isotope'       => $parser->getSetting('sectionsDisplay') === 'isotope',
			),
			'image_width'     => $parser->getSetting('imageDimensions.width', $this->journal3->themeConfig('image_manufacturer_width')),
			'image_height'    => $parser->getSetting('imageDimensions.height', $this->journal3->themeConfig('image_manufacturer_height')),
			'image_resize'    => $parser->getSetting('imageDimensions.resize'),
			'carouselOptions' => $this->journal3->carousel($parser->getJs(), 'carouselStyle'),
		);

		if ($this->journal3->settings->get('performanceLazyLoadImagesStatus')) {
			$data['dummy_image'] = $this->model_journal3_image->transparent($parser->getSetting('imageDimensions.width', $this->journal3->themeConfig('image_manufacturer_width')), $parser->getSetting('imageDimensions.height', $this->journal3->themeConfig('image_manufacturer_height')));
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
		$manufacturers = array();
		$results = array();

		switch ($parser->getSetting('type')) {
			case 'top':
				$results = $this->model_catalog_manufacturer->getManufacturers(array(
					'start' => 0,
					'limit' => $parser->getSetting('limit'),
					'sort'  => 'sort_order',
				));

				break;

			case 'custom':
				$custom_manufacturers = $parser->getSetting('manufacturers', array());

				if ($custom_manufacturers) {
					foreach ($custom_manufacturers as $custom_manufacturer) {
						$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($custom_manufacturer);

						if ($manufacturer_info) {
							$results[] = $manufacturer_info;
						}
					}
				}

				break;
		}

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_journal3_image->resize($result['image'], $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
				$image2x = $this->model_journal3_image->resize($result['image'], $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
			} else {
				$image = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
				$image2x = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
			}

			$manufacturers[$result['manufacturer_id']] = array(
				'classes'         => array(
					'swiper-slide' => $this->settings['sectionsDisplay'] !== 'isotope' && $this->settings['carousel'],
					'isotope-item' => $this->settings['sectionsDisplay'] === 'isotope',
				),
				'manufacturer_id' => $result['manufacturer_id'],
				'thumb'           => $image,
				'thumb2x'         => $image2x,
				'name'            => $result['name'],
				'href'            => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id']),
			);

			if ($this->settings['sectionsDisplay'] === 'isotope') {
				if (!isset($this->settings['manufacturers'][$result['manufacturer_id']])) {
					$this->settings['manufacturers'][$result['manufacturer_id']] = $manufacturers[$result['manufacturer_id']];
				}

				$this->settings['manufacturers'][$result['manufacturer_id']]['classes'] = array_merge_recursive($this->settings['manufacturers'][$result['manufacturer_id']]['classes'], array($this->settings['id'] . '-section-' . $index));
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
			'manufacturers' => $manufacturers,
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
