<?php

use Journal3\Opencart\ModuleController;
use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class ControllerJournal3Slider extends ModuleController {

	private static $DATA;
	private static $YOUTUBE_PARAMS;
	private static $VIMEO_PARAMS;

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/links');

		if (static::$DATA === null) {
			/** @todo */
			$scheme = parse_url($this->url->link(''), PHP_URL_SCHEME);
			$host = parse_url($this->url->link(''), PHP_URL_HOST);

			static::$DATA = json_decode(file_get_contents(DIR_SYSTEM . 'library/journal3/data/settings/module/slider/data.json'), true);
			static::$YOUTUBE_PARAMS = 'version=3&enablejsapi=1&html5=1&hd=1&wmode=opaque&showinfo=0&rel=0&origin=' . $scheme . '://' . $host;
			static::$VIMEO_PARAMS = 'background=1&title=0&byline=0&portrait=0&api=1';
		}
	}

	public function index($args) {
		$data = parent::index($args);

		if (!$data) {
			return null;
		}

		$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/revolution/css/settings.css');
		$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/revolution/css/layers.css');
		$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/revolution/css/navigation.css');

		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/revolution/js/jquery.themepunch.tools.min.js', 'footer');
		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/revolution/js/jquery.themepunch.revolution.min.js', 'footer');

		return $data;
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		list($width, $height) = $this->model_journal3_image->dimensions(Arr::get($this->module_data, 'items.0.image.lang_' . $this->journal3->getLanguageId()));

		if ($parser->getSetting('imageDimensions.width')) {
			$width = $parser->getSetting('imageDimensions.width');
		}

		if ($parser->getSetting('imageDimensions.height')) {
			$height = $parser->getSetting('imageDimensions.height');
		}

		$data = array(
			'autoHeight'  => 'off',
			'width'   => $width,
			'height'  => $height,
			'sliderLayout'=> 'standard',
			'options' => array(
//				'minHeight' => 500,
//				'sliderLayout' => 'fullscreen',
//				'delay'              => (int)$parser->getSetting('transitionDelay'),
//				'navigation'         => array(
//					'onHoverStop' => $parser->getSetting('pauseOnHover') ? 'on' : 'off',
//					'arrows'      => array(
//						'enable'        => $parser->getSetting('arrows'),
//						'rtl'           => $this->language->get('direction') === 'rtl',
//						'hide_onleave'  => false,
//						'hide_onmobile' => false,
//					),
//					'bullets'     => array(
//						'enable'        => $parser->getSetting('bullets'),
//						'rtl'           => $this->language->get('direction') === 'rtl',
//						'hide_onleave'  => false,
//						'hide_onmobile' => false,
//						'h_align'       => 'center',
//						'v_align'       => 'bottom',
//						'tmp'           => '',
//					),
//					'thumbnails'  => array(
//						'enable'        => $parser->getSetting('thumbnails'),
//						'rtl'           => $this->language->get('direction') === 'rtl',
//						'hide_onleave'  => false,
//						'hide_onmobile' => false,
//						'h_align'       => 'center',
//						'v_align'       => 'top',
//						'visibleAmount' => (int)$parser->getSetting('thumbnailsLimit'),
//						'width'         => (int)$parser->getSetting('thumbnailsDimensions.width'),
//						'height'        => (int)$parser->getSetting('thumbnailsDimensions.height'),
//					),
//					'touch'       => array(
//						'touchenabled' => $parser->getSetting('touch') ? 'on' : 'off',
//					),
//				),
//				'disableProgressBar' => !$parser->getSetting('timer') ? 'on' : 'off',
			),
		);

		if ($parser->getSetting('gridDimensions.first') && $parser->getSetting('gridDimensions.second')) {
			$data['options']['gridwidth'] = (int)$parser->getSetting('gridDimensions.first');
			$data['options']['gridheight'] = (int)$parser->getSetting('gridDimensions.second');
		} else {
			$data['options']['gridwidth'] = $width;
			$data['options']['gridheight'] = $height;
		}

		if (!$parser->getSetting('autoplay')) {
			$data['options']['stopLoop'] = "on";
			$data['options']['stopAfterLoops'] = 0;
			$data['options']['stopAtSlide'] = 1;
		}

		return $data;
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		$data = array();

		$link = $parser->getSetting('link');

		if ($link['href']) {
			$data['data'][] = 'data-link="' . $link['href'] . '"';
		}

		if ($parser->getSetting('transition')) {
			$data['data'][] = 'data-transition="' . Arr::get(static::$DATA, 'slide_transitions.' . $parser->getSetting('transition')) . '"';
		} else {
			$data['data'][] = 'data-transition="' . Arr::get(static::$DATA, 'slide_transitions.' . $this->settings['transition']) . '"';
		}

		if ($index === 1) {
			$data['data'][] = 'data-fstransition="notransition"';
		}

		if ($parser->getSetting('transitionDelay')) {
			$data['data'][] = 'data-delay="' . $parser->getSetting('transitionDelay') . '"';
		}

		if ($parser->getSetting('transitionSpeed')) {
			$data['data'][] = 'data-masterspeed="' . $parser->getSetting('transitionSpeed') . '"';
		} else if ($this->settings['transitionSpeed']) {
			$data['data'][] = 'data-masterspeed="' . $this->settings['transitionSpeed'] . '"';
		}

		if (Arr::get($this->settings, 'thumbnails')) {
			$data['data'][] = 'data-thumb="' . $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['thumbnailsDimensions']['width'], $this->settings['thumbnailsDimensions']['height'], $this->settings['thumbnailsDimensions']['resize']) . '"';
		}

		$width = Arr::get($this->settings, 'width');
		$height = Arr::get($this->settings, 'height');

		$data['image'] = $this->model_journal3_image->resize($parser->getSetting('image'), $width, $height, $this->settings['imageDimensions']['resize']);

		if ($parser->getSetting('type') === 'video') {
			$data['video_data'] = array(
				'data-forcerewind="on"',
				'data-volume="mute"',
				'data-videorate="1"',
				'data-videowidth="100%"',
				'data-videoheight="100%"',
				'data-videocontrols="none"',
				'data-videoloop="loop"',
				'data-forceCover="1"',
				'data-aspectratio="4:3"',
				'data-autoplay="true"',
				'data-autoplayonlyfirsttime="false"',
			);

			switch ($parser->getSetting('videoType')) {
				case 'html5':
					$data['video_data'][] = 'data-videomp4="' . $parser->getSetting('videoHtml5Url') . '"';
					break;

				case 'youtube':
					$data['video_data'][] = 'data-ytid="' . Str::YoutubeId($parser->getSetting('videoYoutubeUrl')) . '"';
					$data['video_data'][] = 'data-videoattributes="' . static::$YOUTUBE_PARAMS . '"';
					break;

				case 'vimeo':
					$data['video_data'][] = 'data-vimeoid="' . Str::VimeoId($parser->getSetting('videoVimeoUrl')) . '"';
					$data['video_data'][] = 'data-videoattributes="' . static::$VIMEO_PARAMS . '"';
					break;
			}
		}

		return $data;
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		$width = null;
		$height = null;
		$image = null;

		$data = array(
			'classes' => array(
				'tp-caption',
				//'tp-resizeme',
				'tp-videolayer' => $parser->getSetting('type') === 'video',
				'tp-caption-' . $parser->getSetting('type'),
				'btn'           => $parser->getSetting('type') === 'button',
			),
		);

		$transition = Arr::get(static::$DATA, 'layer_transitions.' . $parser->getSetting('transition'));

		$data['data'][] = 'data-frames=\'' . json_encode($transition) . '\'';

		$data['data'][] = 'data-whitespace="nowrap"';

		// position
		$data['data'][] = 'data-x="' . $parser->getSetting('positionX') . '"';
		$data['data'][] = 'data-y="' . $parser->getSetting('positionY') . '"';

		// offset
		if (($v = $parser->getSetting('offset.first')) !== '') {
			$data['data'][] = 'data-hoffset="' . $v . '"';
		}

		if (($v = $parser->getSetting('offset.second')) !== '') {
			$data['data'][] = 'data-voffset="' . $v . '"';
		}

		// size
		if (($v = $parser->getSetting('size.first')) !== '') {
			if ($parser->getSetting('type') !== 'video') {
				$data['data'][] = 'data-width="' . $v . '"';
			}
			$width = $v;
		}

		if (($v = $parser->getSetting('size.second')) !== '') {
			if ($parser->getSetting('type') !== 'video') {
				$data['data'][] = 'data-height="' . $v . '"';
			}
			$height = $v;
		}

		switch ($parser->getSetting('type')) {
			case 'hotspot':
				$data['data'][] = 'data-toggle="popover"';
				$data['data'][] = 'data-placement="' . $parser->getSetting('hotspotPosition') . '"';
				$data['data'][] = 'data-content="' . $parser->getSetting('text') . '"';
				break;

			case 'image':
				$image = $parser->getSetting('image');

				if (!is_file(DIR_IMAGE . $image)) {
					$image = 'placeholder.png';
				}

				$data['image'] = $this->model_journal3_image->resize($image, $width, $height);

				break;
			case 'video':
				$data['data'][] = 'data-forcerewind="on"';
				$data['data'][] = 'data-volume="mute"';
				$data['data'][] = 'data-videorate="1"';
				$data['data'][] = 'data-videocontrols="controls"';
				$data['data'][] = 'data-videoloop="loop"';
//				$data['data'][] = 'data-forceCover="1"';
//				$data['data'][] = 'data-aspectratio="4:3"';
				$data['data'][] = 'data-autoplay="true"';
				$data['data'][] = 'data-autoplayonlyfirsttime="false"';
				$data['data'][] = 'data-type="video"';


				switch ($parser->getSetting('videoType')) {
					case 'html5':
						$data['data'][] = 'data-videomp4="' . $parser->getSetting('videoHtml5Url') . '"';
						break;

					case 'youtube':
						$data['data'][] = 'data-ytid="' . Str::YoutubeId($parser->getSetting('videoYoutubeUrl')) . '"';
						$data['data'][] = 'data-videoattributes="' . static::$YOUTUBE_PARAMS . '"';
						break;

					case 'vimeo':
						$data['data'][] = 'data-vimeoid="' . Str::VimeoId($parser->getSetting('videoVimeoUrl')) . '"';
						$data['data'][] = 'data-videoattributes="' . static::$VIMEO_PARAMS . '"';
						break;
				}

				if ($parser->getSetting('videoType') === 'html5') {
					$data['data'][] = 'data-videowidth="' . ($width ? ($width . 'px') : '100%') . '"';
					$data['data'][] = 'data-videoheight="' . ($height ? ($height . 'px') : '100%') . '"';
				} else {
					$data['data'][] = 'data-videowidth="' . ($width ? ($width . 'px') : 'auto') . '"';
					$data['data'][] = 'data-videoheight="' . ($height ? ($height . 'px') : 'auto') . '"';
				}

				break;
		}

		return $data;
	}

}
