<?php

use Journal3\Opencart\ModuleController;
use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class ControllerJournal3LayerSlider extends ModuleController {

	static $DATA;

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/links');

		if (static::$DATA === null) {
			$data = json_decode(file_get_contents(DIR_SYSTEM . 'library/journal3/data/settings/module/layer_slider/data.json'), true);

			foreach ($data['slide_transitions'] as $transition) {
				static::$DATA[$transition['type']][] = $transition['id'];
			}

			static::$DATA['2d'] = implode(',', static::$DATA['2d']);
			static::$DATA['3d'] = implode(',', static::$DATA['3d']);
		}
	}

	public function index($args) {
		$data = parent::index($args);

		if (!$data) {
			return null;
		}

		$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/layerslider/css/layerslider.css');

		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/layerslider/js/greensock.js', 'footer');
		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/layerslider/js/layerslider.transitions.js', 'footer');
		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/layerslider/js/layerslider.kreaturamedia.jquery.js', 'footer');

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
			'width'   => $width,
			'height'  => $height,
			'options' => $parser->getJs(),
		);

		if ($parser->getSetting('sliderDimensions.first')) {
			$data['options']['width'] = (int)$parser->getSetting('sliderDimensions.first');
		}

		if ($parser->getSetting('sliderDimensions.second')) {
			$data['options']['height'] = (int)$parser->getSetting('sliderDimensions.second');
		}

		if ($parser->getSetting('thumbnailNavigation') !== 'disabled') {
			$data['options']['tnWidth'] = $parser->getSetting('thumbnailDimensions.width');
			$data['options']['tnHeight'] = $parser->getSetting('thumbnailDimensions.height');
		}

		if (!$data['options']['autoStart']) {
			$data['options']['showBarTimer'] = false;
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

		if ($parser->getSetting('transition')) {
			$transition = $parser->getSetting('transition');
		} else if ($this->settings['transition']) {
			$transition = $this->settings['transition'];
		} else {
			$transition = null;
		}

		if ($transition) {
			if ($transition === 'random') {
				$data['data'][] = 'transition2d: ' . static::$DATA['2d'];
				$data['data'][] = 'transition3d: ' . static::$DATA['3d'];
			} else if ($transition === 'random_2d') {
				$data['data'][] = 'transition2d: ' . static::$DATA['2d'];
			} else if ($transition === 'random_3d') {
				$data['data'][] = 'transition3d: ' . static::$DATA['3d'];
			} else {
				list ($type, $id) = explode('_', $transition);

				$data['data'][] = 'transition' . $type . ': ' . $id;
			}
		}

		if ($parser->getSetting('transitionDelay')) {
			$transitionDelay = $parser->getSetting('transitionDelay');
		} else {
			$transitionDelay = $this->settings['transitionDelay'];
		}

		$data['data'][] = 'duration: ' . $transitionDelay;

		if ($parser->getSetting('transitionSpeed')) {
			$transitionSpeed = $parser->getSetting('transitionSpeed');
		} else {
			$transitionSpeed = $this->settings['transitionSpeed'];
		}

		$data['data'][] = 'transitionduration: ' . $transitionSpeed;

		$width = Arr::get($this->settings, 'width');
		$height = Arr::get($this->settings, 'height');

		if (is_file(DIR_IMAGE . $parser->getSetting('image'))) {
			$data['image'] = $this->model_journal3_image->resize($parser->getSetting('image'), $width, $height, $this->settings['imageDimensions']['resize']);

			if (Arr::get($this->settings, 'thumbnailNavigation') !== 'disabled') {
				$data['thumb'] = $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['thumbnailDimensions']['width'], $this->settings['thumbnailDimensions']['height'], $this->settings['thumbnailDimensions']['resize']);
			}
		} else {
			$data['image'] = $this->model_journal3_image->transparent($width, $height);

			if (Arr::get($this->settings, 'thumbnailNavigation') !== 'disabled') {
				$data['thumb'] = $this->model_journal3_image->transparent($this->settings['thumbnailDimensions']['width'], $this->settings['thumbnailDimensions']['height']);
			}
		}

		if ($parser->getSetting('type') === 'video') {
			$data['video'] = $parser->getSetting('videoHtml5Url');
		}

		$data['background'] = array();

		if ($parser->getSetting('background.background')) {
			$data['background'][] = 'background: ' . $parser->getSetting('background.background') . ' !important';
		}

		if ($parser->getSetting('background.gradient')) {
			$data['background'][] = rtrim($parser->getSetting('background.gradient'), ';') . ' !important';
		}

		if ($parser->getSetting('background.background-image')) {
			$data['background'][] = 'background-image: ' . $parser->getSetting('background.background-image') . ' !important';
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
				'ls-layer',
				'ls-layer-' . $parser->getSetting('type'),
				'btn' => $parser->getSetting('type') === 'button',
			),
			'style'   => array(),
		);

		// position
		$data['style'][] = 'top: ' . $parser->getSetting('positionY');
		$data['style'][] = 'left: ' . $parser->getSetting('positionX');

		// offset
		if (($v = $parser->getSetting('offset.first')) !== '') {
			$data['style'][] = 'margin-left: ' . $v . 'px';
		}

		if (($v = $parser->getSetting('offset.second')) !== '') {
			$data['style'][] = 'margin-top: ' . $v . 'px';
		}

		// size
		if (($v = $parser->getSetting('size.first')) !== '') {
			$data['style'][] = 'width: ' . $v . 'px';
			$width = $v;
		}

		if (($v = $parser->getSetting('size.second')) !== '') {
			$data['style'][] = 'height: ' . $v . 'px';
			$height = $v;
		}

		switch ($parser->getSetting('type')) {
			case 'hotspot':
				$data['hotspot'][] = 'data-toggle="popover"';
				$data['hotspot'][] = 'data-placement="' . $parser->getSetting('hotspotPosition') . '"';
				$data['hotspot'][] = 'data-content="' . $parser->getSetting('text') . '"';
				break;

			case 'image':
				$image = $parser->getSetting('image');

				if (!is_file(DIR_IMAGE . $image)) {
					$image = 'placeholder.png';
				}

				$data['image'] = $this->model_journal3_image->resize($image, $width, $height);
				break;

			case 'video':
				$data['videoWidth'] = $width;
				$data['videoHeight'] = $width;

				switch ($parser->getSetting('videoType')) {
					case 'html5':
						$data['src'] = $parser->getSetting('videoHtml5Url');
						break;

					case 'youtube':
						$data['src'] = Str::YoutubeId($parser->getSetting('videoYoutubeUrl'));
						break;

					case 'vimeo':
						$data['src'] = Str::VimeoId($parser->getSetting('videoVimeoUrl'));
						break;
				}
				break;
		}

		// fade in animation
		if (!$parser->getSetting('fadeIn')) {
			$data['data'][] = 'fadein: false';
		}

		// offset in animation
		if (($v = $parser->getSetting('offsetIn.first')) !== '') {
			$data['data'][] = 'offsetxin: ' . $v;
		}

		if (($v = $parser->getSetting('offsetIn.second')) !== '') {
			$data['data'][] = 'offsetyin: ' . $v;
		}

		// scale in animation
		if (($v = $parser->getSetting('scaleIn.first')) !== '') {
			$data['data'][] = 'scalexin: ' . $v;
		}

		if (($v = $parser->getSetting('scaleIn.second')) !== '') {
			$data['data'][] = 'scaleyin: ' . $v;
		}

		// size in animation
		if (($v = $parser->getSetting('sizeIn.first')) !== '') {
			$data['data'][] = 'widthin: ' . $v;
		}

		if (($v = $parser->getSetting('sizeIn.second')) !== '') {
			$data['data'][] = 'heightin: ' . $v;
		}

		// rotate in animation
		if (($v = $parser->getSetting('rotateIn.first')) !== '') {
			$data['data'][] = 'rotatexin: ' . $v;
		}

		if (($v = $parser->getSetting('rotateIn.second')) !== '') {
			$data['data'][] = 'rotateyin: ' . $v;
		}

		// duration in animation
		if (($v = $parser->getSetting('durationIn')) !== '') {
			$data['data'][] = 'durationin: ' . $v;
		}

		// start at in animation
		if (($v = $parser->getSetting('startAtIn')) !== '') {
			$data['data'][] = 'startatin: ' . $v;
		}

		// easing in animation
		if (($v = $parser->getSetting('easingIn')) !== '') {
			$data['data'][] = 'easingin: ' . $v;
		}

		// fade out animation
		if (!$parser->getSetting('fadeOut')) {
			$data['data'][] = 'fadeout: false';
		}

		// offset out animation
		if (($v = $parser->getSetting('offsetOut.first')) !== '') {
			$data['data'][] = 'offsetxout: ' . $v;
		}

		if (($v = $parser->getSetting('offsetOut.second')) !== '') {
			$data['data'][] = 'offsetyout: ' . $v;
		}

		// scale out animation
		if (($v = $parser->getSetting('scaleOut.first')) !== '') {
			$data['data'][] = 'scalexout: ' . $v;
		}

		if (($v = $parser->getSetting('scaleOut.second')) !== '') {
			$data['data'][] = 'scaleyout: ' . $v;
		}

		// size out animation
		if (($v = $parser->getSetting('sizeOut.first')) !== '') {
			$data['data'][] = 'widthout: ' . $v;
		}

		if (($v = $parser->getSetting('sizeOut.second')) !== '') {
			$data['data'][] = 'heightout: ' . $v;
		}

		// rotate out animation
		if (($v = $parser->getSetting('rotateOut.first')) !== '') {
			$data['data'][] = 'rotatexout: ' . $v;
		}

		if (($v = $parser->getSetting('rotateOut.second')) !== '') {
			$data['data'][] = 'rotateyout: ' . $v;
		}

		// duration out animation
		if (($v = $parser->getSetting('durationOut')) !== '') {
			$data['data'][] = 'durationout: ' . $v;
		}

		// start at out animation
		if (($v = $parser->getSetting('startAtOut')) !== '') {
			$data['data'][] = 'startatout: ' . $v;
		}

		// easing out animation
		if (($v = $parser->getSetting('easingOut')) !== '') {
			$data['data'][] = 'easingout: ' . $v;
		}

		return $data;
	}

}
