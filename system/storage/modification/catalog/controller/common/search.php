<?php
class ControllerCommonSearch extends Controller {
	public function index() {

            if (defined('JOURNAL3_ACTIVE')) {
                $this->load->model('journal3/links');

                $data['search_url'] = $this->model_journal3_links->url('product/search', 'search=');

                if ($this->journal3->settings->get('searchStyleSearchCategoriesSelectorStatus')) {
                    $this->load->language('product/search');
                    $this->load->model('journal3/category');

                    $category_id = (int)\Journal3\Utils\Arr::get($this->request->get, 'category_id', 0);
                    $category = $this->language->get('text_category');

                    if ($category_id) {
                        $category_info = $this->model_catalog_category->getCategory($category_id);

                        if ($category_info) {
                            $category = $category_info['name'];
                        }
                    }

                    $data['text_category'] = $this->language->get('text_category');
                    $data['category'] = $category;
                    $data['category_id'] = $category_id;

                    if ($this->journal3->settings->get('searchStyleSearchCategoriesType') !== 'all') {
                        $categories = $this->model_journal3_category->getCategories(0, 0, $this->journal3->settings->get('searchStyleSearchCategoriesType') === 'top_only');

                        $data['categories'] = array();

                        foreach ($categories as $category) {
                            $data['categories'][] = array(
                                'category_id' => $category['category_id'],
                                'title' => $category['name'],
                                'items' => array()
                            );
                        }
                    } else {
                        $data['categories'] = $this->model_journal3_category->getSubcategories(0);
                    }
                }
            }
            
		$this->load->language('common/search');

		$data['text_search'] = $this->language->get('text_search');

		if (isset($this->request->get['search'])) {
			$data['search'] = $this->request->get['search'];
		} else {
			$data['search'] = '';
		}

		return $this->load->view('common/search', $data);
	}
}