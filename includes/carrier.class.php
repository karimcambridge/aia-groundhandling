<?php
class Carrier implements AIAGroundOpsTemplate
{
	private $carrierId;
	private $carrierName;

	function __construct($id, $name) {
		$this->_carrierId = $id;
		$this->_carrierName = $name;
	}

	public function getId() {
		return $this->_carrierId;
	}

	public function getName() {
		return $this->_carrierName;
	}
}
?>