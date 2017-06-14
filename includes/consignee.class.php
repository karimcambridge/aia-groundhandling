<?php
class Consignee implements AIAGroundOpsTemplate
{
	private $consigneeId;
	private $consigneeName;
	private $consigneeCarrierId;

	function __construct($id, $name, $carrierId) {
		$this->_consigneeId = $id;
		$this->_consigneeName = $name;
		$this->_consigneeCarrierId = $carrierId;
	}

	public function getId() {
		return $this->_consigneeId;
	}

	public function getName() {
		return $this->_consigneeName;
	}

	public function getCarrierId() {
		return $this->_consigneeCarrierId;
	}
}
?>