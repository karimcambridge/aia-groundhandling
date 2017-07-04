<?php
class Account implements AIAGroundHandlingTemplate
{
	private $accountId;
	private $accountName;

	function __construct($id, $name) {
		$this->_accountId = $id;
		$this->_accountName = $name;
	}

	public function getId() {
		return $this->_accountId;
	}

	public function getName() {
		return $this->_accountName;
	}
}
?>