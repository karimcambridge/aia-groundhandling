<?php

require_once 'core.php';

echo 'echoing list?';
if($_POST['carrierid']) {
	$carrierid = $_POST['carrierid'];
	
	echo 'echoing list ' . $carrierid;

	if(!empty($carrierid)) {
		$consigneelist = array();
		foreach($consignees as $consignee) {
			if($consignee->getCarrierId() == $carrierid) {
				$consigneelist[] = $consignee->getId();
			}
		}
		if(!empty($consigneelist)) {
			echo json_encode($consigneelist);
		}
	} else {
		echo json_encode('There was an error posting the selected carrierid ID. Please tell the I.T guys!');
	}
} else {
	echo json_encode('POST FAILED!');
}

?>