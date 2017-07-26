<?php
require_once 'core.php';

if($_POST['airwaybill']) {
	$airwaybill = $_POST['airwaybill'];
	$carrierId = $_POST['carrierid'];
	$consigneeId;
	if(isset($_POST['consigneeid'])) {
		$consigneeId = $_POST['consigneeid'];
	}
	$consigneeTypeId = $_POST['consigneetypeid'];
	if(!empty($airwaybill)) {
		if(is_numeric($carrierId) && $carrierId >= 0) {
			$airwaybill = $connectionHandle->real_escape_string($airwaybill);
			$query = "SELECT `carrier_id`, `consignee_id` FROM `" . TABLE_AIRWAYBILLS . "` WHERE `airwaybill` = '$airwaybill' LIMIT 1;";
			if($result = $connectionHandle->query($query)) {
				if($result->num_rows == 1) {
					$row = $result->fetch_assoc();
					if($row['carrier_id'] == $carrierId) {
						$query = "UPDATE `" . TABLE_AIRWAYBILLS . "` SET `scan_quantity` = `scan_quantity` + 1 WHERE `" . TABLE_AIRWAYBILLS . "`.`airwaybill` = '$airwaybill';";
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
					$query = (!empty($consigneeId)) ? "INSERT IGNORE INTO `" . TABLE_AIRWAYBILLS . "` (`airwaybill`, `carrier_id`, `consignee_id`, `consignee_type_id`) VALUES ('$airwaybill', '$carrierId', '$consigneeId', '$consigneeTypeId');" : "INSERT IGNORE INTO `" . TABLE_AIRWAYBILLS . "` (`airwaybill`, `carrier_id`, `consignee_type_id`) VALUES ('$airwaybill', '$carrierId', '$consigneeTypeId');";
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