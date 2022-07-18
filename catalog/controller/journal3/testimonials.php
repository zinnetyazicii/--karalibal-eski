<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3Testimonials extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/links');
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
		$default = $parser->getSetting('default');

		$data = array(
			'classes'         => array(
				'blocks-' . $parser->getSetting('display'),
				'carousel-mode' => $parser->getSetting('carousel'),
			),
			'carouselOptions' => $this->journal3->carousel($parser->getJs(), 'carouselStyle'),
		);

		$data['default_index'] = $parser->getSetting('display') === 'tabs' ? 1 : 0;

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
		$title = $parser->getSetting('title');

		switch ($parser->getSetting('contentType')) {
			case 'description':
			case 'attributes':
			case 'reviews':
				$content = '';
				break;

			default:
				$content = $parser->getSetting('content');
		}

		return array(
			'tab_classes'   => array(
				'tab-' . $this->item_id,
				'active' => ($this->settings['display'] === 'tabs') && ($index === $this->settings['default_index']),
			),
			'panel_classes' => array(
				'panel-collapse',
				'collapse',
				'in' => ($this->settings['display'] === 'accordion') && ($index === $this->settings['default_index']),
			),
			'classes'       => array(
				'tab-pane'     => $this->settings['display'] === 'tabs',
				'active'       => ($this->settings['display'] === 'tabs') && ($index === $this->settings['default_index']),
				'panel'        => $this->settings['display'] === 'accordion',
				'panel-active' => ($this->settings['display'] === 'accordion') && ($index === $this->settings['default_index']),
				'swiper-slide' => ($this->settings['display'] === 'grid') && $this->settings['carousel'],
			),
			'image'         => $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']),
			'title'         => $title,
			'content'       => $content,
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
