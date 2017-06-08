<?php
class AirWayBill implements AIAGroundOpsTemplate
{
	private $airWayBillId;
	private $airWayBillName;
	private $airWayBillCarrier;
	private $airWayBillDateIn;

	function __construct($id, $name, $carrier, $dateIn) {
		$this->_airWayBillId = $id;
		$this->_airWayBillName = $name;
		$this->_airWayBillCarrier = $carrier;
		$this->_airWayBillDateIn = $dateIn;
	}

	public function getId() {
		return $this->_airWayBillId;
	}

	public function getName() {
		return $this->_airWayBillName;
	}

	public function getCarrier() {
		return $this->_airWayBillCarrier;
	}

	public function getDateIn() {
		return $this->_airWayBillDateIn;
	}
}
?>