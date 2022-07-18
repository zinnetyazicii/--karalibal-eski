<?php

use Journal3\Opencart\Controller;
use Journal3\Options\Parser;
use Journal3\Utils\Arr;
use Journal3\Utils\Profiler;

class ControllerJournal3Product extends Controller {

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/filter');
		$this->load->model('journal3/module');
		$this->load->model('journal3/product');
	}

	public function index() {
		$this->request->get['route'] = 'product/product';

		return $this->load->controller('product/product');
	}

	public function extras($args) {
		$cache_key = $args['module_type'];

		$cache = $this->journal3->cache->get($cache_key);

		if ($cache === false) {
			$cache = array(
				'data'       => array(),
				'all'        => array(),
				'special'    => array(),
				'outofstock' => array(),
				'custom'     => array(),
			);

			$modules = $this->model_journal3_module->getByType($args['module_type']);

			foreach ($modules as $module_id => $module_data) {
				Profiler::start('journal3/product/extras/' . $args['module_type'] . '/' . $module_id);

				$parser = new Parser('module/' . $args['module_type'] . '/' . $args['module_type'], Arr::get($module_data, 'general'), null, array($module_id));

				if ($parser->getSetting('status') === false) {
					continue;
				}

				$cache['data'][$module_id]['php'] = $parser->getPhp();
				$cache['data'][$module_id]['js'] = $parser->getJs();
				$cache['data'][$module_id]['fonts'] = $parser->getFonts();
				$cache['data'][$module_id]['css'] = $parser->getCss();

				switch ($parser->getSetting('type')) {
					case 'special':
						$cache['special'][$module_id] = $module_id;
						break;

					case 'outofstock':
						$cache['outofstock'][$module_id] = $module_id;
						break;

					case 'custom':
						$preset = $parser->getSetting('filter.preset');
						$filter_data = $parser->getSetting('filter');
						$limit = $parser->getSetting('filter.limit');

						if ($preset === 'all') {
							$cache['all'][$module_id] = $module_id;
							break;
						}

						switch ($preset) {
							case 'most_viewed':
								$results = $this->model_journal3_product->getMostViewedProducts($limit);
								break;

							case 'custom':
								$results = $this->model_journal3_product->getProduct($parser->getSetting('filter.products'));
								break;

							default:
								$filter_data['ignore_stock'] = true;
								$results = $this->model_journal3_filter->getProducts($filter_data);
								break;
						}

						foreach ($results as $result) {
							$cache['custom'][$result['product_id']][$module_id] = $module_id;
						}

						break;
				}

				Profiler::end('journal3/product/extras/' . $args['module_type'] . '/' . $module_id);
			}

			$this->journal3->cache->set($cache_key, $cache);
		}

		foreach ($cache['data'] as $data) {
			if ($data['css']) {
				$this->journal3->document->addCss($data['css']);
			}

			if ($data['fonts']) {
				$this->journal3->document->addFonts($data['fonts']);
			}
		}

		$this->journal3->setProductData($args['module_type'], $cache);
	}

	public function second_image() {
		$this->journal3->setProductData('second_image', $this->model_journal3_product->getProductsSecondImage());
	}

	public function countdown() {
		$this->journal3->setProductData('countdown', $this->model_journal3_product->getProductsCountdown());
	}

}
