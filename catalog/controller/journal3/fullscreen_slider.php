<?php

use Journal3\Opencart\ModuleController;
use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class ControllerJournal3FullscreenSlider extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('journal3/links');
	}

	public function index($args) {
		$data = parent::index($args);

		if (!$data) {
			return null;
		}

		$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/masterslider/style/masterslider.css');
		$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/masterslider/skins/minimal/style.css');
		$this->journal3->document->addScript('catalog/view/theme/journal3/lib/masterslider/masterslider.min.js', 'footer');

		// fullscreen slider offset margin
		if ($this->settings['layout'] === 'fullscreen') {
			if (in_array($this->journal3->settings->get('headerType'), array('compact', 'modern'))) {
				if ($this->journal3->settings->get('stickyFullHomePadding')) {
					$height = 0;
				} else {
					$height = (int)$this->journal3->settings->get('headerCompactHeight');
				}
			} else if (in_array($this->journal3->settings->get('headerType'), array('default'))) {
				$height = (int)$this->journal3->settings->get('headerHeight');
			} else {
				$height = 0;
				$height += (int)$this->journal3->settings->get('headerTopBarHeight');
				$height += (int)$this->journal3->settings->get('headerHeight');
				$height += (int)$this->journal3->settings->get('headerMainMenuHeight');
			}

			if ($height) {
				$this->journal3->document->addCss(".module-master_slider.fullscreen-slider > img { height: calc(100vh - {$height}px) }");
			}
		}

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
			'options' => array_merge_recursive(
				array(
					'width'              => (int)($parser->getSetting('sliderDimensions.first') ? $parser->getSetting('sliderDimensions.first') : $width),
					'height'             => (int)($parser->getSetting('sliderDimensions.second') ? $parser->getSetting('sliderDimensions.second') : $height),
					'layout'             => $parser->getSetting('layout'),
					'smoothHeight'       => false,
					'centerControls'     => false,
					'parallaxMode'       => 'swipe',
					'instantStartLayers' => true,
					'loop'               => $parser->getSetting('loop'),
					'dir'                => $parser->getSetting('direction'),
					'autoHeight'         => $parser->getSetting('autoHeight'),
					'rtl'                => $this->language->get('direction') === 'rtl',
				),
				$parser->getJs()
			),
			'classes' => array(
				'fullscreen-slider' => $parser->getSetting('layout') === 'fullscreen',
			),
		);

		if ($parser->getSetting('arrows')) {
			$data['options']['controls']['arrows'] = array(
				'autohide' => false,
			);
		}

		if ($parser->getSetting('bullets')) {
			$data['options']['controls']['bullets'] = array(
				'autohide' => false,
			);
		}

		if ($parser->getSetting('thumbnails')) {
			$data['options']['controls']['thumblist'] = array(
				'autohide' => false,
				'inset'    => true,
				'align'    => 'bottom',
				'margin'   => 0,
				'type'     => 'thumbs',
				'width'    => $parser->getSetting('thumbnailsDimensions.width'),
				'height'   => $parser->getSetting('thumbnailsDimensions.height'),
			);

			$margin = $parser->getSetting('thumbnailsDimensions.height') + $parser->getSetting('thumbsPadding') * 2 + $parser->getSetting('thumbBorder.border-width') * 2;
			$this->css .= ".module-slider-{$this->module_id} > .img-1 { margin-bottom: {$margin}px; }";

		}

		if ($parser->getSetting('timer')) {
			$data['options']['controls']['timebar'] = array(
				'autohide' => false,
				'inset'    => true,
				'align'    => 'top',
			);
		}

		return $data;
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		$width = Arr::get($this->settings, 'width');
		$height = Arr::get($this->settings, 'height');

		$data = array(
			'classes' => array(
				'ms-slide',
			),
		);

		switch ($parser->getSetting('type')) {
			case 'image':
				// slide image
				$data['image'] = $this->model_journal3_image->resize($parser->getSetting('image'), $width, $height, $this->settings['imageDimensions']['resize']);
				$data['image2x'] = $this->model_journal3_image->resize($parser->getSetting('image'), $width * 2, $height * 2, $this->settings['imageDimensions']['resize']);

				// slide thumb
				if (Arr::get($this->settings, 'thumbnails')) {
					$data['thumb'] = $this->model_journal3_image->resize($parser->getSetting('image'), $this->settings['thumbnailsDimensions']['width'], $this->settings['thumbnailsDimensions']['height'], $this->settings['thumbnailsDimensions']['resize']);
				} else {
					$data['thumb'] = false;
				}
				break;

			case 'custom':
				$data['image'] = $this->model_journal3_image->transparent($width, $height);
				$data['thumb'] = false;
				break;

			case 'video':
				switch ($parser->getSetting('videoType')) {
					case 'html5':
						foreach (explode(',', $parser->getSetting('videoHtml5Url')) as $src) {
							$src = trim($src);
							$data['videoSrc'][pathinfo($src, PATHINFO_EXTENSION)] = $src;
						}
						break;

					case 'youtube':
						$data['videoSrc'] = Str::YoutubeId($parser->getSetting('videoYoutubeUrl'));
						break;

					case 'vimeo':
						$data['videoSrc'] = Str::VimeoId($parser->getSetting('videoVimeoUrl'));
						break;
				}
				break;

		}

		// first image
		if ($index === 1) {
			$this->settings['first_image'] = $data['image'];
			$this->settings['first_alt'] = $parser->getSetting('alt');
		}

		return $data;
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		$data = array(
			'classes' => array(
				'ms-layer',
				'ms-layer-' . $parser->getSetting('type'),
				'btn'            => $parser->getSetting('type') === 'button',
				'no-show-effect' => $parser->getSetting('showEffect') === 'none',
				'ms-caption'     => $parser->getSetting('type') === 'text',
			),
			'data'    => array(
				'data-resize="' . ($parser->getSetting('resize') ? 'true' : 'false') . '"',
				'data-origin="' . $parser->getSetting('origin') . '"',
				'data-parallax="' . $parser->getSetting('layerParallax') . '"',
			),
		);

		// type
		if ($parser->getSetting('type') === 'shape') {
			$data['data'][] = 'data-type="image"';
		} else {
			$data['data'][] = 'data-type="' . $parser->getSetting('type') . '"';
		}

		// offset
		if ($parser->getSetting('offset.first')) {
			$data['data'][] = 'data-offset-x="' . $parser->getSetting('offset.first') . '"';
		}
		if ($parser->getSetting('offset.second')) {
			$data['data'][] = 'data-offset-y="' . $parser->getSetting('offset.second') . '"';
		}

		// show effect
		$effect = $parser->getSetting('showEffect');

		if ($effect === 'none') {
			$data['data'][] = 'data-effect="fade"';
			$data['data'][] = 'data-delay="0"';
			$data['data'][] = 'data-duration="0"';
		} else {
			switch ($effect) {
				case 'top':
				case 'bottom':
				case 'left':
				case 'right':
				case 'back':
				case 'front':
					$effect = "{$effect}({$parser->getSetting('showEffectDistance')})";
					break;

				case 'skewtop':
				case 'skewbottom':
				case 'skewleft':
				case 'skewright':
				case 'rotatetop':
				case 'rotatebottom':
				case 'rotateleft':
				case 'rotateright':
					$effect = "{$effect}({$parser->getSetting('showEffectDegree')},{$parser->getSetting('showEffectDistance')})";
					break;
			}

			$data['data'][] = 'data-effect="' . $effect . '"';
			$data['data'][] = 'data-delay="' . $parser->getSetting('showEffectDelay') . '"';
			$data['data'][] = 'data-duration="' . $parser->getSetting('showEffectDuration') . '"';
			$data['data'][] = 'data-ease="' . $parser->getSetting('showEffectEasing') . '"';
		}

		// hide effect
		$effect = $parser->getSetting('hideEffect');

		if ($effect === 'none') {
			$data['data'][] = 'data-hide-effect="fade"';
			$data['data'][] = 'data-hide-delay="0"';
			$data['data'][] = 'data-hide-duration="0"';
		} else {
			switch ($effect) {
				case 'top':
				case 'bottom':
				case 'left':
				case 'right':
				case 'back':
				case 'front':
					$effect = "{$effect}({$parser->getSetting('hideEffectDistance')})";
					break;

				case 'skewtop':
				case 'skewbottom':
				case 'skewleft':
				case 'skewright':
				case 'rotatetop':
				case 'rotatebottom':
				case 'rotateleft':
				case 'rotateright':
					$effect = "{$effect}({$parser->getSetting('hideEffectDegree')},{$parser->getSetting('hideEffectDistance')})";
					break;
			}

			$data['data'][] = 'data-hide-effect="' . $effect . '"';
			$data['data'][] = 'data-hide-time="' . $parser->getSetting('hideEffectDelay') . '"';
			$data['data'][] = 'data-hide-duration="' . $parser->getSetting('hideEffectDuration') . '"';
			$data['data'][] = 'data-hide-ease="' . $parser->getSetting('hideEffectEasing') . '"';
		}

		// image
		if ($parser->getSetting('type') === 'image') {
			$data['image'] = $this->model_journal3_image->resize($parser->getSetting('image'), $parser->getSetting('imageDimensions.width'), $parser->getSetting('imageDimensions.height'), $parser->getSetting('imageDimensions.resize'));
		}

		// video
		if ($parser->getSetting('type') === 'video') {
			switch ($parser->getSetting('videoType')) {
				case 'html5':
					foreach (explode(',', $parser->getSetting('videoHtml5Url')) as $src) {
						$src = trim($src);
						$data['videoSrc'][pathinfo($src, PATHINFO_EXTENSION)] = $src;
					}
					break;

				case 'youtube':
					$data['videoSrc'] = Str::YoutubeId($parser->getSetting('videoYoutubeUrl'));
					break;

				case 'vimeo':
					$data['videoSrc'] = Str::VimeoId($parser->getSetting('videoVimeoUrl'));
					break;
			}

			$data['data'][] = 'data-autoplay="' . ($parser->getSetting('layerAutoplay') ? 'true' : 'false') . '"';
		}

		// hotspot
		if ($parser->getSetting('type') === 'hotspot') {
			$data['data'][] = 'data-align="' . $parser->getSetting('hotspotAlign') . '"';
		}

		return $data;
	}

}
