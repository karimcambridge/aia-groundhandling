<?php
class AirWayBill implements AIAGroundOpsTemplate
{
	private $airWayBillId;
	private $airWayBillName;
	private $airWayBillCarrier;
	private $airWayBillDateIn;

	function __construct($id, $name, $carrier) {
		$this->_airWayBillId = $id;
		$this->_airWayBillName = $name;
		$this->_airWayBillCarrier = $carrier;
	}

	public function getId() {
		return $this->_airWayBillId;
	}

	public function getName() {
		return $this->_airWayBillName;
	}

	public function getCarrier() {
		return $this->airWayBillCarrier;
	}

	public function getDateIn() {
		return $this->airWayBillDateIn;
	}
}
?>