<?php
class Carrier
{
	private $carrierId;
	private $carrierName;

	function __construct($id, $name) {
		$this->_carrierId = $id;
		$this->_carrierName = $name;
	}

	public function getCarrierId() {
		return $this->_carrierId;
	}

	public function getCarrierName() {
		return $this->_carrierName;
	}
}
?>