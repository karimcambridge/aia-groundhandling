<?php

require_once '../core.php';

if($_POST) {
	$airwaybill = $_POST['air-way-bill-selection'];
	$item_datetime = $_POST['item-datetime'];
	$item_type = $_POST['item-type'];
	$item_description = $_POST['item-description'];
	$item_weight = $_POST['item-weight'];
	$item_weight_type = $_POST['item-weight-type'];

	$carrierId = -1;
	$itemTypeId = -1; // Cargo Type ID

	foreach($cargotypes as $cargotype) {
		if(strcmp($cargotype->getName(), $item_type) == 0) {
			$itemTypeId = $cargotype->getId();
		}
	}

	$sql = "SELECT COUNT(`airwaybill`) AS `airwaybillcount` FROM `cargo_inventory` WHERE `airwaybill` = '$airwaybill'";
	if($result = $connectionHandle->query($sql)) {
		if($result->num_rows) {
			$row = mysqli_fetch_assoc($result);
			$count = $row['airwaybillcount'];
			if($itemTypeId != -1) {
				$sql = "INSERT INTO `cargo_inventory` INSERT INTO `cargo_inventory`(`airwaybill`, `cargo_type_id`, `item_description`, `item_weight`, `date_in`, `state`, `count`) VALUES ('$airwaybill', '$cargo_type_id', '$item_description', '$item_weight', 1, '$count')";
				$result = $connectionHandle->query($sql);
				if($result->errno) {
					echo 'MySQL Airwaybill Error: ' . $result->error;
					timeRedirect(10);
				} else {
					$_SESSION['air-way-bill-selection'] = $airwaybill;
					instantRedirect();
				}
			} else {
				echo 'There was an error finding the selected carrier ID. Please tell the I.T guys!';
				timeRedirect(10);
			}
		}
	}
} else {
	echo 'POST FAILED!';
	timeRedirect(10);
}

?>