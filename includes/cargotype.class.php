<?php
class CargoType implements AIAGroundOpsTemplate
{
	private $cargoTypeId;
	private $cargoTypeName;
	private $cargoTypePricePerKg;

	function __construct($id, $name, $price_per_kg) {
		$this->_cargoTypeId = $id;
		$this->_cargoTypeName = $name;
		$this->_cargoTypePricePerKg = $price_per_kg;
	}

	public function getId() {
		return $this->_cargoTypeId;
	}

	public function getName() {
		return $this->_cargoTypeName;
	}

	public function getPricePerKg() {
		return $this->_cargoTypePricePerKg;
	}
}
?>