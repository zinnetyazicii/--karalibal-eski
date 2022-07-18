<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;

class ControllerJournal3Gallery extends ModuleController {

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

		$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/lightgallery/css/lightgallery.min.css');
		$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/lightgallery/css/lg-transitions.min.css');
		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/lightgallery/js/lightgallery-all.js', 'footer');

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
			'images'          => array(),
			'options'         => array(
				'thumbWidth'      => $parser->getSetting('popupThumbDimensions.width'),
				'thumbContHeight' => $parser->getSetting('popupThumbDimensions.height'),
				'addClass'        => 'lg-' . $this->module_id,
				'mode'            => $parser->getSetting('moduleGalleryMode'),
				'download'        => $parser->getSetting('moduleGalleryDownload'),
				'fullScreen'      => $parser->getSetting('moduleGalleryFullScreen'),

			),
			'carouselOptions' => $this->journal3->carousel($parser->getJs(), 'carouselStyle'),
		);

		if ($this->journal3->settings->get('performanceLazyLoadImagesStatus')) {
			$data['dummy_image'] = $this->model_journal3_image->transparent($parser->getSetting('thumbDimensions.width'), $parser->getSetting('thumbDimensions.height'));
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
			'alt'     => $parser->getSetting('title'),
		);

		if ($parser->getSetting('type') == 'link') {
			$link = $parser->getSetting('link');
			$data['popup'] = $link['href'];
			$data['alt'] = $link['name'];
			$data['thumb'] = $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['thumbDimensions']['width'], $this->settings['thumbDimensions']['height'], $this->settings['thumbDimensions']['resize']);
		} else {
			if ($parser->getSetting('type') === 'image') {
				$data['popup'] = $this->model_journal3_image->resize($parser->getSetting('image'));
				$data['thumb'] = $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['thumbDimensions']['width'], $this->settings['thumbDimensions']['height'], $this->settings['thumbDimensions']['resize']);
				$data['thumb2x'] = $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['thumbDimensions']['width'] * 2, $this->settings['thumbDimensions']['height'] * 2, $this->settings['thumbDimensions']['resize']);
				$data['popupThumb'] = $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['popupThumbDimensions']['width'], $this->settings['popupThumbDimensions']['height'], $this->settings['popupThumbDimensions']['resize']);
				$data['html'] = null;
			} else {
				$data['popup'] = null;
				$data['thumb'] = $this->model_journal3_image->resize($parser->getSetting('videoImage'), $this->settings['thumbDimensions']['width'], $this->settings['thumbDimensions']['height'], $this->settings['thumbDimensions']['resize']);
				$data['popupThumb'] = $this->model_journal3_image->resize($parser->getSetting('videoImage'), $this->settings['popupThumbDimensions']['width'], $this->settings['popupThumbDimensions']['height'], $this->settings['popupThumbDimensions']['resize']);
				$data['html'] = null;

				switch ($parser->getSetting('videoType')) {
					case 'html5':
						$data['html'] = '<video class="lg-video-object lg-html5" controls preload="none"><source src="' . $parser->getSetting('videoHtml5Url') . '" type="video/mp4"></video>';
						break;

					case 'youtube':
						$data['popup'] = $parser->getSetting('videoYoutubeUrl');
						break;

					case 'vimeo':
						$data['popup'] = $parser->getSetting('videoVimeoUrl');
						break;
				}
			}

			$this->settings['images'][] = array(
				'src'     => $data['popup'],
				'thumb'   => $data['popupThumb'],
				'html'    => $data['html'],
				'subHtml' => $parser->getSetting('title'),
			);
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
