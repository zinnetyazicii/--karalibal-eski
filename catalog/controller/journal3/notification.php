<?php

use Journal3\Opencart\ModuleController;
use Journal3\Utils\Arr;

class ControllerJournal3Notification extends ModuleController {

	public function index($args) {
		$data = parent::index($args);

		$this->journal3->document->addJs(array('notification' => array(array(
			'm' => $this->module_id,
			'c' => $this->settings['cookie'],
		))));

		return $data;
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseGeneralSettings($parser, $index) {
		return array(
			'classes' => array(
				'notification',
			),
			'options' => array_merge_recursive(
				array(
					'position' => $parser->getSetting('notificationStylePosition'),
					'title'    => $parser->getSetting('title'),
				),
				$parser->getJs()
			),
		);
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseItemSettings($parser, $index) {
		return array();
	}

	/**
	 * @param \Journal3\Options\Parser $parser
	 * @param $index
	 * @return array
	 */
	protected function parseSubitemSettings($parser, $index) {
		return array();
	}

	public function cart($args) {
		if (!$this->journal3->settings->get('notificationStatus')) {
			return false;
		}

		$this->load->language('common/cart');

		if ($args['product_info']['image']) {
			$image = $this->model_journal3_image->resize($args['product_info']['image'], $this->journal3->settings->get('image_dimensions_notification.width'), $this->journal3->settings->get('image_dimensions_notification.height'), $this->journal3->settings->get('image_dimensions_notification.resize'));
			$image2x = $this->model_journal3_image->resize($args['product_info']['image'], $this->journal3->settings->get('image_dimensions_notification.width') * 2, $this->journal3->settings->get('image_dimensions_notification.height') * 2, $this->journal3->settings->get('image_dimensions_notification.resize'));
		} else {
			$image = false;
			$image2x = false;
		}

		return array(
			'className' => 'notification-cart',
			'position'  => $this->journal3->settings->get('cartNotificationStylePosition'),
			'title'     => Arr::get($args, 'product_info.name'),
			'image'     => $image,
			'image2x'   => $image2x,
			'message'   => $args['message'],
			'buttons'   => array(
				array(
					'className' => 'btn btn-cart notification-view-cart',
					'name'      => $this->language->get('text_cart'),
					'href'      => $this->url->link('checkout/cart', '', true),
				),
				array(
					'className' => 'btn btn-success notification-checkout',
					'name'      => $this->language->get('text_checkout'),
					'href'      => $this->url->link('checkout/checkout', '', true),
				),
			),
		);
	}

	public function wishlist($args) {
		if (!$this->journal3->settings->get('notificationStatus')) {
			return false;
		}

		if ($args['product_info']['image']) {
			$image = $this->model_journal3_image->resize($args['product_info']['image'], $this->journal3->settings->get('image_dimensions_notification.width'), $this->journal3->settings->get('image_dimensions_notification.height'), $this->journal3->settings->get('image_dimensions_notification.resize'));
			$image2x = $this->model_journal3_image->resize($args['product_info']['image'], $this->journal3->settings->get('image_dimensions_notification.width') * 2, $this->journal3->settings->get('image_dimensions_notification.height') * 2, $this->journal3->settings->get('image_dimensions_notification.resize'));
		} else {
			$image = false;
			$image2x = false;
		}

		return array(
			'className' => 'notification-wishlist',
			'position'  => $this->journal3->settings->get('wishlistNotificationStylePosition'),
			'title'     => Arr::get($args, 'product_info.name'),
			'image'     => $image,
			'image2x'   => $image2x,
			'message'   => $args['message'],
			'buttons'   => '',
		);
	}

	public function compare($args) {
		if (!$this->journal3->settings->get('notificationStatus')) {
			return false;
		}

		if ($args['product_info']['image']) {
			$image = $this->model_journal3_image->resize($args['product_info']['image'], $this->journal3->settings->get('image_dimensions_notification.width'), $this->journal3->settings->get('image_dimensions_notification.height'), $this->journal3->settings->get('image_dimensions_notification.resize'));
			$image2x = $this->model_journal3_image->resize($args['product_info']['image'], $this->journal3->settings->get('image_dimensions_notification.width') * 2, $this->journal3->settings->get('image_dimensions_notification.height') * 2, $this->journal3->settings->get('image_dimensions_notification.resize'));
		} else {
			$image = false;
			$image2x = false;
		}

		return array(
			'className' => 'notification-compare',
			'position'  => $this->journal3->settings->get('compareNotificationStylePosition'),
			'title'     => Arr::get($args, 'product_info.name'),
			'image'     => $image,
			'image2x'   => $image2x,
			'message'   => $args['message'],
			'buttons'   => '',
		);
	}

}
