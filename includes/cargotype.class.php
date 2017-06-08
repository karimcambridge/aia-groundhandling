<?php
class CargoType implements template
{
	private $cargoTypeId;
	private $cargoTypeName;

	function __construct($id, $name) {
		$this->_cargoTypeId = $id;
		$this->_cargoTypeName = $name;
	}

	public function getId() {
		return $this->_cargoTypeId;
	}

	public function getName() {
		return $this->_cargoTypeName;
	}
}
?>