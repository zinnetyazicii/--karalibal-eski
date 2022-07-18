<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;

class ControllerJournal3Banners extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);
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
				'carousel-mode' => $parser->getSetting('carousel'),
			),
			'carouselOptions' => $this->journal3->carousel($parser->getJs(), 'carouselStyle'),
		);

		if ($this->journal3->settings->get('performanceLazyLoadImagesStatus') && $parser->getSetting('lazyLoad')) {
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
			'image'   => $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['imageDimensions']['width'], $this->settings['imageDimensions']['height'], $this->settings['imageDimensions']['resize']),
			'image2x' => $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['imageDimensions']['width'] * 2, $this->settings['imageDimensions']['height'] * 2, $this->settings['imageDimensions']['resize']),
			'text'    => $parser->getSetting('text'),
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

}
