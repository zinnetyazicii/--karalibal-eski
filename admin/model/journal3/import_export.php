<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Str;

class ModelJournal3ImportExport extends Model {

	public function all($filters = array()) {
		$result = array();
		$count = 0;

		$files = glob(DIR_SYSTEM . 'library/journal3/data/import_export/*.sql');

		foreach ($files as $file) {
			$size = filesize($file);

			$i = 0;

			$suffix = array(
				'B',
				'KB',
				'MB',
				'GB',
				'TB',
				'PB',
				'EB',
				'ZB',
				'YB',
			);

			while (($size / 1024) > 1) {
				$size = $size / 1024;

				$i++;
			}

			$count++;

			$result[] = array(
				'id'   => $count,
				'name' => basename($file),
				'size' => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
			);
		}

		return array(
			'count' => $count,
			'items' => $result,
		);
	}

	public function export($tables) {
		$output = '';

		foreach ($tables as $table) {
			if ($this->dbTableExists($table)) {
				$output .= 'TRUNCATE TABLE `oc_' . $this->dbEscape($table) . '`;' . "\n\n";

				$output .= $this->exportTable($table);
			}
		}

		// active skin
		if (in_array('journal3_skin', $tables) && !in_array('journal3_setting', $tables)) {
			$output .= $this->exportTable('journal3_setting', " WHERE `setting_group` = 'active_skin'");
		}

		// blog settings
		if (in_array('journal3_blog_post', $tables) && !in_array('journal3_setting', $tables)) {
			$output .= $this->exportTable('journal3_setting', " WHERE `setting_group` = 'blog'");
		}

		return $output;
	}

	public function exportTable($table, $conditions = '') {
		$output = '';

		$query = $this->db->query("SELECT * FROM `" . $this->dbPrefix($table) . "`" . $conditions);

		foreach ($query->rows as $result) {
			$fields = '';

			foreach (array_keys($result) as $value) {
				$fields .= '`' . $value . '`, ';
			}

			$values = '';

			foreach (array_values($result) as $value) {
				$value = $this->escape($value);

				$values .= '\'' . $value . '\', ';
			}

			if ($table === 'journal3_variable') {
				$duplicate = ' ON DUPLICATE KEY UPDATE `variable_value` = ' . '\'' . $this->escape($result['variable_value']) . '\', `serialized` = ' . '\'' . $this->escape($result['serialized']) . '\'';
			} else if ($table === 'journal3_style') {
				$duplicate = ' ON DUPLICATE KEY UPDATE `style_value` = ' . '\'' . $this->escape($result['style_value']) . '\', `serialized` = ' . '\'' . $this->escape($result['serialized']) . '\'';
			} else if ($table === 'journal3_setting') {
				$duplicate = ' ON DUPLICATE KEY UPDATE `setting_value` = ' . '\'' . $this->escape($result['setting_value']) . '\', `serialized` = ' . '\'' . $this->escape($result['serialized']) . '\'';
			} else {
				$duplicate = '';
			}

			$output .= 'INSERT INTO `oc_' . $this->dbEscape($table) . '` (' . preg_replace('/, $/', '', $fields) . ') VALUES (' . preg_replace('/, $/', '', $values) . ')' . $duplicate . ';' . "\n";
		}

		$output .= "\n\n";

		return $output;
	}

	public function import($file) {
		$content = file_get_contents($file);

		foreach (explode(";\n", $content) as $sql) {
			$sql = trim($sql);

			if ($sql) {
				$sql = str_replace('`oc_', '`' . DB_PREFIX, $sql);

				if ($this->journal3->isOC2()) {
					if (Str::contains($sql, $this->dbPrefix('seo_url'))) {
						continue;
					}
				} else {
					if (Str::contains($sql, $this->dbPrefix('url_alias'))) {
						continue;
					}
				}

				$this->db->query($sql);
			}
		}
	}

	private function escape($value) {
		$value = str_replace(array("\x00", "\x0a", "\x0d", "\x1a"), array('\0', '\n', '\r', '\Z'), $value);
		$value = str_replace(array("\n", "\r", "\t"), array('\n', '\r', '\t'), $value);
		$value = str_replace('\\', '\\\\', $value);
		$value = str_replace('\'', '\\\'', $value);
		$value = str_replace('\\\n', '\n', $value);
		$value = str_replace('\\\r', '\r', $value);
		$value = str_replace('\\\t', '\t', $value);

//		if (strpos($prefixed_table, DB_PREFIX . 'journal3') === 0) {
//			$value = str_replace('\n', '\\\n', $value);
//			$value = str_replace('\t', '\\\t', $value);
//		}

		return $value;
	}

}
