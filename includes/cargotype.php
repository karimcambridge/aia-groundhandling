<?php
class CargoType
{
	private $cargoTypeId;
	private $cargoTypeName;

	function __construct($id, $name) {
		$this->_cargoTypeId = $id;
		$this->_cargoTypeName = $name;
	}

	public function getCargoTypeId() {
		return $this->_cargoTypeId;
	}

	public function getCargoTypeName() {
		return $this->_cargoTypeName;
	}
}
?>