<?php
class AirWayBill implements AIAGroundHandlingTemplate
{
	private $airWayBillId;
	private $airWayBillName;
	private $airWayBillCarrier;
	private $airWayBillConsignee;
	private $airWayBillDateIn;
	private $airWayBillDateInTimestamp;

	function __construct($id, $name, $carrier, $consignee, $dateIn, $dateInTimestamp) {
		$this->_airWayBillId = $id;
		$this->_airWayBillName = $name;
		$this->_airWayBillCarrier = $carrier;
		$this->_airWayBillConsignee = $consignee;
		$this->_airWayBillDateIn = $dateIn;
		$this->_airWayBillDateInTimestamp = $dateInTimestamp;
	}

	public function getId() {
		return $this->_airWayBillId;
	}

	public function getName() {
		return $this->_airWayBillName;
	}

	public function getCarrierId() {
		return $this->_airWayBillCarrier;
	}

	public function getConsigneeId() {
		return $this->_airWayBillConsignee;
	}

	public function getDateIn() {
		return $this->_airWayBillDateIn;
	}

	public function getDateInTimestamp() {
		return $this->_airWayBillDateInTimestamp;
	}
}
?>