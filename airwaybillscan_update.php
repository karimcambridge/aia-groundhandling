<?php

require_once 'core.php';

if($_POST['airwaybill']) {
	$airwaybill = $_POST['airwaybill'];
	$carrierId = $_POST['carrierid'];

	if(!empty($airwaybill)) {
		if(is_numeric($carrierId) && $carrierId >= 0) {
			$airwaybill = $connectionHandle->real_escape_string($airwaybill);
			$query = "SELECT NULL FROM `airwaybills` WHERE `airwaybill` = '$airwaybill' LIMIT 1;";
			if($result = $connectionHandle->query($query)) {
				if($result->num_rows == 1) {
					$query = "UPDATE `airwaybills` SET `scan_quantity` = `scan_quantity` + 1 WHERE `airwaybills`.`airwaybill` = '$airwaybill';";
					$result = $connectionHandle->query($query);
				} else {
					$query = "INSERT IGNORE INTO `airwaybills` (`airwaybill`, `carrier_id`) VALUES ('$airwaybill', '$carrierId');";
					$result = $connectionHandle->query($query);
				}
			}
			else if($connectionHandle->errno) {
				echo json_encode('MySQL Airwaybill Error: ' . $connectionHandle->error);
			}
		} else {
			echo json_encode('There was an error finding the selected carrier ID (' . $carrierId . '). Please tell the I.T guys!');
		}
	} else {
		echo json_encode('There was an error posting the selected AirWayBill ID. Please tell the I.T guys!');
	}
} else {
	echo json_encode('POST FAILED!');
}

?>