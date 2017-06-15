<?php

require_once 'core.php';

if($_POST['airwaybill']) {
	$airwaybill = $_POST['airwaybill'];
	$carrierId = $_POST['carrierid'];
	$consigneeId;
	if(isset($_POST['consigneeid'])) {
		$consigneeId = $_POST['consigneeid'];
	}
	if(!empty($airwaybill)) {
		if(is_numeric($carrierId) && $carrierId >= 0) {
			$airwaybill = $connectionHandle->real_escape_string($airwaybill);
			$query = "SELECT `carrier_id`, `consignee_id` FROM `airwaybills` WHERE `airwaybill` = '$airwaybill' LIMIT 1;";
			if($result = $connectionHandle->query($query)) {
				if($result->num_rows == 1) {
					$row = $result->fetch_assoc();
					if($row['carrier_id'] == $carrierId) {
						$query = "UPDATE `airwaybills` SET `scan_quantity` = `scan_quantity` + 1 WHERE `airwaybills`.`airwaybill` = '$airwaybill';";
						$result = $connectionHandle->query($query);
					} else {
						$errorStr = 'This Air Way Bill is already in the database with the Carrier (' . getCarrierNameFromId($row['carrier_id']) . ')';
						if(!empty($row['consignee_id'])) {
							$errorStr .= ' and consignee ID (' . getConsigneeNameFromId($row['consignee_id']) . ')';
						}
						$errorStr .= '. Please re-check your Air Way Bill #!';
						echo json_encode($errorStr);
					}
				} else {
					$query = (!empty($consigneeId)) ? "INSERT IGNORE INTO `airwaybills` (`airwaybill`, `carrier_id`, `consignee_id`) VALUES ('$airwaybill', '$carrierId', '$consigneeId');" : "INSERT IGNORE INTO `airwaybills` (`airwaybill`, `carrier_id`) VALUES ('$airwaybill', '$carrierId');";
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
	echo json_encode('Please enter an Air Way Bill #.');
}

?>