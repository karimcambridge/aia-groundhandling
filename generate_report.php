<?php
require_once 'core.php';

$colnames = [
	'ID' => "Auto Generated ID",
	'name' => "Name",
	'carrier_id' => "Carrier ID",
	'airwaybill' => "Air Way Bill",
	'Item Description' => "Air Way Bill",
	'date_in' => "Date In",
	'date_out' => "Date Out",
	'price_KG' => "Price (KG)",
	'cargo_type' => "Cargo Type",
	'carrier_name' => "Carrier Name",
	'consignee_name' => "Consignee Name",
	'scan_quantity' => "Scanned Items",
	'in_quantity' => "Items In Inventory",
	'out_quantity' => "Items Processed",
];

function map_colnames($input)
{
	global $colnames;
	return isset($colnames[$input]) ? $colnames[$input] : $input;
}

function cleanData(&$str)
{
    if($str == 't') $str = 'TRUE';
    if($str == 'f') $str = 'FALSE';
    if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
      $str = "'$str";
    }
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    $str = mb_convert_encoding($str, "UTF-8", "auto");
}

$downloadFileName;
$dateStart;
$dateEnd;
$query;

foreach($_POST as $key => $value) {
	switch($key)
	{
		case "date-start":
			$dateStart = $value;
			break;
		case "date-end":
			$dateEnd = $value;
			break;
		case "reportType":
			$downloadFileName = $value;
			break;
	}
}

switch($downloadFileName)
{
	case "cargo-inventory":
		$query = "SELECT `cargo_inventory`.`ID`, `airwaybill`, `cargo_item_types`.`cargo_type` AS `cargo_type`, `item_description`, `item_weight`, `date_in` FROM `cargo_inventory`, `cargo_item_types` WHERE `cargo_inventory`.`cargo_type_id` = `cargo_item_types`.`ID` AND `date_in` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "';"; // , `refrigerated_time`, `refrigerated_unix`
		break;
	case "cargo-processed":
		$query = "SELECT `cargo_out`.`ID`, `airwaybill`, `cargo_item_types`.`cargo_type` AS `cargo_type`, `item_description`, `item_weight`, `date_in`, `date_out`, `refrigerated_time` FROM `cargo_out`, `cargo_item_types` WHERE `cargo_out`.`cargo_type_id` = `cargo_item_types`.`ID` AND `date_in` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "';";
		break;
	case "air-way-bills":
		$query = "SELECT `airwaybills`.`ID`, `airwaybill`, `carriers`.`name` AS `carrier_name`, `consignees`.`name` AS `consignee_name`, `date_in`, `scan_quantity`, `in_quantity`, `out_quantity` FROM `airwaybills`, `carriers`, `consignees` WHERE `airwaybills`.`carrier_id` = `carriers`.`ID` AND `airwaybills`.`consignee_id` = `consignees`.`ID` AND `date_in` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "';";
		break;
	case "carriers";
		$query = "SELECT * FROM `carriers`";
		break;
	case "consignees";
		$query = "SELECT * FROM `consignees`";
		break;
}

if(!empty($query)) {
	$flag = false;
	$result = $connectionHandle->query($query) or die('Query failed!');

	if($result->num_rows == 0) {
		header("location: reports.php?error=nodata&datestart=" . $dateStart . "&dateend=" . $dateEnd);
	} else {
		$filename = $downloadFileName . "_" . date('Ymd H:m:s') . ".csv";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: text/csv; charset=UTF-8");
		header("Content-Type: application/force-download");

		$out = fopen("php://output", 'w');
		while($row = $result->fetch_assoc()) {
			if(!$flag) {
				// display field/column names as first row
				$firstline = array_map(__NAMESPACE__ . '\map_colnames', array_keys($row));
				fputcsv($out, $firstline, ',', '"');
				$flag = true;
			}
			array_walk($row, __NAMESPACE__ . '\cleanData');
			fputcsv($out, array_values($row), ',', '"');
		}
		fclose($out);
	}
} else {
	header("location: reports.php?error=nonexistantreport");
}
exit;

?>