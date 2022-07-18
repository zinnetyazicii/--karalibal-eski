<?php

use Journal3\Opencart\Model;

class ModelJournal3Newsletter extends Model {

	public function isSubscribed($email) {
		$sql = "
			SELECT COUNT(*) AS total
			FROM `{$this->dbPrefix('journal3_newsletter')}`
			WHERE email = '{$this->dbEscape($email)}'
		";

		return $this->dbQuery($sql)->row['total'] > 0;
	}

	public function subscribe($email, $name = '') {
		$query = $this->db->query("DESCRIBE `{$this->dbPrefix('journal3_newsletter')}`");

		$found = false;

		foreach ($query->rows as $row) {
			if ($row['Field'] === 'ip') {
				$found = true;
				break;
			}
		}

		if (!$found) {
			$this->db->query("
				ALTER TABLE `{$this->dbPrefix('journal3_newsletter')}`
				ADD `ip` VARCHAR(40) NOT NULL AFTER `email`
			");
		}

		$sql = "
			INSERT INTO `{$this->dbPrefix('journal3_newsletter')}` (
				name,
				email,
				ip,
				store_id
			) VALUES (
				'{$this->dbEscape($name)}',
				'{$this->dbEscape($email)}',
				'{$this->dbEscape($this->request->server['REMOTE_ADDR'])}',
				'{$this->dbEscapeInt($this->config->get('config_store_id'))}'
			)
		";

		return $this->dbQuery($sql);
	}

	public function unsubscribe($email) {
		$this->dbQuery("DELETE FROM `{$this->dbPrefix('journal3_newsletter')}` WHERE email = '{$this->dbEscape($email)}'");
	}

}
