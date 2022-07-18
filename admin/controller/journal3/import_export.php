<?php

use Journal3\Opencart\Controller;
use Journal3\Utils\Str;

class ControllerJournal3ImportExport extends Controller {

	private static $TABLES = array(
		'variable'   => array('journal3_variable'),
		'setting'    => array('journal3_setting'),
		'skin'       => array(
			'journal3_skin',
			'journal3_skin_setting',
		),
		'style'      => array('journal3_style'),
		'module'     => array('journal3_module'),
		'layout'     => array('journal3_layout'),
		'blog'       => array(
			'journal3_blog_category',
			'journal3_blog_category_description',
			'journal3_blog_category_to_layout',
			'journal3_blog_category_to_store',
			'journal3_blog_post',
			'journal3_blog_post_description',
			'journal3_blog_post_to_category',
			'journal3_blog_post_to_layout',
			'journal3_blog_post_to_store',
			'journal3_blog_post_to_product',
			'journal3_blog_comments',
		),
		'newsletter' => array('journal3_newsletter'),
		'message'    => array('journal3_message'),
		'catalog'    => array(
			'attribute',
			'attribute_description',
			'attribute_group',
			'attribute_group_description',

			'category',
			'category_description',
			'category_filter',
			'category_path',
			'category_to_layout',
			'category_to_store',

			'filter',
			'filter_description',
			'filter_group',
			'filter_group_description',

			'information',
			'information_description',
			'information_to_layout',
			'information_to_store',

			'layout',
			'layout_route',

			'manufacturer',
			'manufacturer_to_store',

			'option',
			'option_description',
			'option_value',
			'option_value_description',

			'product',
			'product_attribute',
			'product_description',
			'product_discount',
			'product_filter',
			'product_image',
			'product_option',
			'product_option_value',
			'product_recurring',
			'product_related',
			'product_reward',
			'product_special',
			'product_to_category',
			'product_to_download',
			'product_to_layout',
			'product_to_store',

			'stock_status',

			'seo_url',

			'url_alias',
		),
	);

	public function __construct($registry) {
		parent::__construct($registry);

		$this->load->model('journal3/import_export');
		$this->load->language('error/permission');
	}

	public function all() {
		try {
			$this->renderJson(self::SUCCESS, $this->model_journal3_import_export->all());
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function download() {
		try {
			$filename = $this->input(static::GET, 'filename');

			$file = DIR_SYSTEM . 'library/journal3/data/import_export/' . $filename;

			if (!headers_sent()) {
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="' . $filename . '"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));

				if (ob_get_level()) {
					ob_end_clean();
				}

				readfile($file, 'rb');

				exit;
			} else {
				throw new Exception('Error: Headers already sent out!');
			}
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function copy() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/import_export')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$filename = $this->input(static::GET, 'id');

			$file = DIR_SYSTEM . 'library/journal3/data/import_export/' . $filename;

			$this->renderJson(self::SUCCESS, $this->model_journal3_import_export->import($file));

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function remove() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/import_export')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$filename = $this->input(static::GET, 'id');

			$file = DIR_SYSTEM . 'library/journal3/data/import_export/' . $filename;

			unlink($file);

			$this->renderJson(self::SUCCESS);
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function export() {
		try {
			$tables = array();

			foreach (static::$TABLES as $key => $value) {
				if ($this->input(static::GET, $key, '') === 'true') {
					$tables = array_merge($tables, $value);
				}
			}

			$filename = $this->input(static::GET, 'filename', '');

			if ($filename) {
				if (!$this->user->hasPermission('modify', 'journal3/import_export')) {
					throw new Exception($this->language->get('text_permission'));
				}

				$file = DIR_SYSTEM . 'library/journal3/data/import_export/' . $filename . '.sql';

				if (is_file($file) && !$this->input(static::GET, 'overwrite', '')) {
					$this->renderJson(self::SUCCESS, array(
						'overwrite' => 'Filename already exists! Overwrite?',
					));
				} else {
					$sql = $this->model_journal3_import_export->export($tables);

					// safe copy old file
					if (is_file($file)) {
						rename($file, $file . '.old.' . date('Y-m-d_H-i-s', time()));
					}

					file_put_contents($file, $sql);

					$this->renderJson(self::SUCCESS);
				}
			} else {
				$filename = date('Y-m-d_H-i-s', time());

				$sql = $this->model_journal3_import_export->export($tables);

				if ($this->journal3->isOC2()) {
					$file = DIR_CACHE . $filename . '.sql';
				} else {
					$file = DIR_STORAGE . 'cache/' . $filename . '.sql';
				}

				file_put_contents($file, $sql);

				if (!headers_sent()) {
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="' . $filename . '.sql"');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));

					if (ob_get_level()) {
						ob_end_clean();
					}

					readfile($file, 'rb');

					unlink($file);

					exit;
				} else {
					throw new Exception('Error: Headers already sent out!');
				}
			}
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function import() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/import_export')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$file = $this->input(static::FILE, 'file');

			if ($file['error'] != UPLOAD_ERR_OK) {
				throw new Exception($this->language->get('error_upload_' . $file['error']));
			}

			$save = $this->input(static::GET, 'save', 'true');

			if ($save === 'true') {
				$f = DIR_SYSTEM . 'library/journal3/data/import_export/' . $file['name'];

				move_uploaded_file($file['tmp_name'], $f);

				$this->renderJson(self::SUCCESS);
			} else {
				$this->renderJson(self::SUCCESS, $this->model_journal3_import_export->import($file['tmp_name']));
			}

			$this->journal3->cache->delete();
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function check() {
		try {
			$params = array();

			foreach (static::$TABLES as $key => $value) {
				if ($this->input(static::GET, $key, '') === 'true') {
					$params[$key] = 'true';
				}
			}

			$this->renderJson(self::SUCCESS, $this->adminUrl('journal3/import_export/export', '&' . http_build_query($params)));
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

	public function download_item() {
		try {
			if (!$this->user->hasPermission('modify', 'journal3/import_export')) {
				throw new Exception($this->language->get('text_permission'));
			}

			$name = $this->input(static::GET, 'name');
			$type = $this->input(static::GET, 'type');
			$id = $this->input(static::GET, 'id');

			if (Str::startsWith($name, 'module')) {
				$sql = $this->model_journal3_import_export->exportTable('journal3_module', ' WHERE `module_id` = ' . (int)$id);
				$sql = str_replace("VALUES ('" . $id . "'", "VALUES (null", $sql);
			} else if (in_array($name, array('style', 'variable'))) {
				$sql = $this->model_journal3_import_export->exportTable('journal3_' . $name, ' WHERE `' . $name . '_name` = \'' . $this->db->escape($id) . '\' AND `' . $name . '_type` = \'' . $this->db->escape($type) . '\'');
			} else {
				throw new Exception('Error: Not implemented yet!');
			}

			$filename = date('Y-m-d_H-i-s', time());

			if ($this->journal3->isOC2()) {
				$file = DIR_CACHE . $filename . '.sql';
			} else {
				$file = DIR_STORAGE . 'cache/' . $filename . '.sql';
			}

			file_put_contents($file, $sql);

			if (!headers_sent()) {
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="' . $filename . '.sql"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));

				if (ob_get_level()) {
					ob_end_clean();
				}

				readfile($file, 'rb');

				unlink($file);

				exit;
			} else {
				throw new Exception('Error: Headers already sent out!');
			}
		} catch (Exception $e) {
			$this->renderJson(self::ERROR, $e->getMessage());
		}
	}

}
