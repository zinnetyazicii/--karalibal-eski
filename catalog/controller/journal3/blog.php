<?php

use Journal3\Opencart\Controller;
use Journal3\Utils\Arr;
use Journal3\Utils\Str;

class ControllerJournal3Blog extends Controller {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/blog');
		$this->load->model('journal3/image');

		$this->language->load('information/contact');
		$this->language->load('affiliate/register');
		$this->language->load('product/product');
		$this->language->load('product/category');
	}

	public function index() {
		if (!$this->model_journal3_blog->isEnabled()) {
			$this->response->redirect($this->url->link($this->config->get('action_error')));
			exit();
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home'),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->journal3->settings->get('blogPageTitle'),
			'href' => $this->url->link('journal3/blog'),
		);

		$category_id = (int)Arr::get($this->request->get, 'journal_blog_category_id');

		$tag = Arr::get($this->request->get, 'journal_blog_tag');

		$search = Arr::get($this->request->get, 'journal_blog_search');

		$page = max((int)Arr::get($this->request->get, 'page', 1), 1);

		$limit = max((int)Arr::get($this->request->get, 'limit', $this->journal3->settings->get('blogPostsPerPage')), 1);

		if ($category_id) {
			$category_info = $this->model_journal3_blog->getCategory($category_id);

			if ($category_info) {
				$this->document->setTitle($category_info['meta_title']);
				$this->document->setDescription($category_info['meta_description']);
				$this->document->setKeywords($category_info['meta_keywords']);

				$data['category_description'] = $category_info['description'];
			}
		} else {
			$category_info = null;

			$data['heading_title'] = $this->journal3->settings->get('blogPageTitle');

			$this->document->setTitle($this->journal3->settings->get('blogPageMetaTitle'));
			$this->document->setDescription($this->journal3->settings->get('blogPageMetaDescription'));
			$this->document->setKeywords($this->journal3->settings->get('blogPageMetaKeyword'));
		}

		if ($category_id && !$category_info) {
			$this->load->language('error/not_found');

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('journal3/blog', 'journal_blog_category_id=' . $category_id),
			);

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('journal3/blog');

			$this->document->setTitle($this->language->get('text_error'));

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));

			return;
		}

		if ($category_id) {
			$data['breadcrumbs'][] = array(
				'text' => $category_info['name'],
				'href' => $this->url->link('journal3/blog', 'journal_blog_category_id=' . $category_id),
			);

			$data['heading_title'] = $category_info['name'];
		}

		if ($tag) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('journal3/blog', 'journal_blog_tag=' . $tag),
			);

			$data['heading_title'] = $this->journal3->settings->get('blogPageTitle') . ' - ' . $tag;
		}

		if ($search) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('journal3/blog', 'journal_blog_search=' . $search),
			);

			$data['heading_title'] = $this->journal3->settings->get('blogPageTitle') . ' - ' . $search;
		}

		$filter_data = array(
			'category_id' => $category_id,
			'tag'         => $tag,
			'search'      => $search,
			'limit'       => $limit,
			'start'       => ($page - 1) * $limit,
			'sort'        => $this->journal3->settings->get('blogPostsSort'),
		);

		$results = $this->model_journal3_blog->getPosts($filter_data);
		$total = $this->model_journal3_blog->getPostsTotal($filter_data);

		$data['image_width'] = $this->journal3->settings->get('image_dimensions_blog.width');
		$data['image_height'] = $this->journal3->settings->get('image_dimensions_blog.height');

		if ($this->journal3->settings->get('performanceLazyLoadImagesStatus')) {
			$data['dummy_image'] = $this->model_journal3_image->transparent($data['image_width'], $data['image_height']);
		}

		$data['posts'] = array();

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_journal3_image->resize($result['image'], $data['image_width'], $data['image_height'], $this->journal3->settings->get('image_dimensions_blog.resize'));
				$image2x = $this->model_journal3_image->resize($result['image'], $data['image_width'] * 2, $data['image_height'] * 2, $this->journal3->settings->get('image_dimensions_blog.resize'));
			} else {
				$image = $this->model_journal3_image->resize('placeholder.png', $data['image_width'], $data['image_height'], $this->journal3->settings->get('image_dimensions_blog.resize'));
				$image2x = $this->model_journal3_image->resize('placeholder.png', $data['image_width'] * 2, $data['image_height'] * 2, $this->journal3->settings->get('image_dimensions_blog.resize'));
			}

			$data['posts'][$result['post_id']] = array(
				'classes'     => array(
					$this->display === 'carousel' ? 'swiper-slide' : '',
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
				'href'        => $this->url->link('journal3/blog/post', ($category_info ? 'journal_blog_category_id=' . $category_id . '&' : '') . 'journal_blog_post_id=' . $result['post_id']),
			);
		}

		$url = '';

		if ($category_info) {
			$url .= '&journal_blog_category_id=' . $category_id;
		}

		if ($tag) {
			$url .= '&journal_blog_tag=' . $tag;
		}

		if (isset($this->request->get['journal_blog_search'])) {
			$url .= '&journal_blog_search=' . $this->request->get['journal_blog_search'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}

		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('journal3/blog', $url . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit), $total, ceil($total / $limit));

		$category_param = $category_info ? '&journal_blog_category_id=' . $category_id : '';

		// http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
		if ($page == 1) {
			$this->document->addLink($this->url->link('journal3/blog' . $category_param), 'canonical');
		} else {
			$this->document->addLink($this->url->link('journal3/blog' . $category_param . '&page=' . $page), 'canonical');
		}

		if ($page > 1) {
			$this->document->addLink($this->url->link('journal3/blog' . $category_param . (($page - 2) ? '&page=' . ($page - 1) : '')), 'prev');
		}

		if ($limit && ceil($total / $limit) > $page) {
			$this->document->addLink($this->url->link('journal3/blog' . $category_param . '&page=' . ($page + 1)), 'next');
		}

		if ($this->journal3->settings->get('blogFeedStatus')) {
			if ($category_info) {
				$data['feed_url'] = $this->url->link('journal3/blog/feed', 'journal_blog_feed_category_id=' . $category_id);
			} else {
				$data['feed_url'] = $this->url->link('journal3/blog/feed');
			}
		} else {
			$data['feed_url'] = false;
		}

		$data['limit'] = $limit;

		$data['text_empty'] = $this->journal3->settings->get('blogNoResults');
		$data['button_continue'] = $this->language->get('button_continue');
		$data['continue'] = $this->url->link('journal3/blog');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('journal3/blog/posts', $data));
	}

	public function post() {
		if (!$this->model_journal3_blog->isEnabled()) {
			$this->response->redirect($this->url->link($this->config->get('action_error')));
			exit();
		}

		$data['date_format_short'] = $this->journal3->settings->getWith('blogDateFormat', null, 'd \<\i\>M\<\/\i\>');
		$data['time_format'] = $this->language->get('time_format');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_website'] = $this->language->get('entry_website');
		$data['text_comment'] = $this->language->get('text_comment');
		$data['button_submit'] = $this->language->get('button_submit');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home'),
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->journal3->settings->get('blogPageTitle'),
			'href' => $this->url->link('journal3/blog'),
		);

		$post_id = (int)Arr::get($this->request->get, 'journal_blog_post_id');

		$post_info = $this->model_journal3_blog->getPost($post_id);

		if ($post_info) {
			$data['breadcrumbs'][] = array(
				'text' => $post_info['name'],
				'href' => $this->url->link('journal3/blog/post', 'journal_blog_post_id=' . $post_id),
			);

			$this->document->setTitle($post_info['meta_title']);
			$this->document->setDescription($post_info['meta_description']);
			$this->document->setKeywords($post_info['meta_keywords']);
			$this->document->addLink($this->url->link('journal3/blog/post', 'journal_blog_post_id=' . $post_id), 'canonical');

			$data['text_tags'] = $this->language->get('text_tags');

			$data['post_id'] = $post_info['post_id'];
			$data['post_author'] = $this->model_journal3_blog->getAuthorName($post_info);
			$data['post_date'] = $post_info['date_created'];
			$data['post_content'] = $post_info['description'];
			$data['post_name'] = $post_info['name'];
			$data['post_views'] = $post_info['views'];
			$data['image_width'] = $this->journal3->settings->get('image_dimensions_blog_post.width');
			$data['image_height'] = $this->journal3->settings->get('image_dimensions_blog_post.height');

			if ($post_info['image']) {
				$data['post_image'] = $this->model_journal3_image->resize($post_info['image'], $data['image_width'], $data['image_height'], $this->journal3->settings->get('image_dimensions_blog_post.resize'));
				$data['post_image2x'] = $this->model_journal3_image->resize($post_info['image'], $data['image_width'] * 2, $data['image_height'] * 2, $this->journal3->settings->get('image_dimensions_blog_post.resize'));
			} else {
				$data['post_image'] = $this->model_journal3_image->resize('placeholder.png', $data['image_width'], $data['image_height'], $this->journal3->settings->get('image_dimensions_blog_post.resize'));
				$data['post_image2x'] = $this->model_journal3_image->resize('placeholder.png', $data['image_width'] * 2, $data['image_height'] * 2, $this->journal3->settings->get('image_dimensions_blog_post.resize'));
			}

			$data['post_tags'] = array();

			foreach (explode(',', $post_info['tags']) as $tag) {
				$tag = trim($tag);

				if ($tag) {
					$data['post_tags'][] = array(
						'href' => $this->url->link('journal3/blog', 'journal_blog_tag=' . $tag),
						'name' => $tag,
					);
				}
			}

			$data['post_categories'] = array();

			$results = $this->model_journal3_blog->getCategoriesByPostId($post_id);

			foreach ($results as $result) {
				$data['post_categories'][] = array(
					'href' => $this->url->link('journal3/blog', 'journal_blog_category_id=' . $result['category_id']),
					'name' => $result['name'],
				);
			}

			$data['allow_comments'] = $this->model_journal3_blog->getCommentsStatus($post_info);

			$data['comments'] = $this->model_journal3_blog->getComments($post_id);

			if (version_compare(VERSION, '2.1', '<')) {
				$this->load->library('user');
			} else {
				$this->user = new \Cart\User($this->registry);
			}

			if ($this->customer->isLogged()) {
				$this->load->model('account/customer');
				$customer_info = $this->model_account_customer->getCustomer($this->customer->getId());
				$data['default_name'] = trim($customer_info['firstname'] . ' ' . $customer_info['lastname']);
				$data['default_email'] = $customer_info['email'];
			} else if ($this->user->isLogged()) {
				$admin_info = $this->model_journal3_blog->getAdminInfo($this->user->getId());
				$data['default_name'] = trim($admin_info['firstname'] . ' ' . $admin_info['lastname']);
				$data['default_email'] = $admin_info['email'];
			} else {
				$data['default_name'] = '';
				$data['default_email'] = '';
			}

			$data['default_comment'] = '';
			$data['default_website'] = '';

			$this->model_journal3_blog->updateViews($post_id);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('journal3/blog/post', $data));
		} else {
			$this->load->language('error/not_found');

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('journal3/blog/post', 'journal_blog_post_id=' . $post_id),
			);

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('journal3/blog');

			$this->document->setTitle($this->language->get('text_error'));

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			$this->response->setOutput($this->load->view('error/not_found', $data));
		}
	}

	public function comment() {
		if (!$this->model_journal3_blog->isEnabled()) {
			$this->renderJson('error', array(
				'message' => 'Not Found!',
			));

			return;
		}

		$post_id = (int)Arr::get($this->request->get, 'post_id');

		$post_info = $this->model_journal3_blog->getPost($post_id);

		if (!$post_info) {
			$this->renderJson('error', array(
				'message' => 'Post not found!',
			));

			return;
		}

		if (!$this->model_journal3_blog->getCommentsStatus($post_info)) {
			$this->renderJson('error', array(
				'message' => 'Comments are not allowed for this post!',
			));

			return;
		}

		$errors = array();

		$name = trim(Arr::get($this->request->post, 'name', ''));
		$email = trim(Arr::get($this->request->post, 'email', ''));
		$website = trim(Arr::get($this->request->post, 'website', ''));
		$comment = trim(Arr::get($this->request->post, 'comment', ''));


		if (!$name) {
			$errors['name'] = true;
		}

		if (!$email || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email)) {
			$errors['email'] = true;
		}

		if (!$comment) {
			$errors['comment'] = true;
		}

		if ($errors) {
			$this->renderJson('error', array(
				'errors' => $errors,
			));

			return;
		}
		$data = $this->model_journal3_blog->createComment(array(
			'post_id'   => $post_id,
			'parent_id' => Arr::get($this->request->post, 'parent_id'),
			'name'      => $name,
			'email'     => $email,
			'website'   => $website,
			'comment'   => $comment,
		));

		if ($this->journal3->settings->get('blogPostApproveComments')) {
			$data['time'] = date($this->language->get('time_format'), strtotime($data['date']));
			$data['date'] = $this->journal3->blog_date($data['date']);

			if ($data['website']) {
				$data['website'] = trim($data['website'], '/');
				$data['website'] = parse_url($data['website'], PHP_URL_SCHEME) !== null ? $data['website'] : ('http://' . $data['website']);
				$data['href'] = $data['website'];
				$data['website'] = preg_replace('#^https?://#', '', $data['website']);
			}

			$data['avatar'] = md5(strtolower(trim($email)));

			$this->renderJson('success', array(
				'data'    => $data,
				'message' => $this->journal3->settings->get('blogCommentSubmitText'),
			));
		} else {
			$this->renderJson('success', array(
				'message' => $this->journal3->settings->get('blogCommentApprovalText'),
			));
		}

	}

	public function feed() {
		if (!$this->model_journal3_blog->isEnabled()) {
			$this->response->redirect($this->url->link($this->config->get('action_error')));
			exit();
		}

		$category_id = (int)Arr::get($this->request->get, 'journal_blog_category_id');

		$category_info = $this->model_journal3_blog->getCategory($category_id);

		$data = array(
			'feed_link'        => Str::urlPathEncode($this->url->link('journal3/blog/feed')),
			'blog_link'        => Str::urlPathEncode($this->url->link('journal3/blog')),
			'title'            => $this->journal3->settings->get('blogPageTitle'),
			'meta_description' => '',
			'posts'            => array(),
		);

		$filter_data = array(
			'category_id' => $category_id,
			'sort'        => 'newest',
			'start'       => 0,
			'limit'       => PHP_INT_MAX,
		);

		$results = $this->model_journal3_blog->getPosts($filter_data);

		foreach ($results as $result) {
			if ($result['image']) {
				$image = $this->model_journal3_image->resize($result['image'], $this->journal3->settings->get('image_dimensions_blog.width'), $this->journal3->settings->get('image_dimensions_blog.height'));
			} else {
				$image = $this->model_journal3_image->resize('placeholder.png', $this->journal3->settings->get('image_dimensions_blog.width'), $this->journal3->settings->get('image_dimensions_blog.height'));
			}

			$data['posts'][] = array(
				'post_id'     => $result['post_id'],
				'thumb'       => $image,
				'author'      => $result['email'] ? ($result['email'] . ' (' . $this->model_journal3_blog->getAuthorName($result) . ')') : null,
				'name'        => $result['name'],
				'comments'    => $result['comments'],
				'views'       => $result['views'],
				'date'        => date(DATE_RSS, strtotime($result['date'])),
				'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, (int)$this->journal3->settings->get('blogPostsDescriptionLimit')) . '..',
				'href'        => Str::urlPathEncode($this->url->link('journal3/blog/post', ($category_info ? 'journal_blog_category_id=' . $category_id . '&' : '') . 'journal_blog_post_id=' . $result['post_id'])),
			);
		}

		$this->response->addHeader('Content-Type: application/rss+xml; charset=UTF-8');
		$this->response->setOutput($this->load->view('journal3/blog/feed', $data));
	}

	public function sitemap() {
		if (!$this->model_journal3_blog->isEnabled()) {
			return null;
		}

		$result = array(
			'name'       => $this->journal3->settings->get('blogPageTitle'),
			'href'       => $this->url->link('journal3/blog'),
			'categories' => array(),
		);

		foreach ($this->model_journal3_blog->getCategories() as $category) {
			$result['categories'][] = array(
				'name' => $category['name'],
				'href' => $this->url->link('journal3/blog', 'journal_blog_category_id=' . $category['category_id']),
			);
		}

		return $result;
	}

	public function google_sitemap() {
		if (!$this->model_journal3_blog->isEnabled()) {
			return null;
		}

		$output = '';

		$posts = $this->model_journal3_blog->getPosts();

		foreach ($posts as $post) {
			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('journal3/blog/post', 'journal_blog_post_id=' . $post['post_id']) . '</loc>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>1.0</priority>';
			$output .= '</url>';
		}

		$results = $this->model_journal3_blog->getCategories();

		foreach ($results as $result) {
			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('journal3/blog', 'journal_blog_category_id=' . $result['category_id']) . '</loc>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>0.7</priority>';
			$output .= '</url>';

			$posts = $this->model_journal3_blog->getPosts(array('category_id' => $result['category_id']));

			foreach ($posts as $post) {
				$output .= '<url>';
				$output .= '<loc>' . $this->url->link('journal3/blog/post', 'journal_blog_category_id=' . $result['category_id'] . '&journal_blog_post_id=' . $post['post_id']) . '</loc>';
				$output .= '<changefreq>weekly</changefreq>';
				$output .= '<priority>1.0</priority>';
				$output .= '</url>';
			}
		}

		return $output;
	}
}
