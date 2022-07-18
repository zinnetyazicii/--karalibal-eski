<?php

use Journal3\Opencart\ModuleController;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;

class ControllerJournal3BlogSidePosts extends ModuleController {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/blog');
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
				'carousel-mode' => $parser->getSetting('carousel'),
				'isotope'       => $parser->getSetting('sectionsDisplay') === 'isotope',
			),
			'image_width'     => $parser->getSetting('imageDimensions.width', $this->journal3->settings->get('image_dimensions_blog.width')),
			'image_height'    => $parser->getSetting('imageDimensions.height', $this->journal3->settings->get('image_dimensions_blog.height')),
			'image_resize'    => $parser->getSetting('imageDimensions.resize'),
			'carouselOptions' => $this->journal3->carousel($parser->getJs(), 'carouselStyle'),
		);

		if ($this->journal3->settings->get('performanceLazyLoadImagesStatus')) {
			$data['dummy_image'] = $this->model_journal3_image->transparent($parser->getSetting('imageDimensions.width', $this->journal3->settings->get('image_dimensions_blog.width')), $parser->getSetting('imageDimensions.height', $this->journal3->settings->get('image_dimensions_blog.height')));
		}

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

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
		$preset = $parser->getSetting('filter.preset');
		$filter_data = $parser->getSetting('filter');

		switch ($preset) {
			case 'related':
				$posts = null;
				break;

			default:
				$results = $this->model_journal3_blog->getPosts($filter_data);
				$posts = $this->parsePosts($results);
		}

		return array(
			'tab_classes'   => array(
				'tab-' . $this->item_id,
			),
			'panel_classes' => array(
				'panel-collapse',
				'collapse',
			),
			'classes'       => array(
				'tab-pane'     => $this->settings['sectionsDisplay'] === 'tabs',
				'panel'        => $this->settings['sectionsDisplay'] === 'accordion',
				'swiper-slide' => ($this->settings['sectionsDisplay'] === 'blocks') && $this->settings['carousel'],
			),
			'posts'         => $posts,
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

	protected function beforeRender() {
		if (!$this->settings['items']) {
			$this->settings = null;

			return;
		}

		foreach ($this->settings['items'] as $key => $item) {
			$posts = $item['posts'];

			if ($posts === null) {
				$filter_data = Arr::get($item, 'filter');
				$preset = Arr::get($filter_data, 'preset');
				$limit = Arr::get($filter_data, 'limit');

				switch ($preset) {
					case 'related':
						switch (Arr::get($this->request->get, 'route')) {
							case 'product/product':
								$product_id = (int)Arr::get($this->request->get, 'product_id');
								$results = $this->model_journal3_blog->getRelatedPosts($product_id, $limit);
								break;

							default:
								$results = array();
						}

						break;

					case 'custom':
						$results = $this->model_journal3_blog->getPost(Arr::get($filter_data, 'posts'));
						break;

					default:
						$results = $this->model_journal3_blog->getPosts($filter_data);
				}

				if (!$results) {
					unset($this->settings['items'][$key]);

					continue;
				}

				$posts = $this->parsePosts($results);
			}

			if (!$posts) {
				unset($this->settings['items'][$key]);

				continue;
			}

			$this->settings['items'][$key]['posts'] = $posts;

			if ($this->settings['sectionsDisplay'] === 'isotope') {
				foreach ($posts as $post) {
					if (!isset($this->settings['posts'][$post['post_id']])) {
						$this->settings['posts'][$post['post_id']] = $posts[$post['post_id']];
					}

					$this->settings['posts'][$post['post_id']]['classes'] = array_merge_recursive($this->settings['posts'][$post['post_id']]['classes'], array($this->settings['id'] . '-section-' . $key));
				}
			}
		}

		if (!$this->settings['items']) {
			$this->settings = null;

			return;
		}

		$keys = array_keys($this->settings['items']);

		if (!in_array($this->settings['default_index'], $keys)) {
			$this->settings['default_index'] = $keys[0];
		}

		if ($this->settings['sectionsDisplay'] === 'tabs') {
			$this->settings['items'][$this->settings['default_index']]['classes'][] = 'active';
			$this->settings['items'][$this->settings['default_index']]['tab_classes'][] = 'active';
		}

		if ($this->settings['sectionsDisplay'] === 'accordion') {
			$this->settings['items'][$this->settings['default_index']]['classes'][] = 'active';
			$this->settings['items'][$this->settings['default_index']]['panel_classes'][] = 'in';
		}
	}

	protected function afterRender() {
		if ($this->settings['sectionsDisplay'] === 'isotope') {
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/isotope/isotope.pkgd.min.js', 'footer');
		}

		if ($this->settings['carousel']) {
			$this->journal3->document->addStyle('catalog/view/theme/journal3/lib/swiper/swiper.min.css');
			$this->journal3->document->addScript('catalog/view/theme/journal3/lib/swiper/swiper.min.js', 'footer');
		}
	}

	private function parsePosts($results) {
		$posts = array();

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_journal3_image->resize($result['image'], $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
				$image2x = $this->model_journal3_image->resize($result['image'], $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
			} else {
				$image = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'], $this->settings['image_height'], $this->settings['image_resize']);
				$image2x = $this->model_journal3_image->resize('placeholder.png', $this->settings['image_width'] * 2, $this->settings['image_height'] * 2, $this->settings['image_resize']);
			}

			$posts[$result['post_id']] = array(
				'classes'     => array(
					'swiper-slide' => $this->settings['sectionsDisplay'] !== 'isotope' && $this->settings['carousel'],
					'isotope-item' => $this->settings['sectionsDisplay'] === 'isotope',
				),
				'post_id'     => $result['post_id'],
				'thumb'       => $image,
				'thumb2x'     => $image2x,
				'author'      => $this->model_journal3_blog->getAuthorName($result),
				'name'        => $result['name'],
				'comments'    => $result['comments'],
				'views'       => $result['views'],
				'date'        => $this->journal3->blog_date($result['date']),
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, (int)$this->journal3->settings->get('blogPostsDescriptionLimit')) . '..',
				'href'        => $this->url->link('journal3/blog/post', 'journal_blog_post_id=' . $result['post_id']),
			);
		}

		return $posts;
	}

}
