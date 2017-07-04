<?php
class ConsigneeType implements AIAGroundHandlingTemplate
{
	private $consigneeTypeId;
	private $consigneeTypeName;
	private $consigneeExempted;

	function __construct($id, $name, $exempted) {
		$this->_consigneeTypeId = $id;
		$this->_consigneeTypeName = $name;
		$this->_consigneeExempted = $exempted;
	}

	public function getId() {
		return $this->_consigneeTypeId;
	}

	public function getName() {
		return $this->_consigneeTypeName;
	}

	public function getExemptionStatus() {
		return $this->_consigneeExempted;
	}
}
?>