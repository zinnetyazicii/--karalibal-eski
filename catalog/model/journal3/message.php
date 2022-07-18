<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;

class ModelJournal3Message extends Model {

	public function addMessage($data) {
		$name = Arr::get($data, 'name', '');
		$email = Arr::get($data, 'email', '');
		$fields = Arr::get($data, 'items', array());
		$url = Arr::get($data, 'url', '');

		$sql = "
            INSERT INTO `{$this->dbPrefix('journal3_message')}` (
            	name,
            	email,
            	fields,
            	store_id,
            	url,
            	date
			) VALUES (
				'{$this->dbEscape($name)}',
				'{$this->dbEscape($email)}',
				'{$this->dbEscape($this->encode($fields, true))}',
				'{$this->dbEscapeInt($this->config->get('config_store_id'))}',
				'{$this->dbEscape($url)}',
				NOW()
			)
        ";

		$this->db->query($sql);
	}

}
