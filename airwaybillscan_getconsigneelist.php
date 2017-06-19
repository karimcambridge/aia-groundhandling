<?php
require_once 'core.php';

if($_POST['carrierid']) {
	$carrierid = $_POST['carrierid'];
	
	if(!empty($carrierid)) {
		$consigneelist = array();
		foreach($consignees as $consignee) {
			if($consignee->getCarrierId() == $carrierid) {
				$consigneelist[] = $consignee->getId();
				$consigneelist[] = $consignee->getName();
			}
		}
		if(!empty($consigneelist)) {
			echo json_encode($consigneelist);
		}
	} else {
		echo json_encode('There was an error posting the selected carrier ID. Please report this to I.T.');
	}
} else {
	echo json_encode('Please enter a Carrier from the DropDown List.');
}

?>