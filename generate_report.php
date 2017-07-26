<?php

require_once 'core.php';

$reportType = "";

if(isset($_POST['reportGenerateExcelBtn'])) {
	$reportType = "XLSX";
}
else if(isset($_POST['reportGenerateExcelCsvBtn'])) {
	$reportType = "CSV";
} else {
	exit();
}

$downloadFileName;
$dateStart;
$dateEnd;
$query;

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
	'item_description' => "Item Description",
	'item_weight' => "Item Weight",
	'refrigerated_time' => "Time Refrigerated (Sec)",
	'consignee_type_name' => "Consignee Type"
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
    //if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) { uncomment this if excel starts messing around with formatted numbers (dates, phone numbers etc)
    //  $str = "'$str";
    //}
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    $str = mb_convert_encoding($str, "UTF-8", "auto");
}

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
	case "air-way-bills":
		$query = "SELECT `". TABLE_AIRWAYBILLS ."`.`ID`, `airwaybill`, `". TABLE_CARRIERS ."`.`name` AS `carrier_name`, `". TABLE_CONSIGNEES ."`.`name` AS `consignee_name`, `date_in`, `scan_quantity`, `in_quantity`, `out_quantity` FROM `". TABLE_AIRWAYBILLS ."`, `". TABLE_CARRIERS ."`, `". TABLE_CONSIGNEES ."` WHERE `". TABLE_AIRWAYBILLS ."`.`carrier_id` = `". TABLE_CARRIERS ."`.`ID` AND `". TABLE_AIRWAYBILLS ."`.`consignee_id` = `". TABLE_CONSIGNEES ."`.`ID` AND `date_in` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "';";
		break;
	case "cargo-inventory":
		$query = "SELECT `". TABLE_CARGO_INVENTORY ."`.`ID`, `". TABLE_CARGO_INVENTORY ."`.`airwaybill`, `". TABLE_CARGO_ITEM_TYPES ."`.`cargo_type` AS `cargo_type`, `". TABLE_CONSIGNEE_TYPES ."`.`consignee_type_name`, `item_description`, `item_weight`, `". TABLE_CARGO_INVENTORY ."`.`date_in`, `refrigerated_time` FROM `". TABLE_CARGO_INVENTORY ."`, `". TABLE_CARGO_ITEM_TYPES ."`, `". TABLE_CONSIGNEE_TYPES ."` WHERE `". TABLE_CARGO_INVENTORY ."`.`cargo_type_id` = `". TABLE_CARGO_ITEM_TYPES ."`.`ID` AND `". TABLE_CARGO_INVENTORY ."`.`consignee_type_id` = `". TABLE_CONSIGNEE_TYPES ."`.`ID` AND `". TABLE_CARGO_INVENTORY ."`.`date_in` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "';";
		break;
	case "cargo-processed":
		$query = "SELECT `". TABLE_CARGO_OUT ."`.`ID`, `". TABLE_CARGO_OUT ."`.`airwaybill`, `". TABLE_CARGO_ITEM_TYPES ."`.`cargo_type` AS `cargo_type`, `". TABLE_CONSIGNEE_TYPES ."`.`consignee_type_name`, `item_description`, `item_weight`, `". TABLE_CARGO_OUT ."`.`date_in`, `". TABLE_CARGO_OUT ."`.`date_out`, `refrigerated_time` FROM `". TABLE_CARGO_OUT ."`, `". TABLE_CARGO_ITEM_TYPES ."`, `". TABLE_CONSIGNEE_TYPES ."` WHERE `". TABLE_CARGO_OUT ."`.`cargo_type_id` = `". TABLE_CARGO_ITEM_TYPES ."`.`ID` AND `". TABLE_CARGO_OUT ."`.`consignee_type_id` = `". TABLE_CONSIGNEE_TYPES ."`.`ID` AND `". TABLE_CARGO_OUT ."`.`date_in` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "';";
		echo $query;
		break;
	case "carriers";
		$query = "SELECT * FROM `". TABLE_CARRIERS ."`";
		break;
	case "consignees";
		$query = "SELECT * FROM `". TABLE_CONSIGNEES ."`";
		break;
}

if(!empty($query)) {
	$flag = false;
	$result = $connectionHandle->query($query) or die('Query failed!');

	if($result->num_rows == 0) {
		header("location: reports.php?error=nodata&datestart=" . $dateStart . "&dateend=" . $dateEnd);
	} else {
		switch($reportType)
		{
			case "CSV": {
				logEvent($_SESSION['accountId'], EVENT_LOG_REPORT_CREATE_CSV, $downloadFileName);

				$filename = $downloadFileName . "_" . date('Ymd H:m:s') . ".csv";

				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: text/csv; charset=UTF-8");
				header('Cache-Control: max-age=0');

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
				break;
			}
			default: { // XLSX
				logEvent($_SESSION['accountId'], EVENT_LOG_REPORT_CREATE_EXCEL, $downloadFileName);
				ob_end_clean();

				$filename = $downloadFileName . "_" . date('Ymd H:m:s') . ".xlsx";
				$col = 'A';
				$rowId = 1;
				$flag = false;
				$objPHPExcel = new PHPExcel();

				$objPHPExcel->getProperties()->setCreator($_SESSION['accountUsername']);
				$objPHPExcel->getProperties()->setLastModifiedBy($_SESSION['accountUsername']);
				$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX");
				$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX");
				$objPHPExcel->getProperties()->setDescription("AIA Ground Handling document for Office 2007 XLSX, generated using PHP classes.");

				$objPHPExcel->setActiveSheetIndex(0);
				while($row = $result->fetch_assoc()) {
					if($flag == false) {
						foreach($row as $key => $value) {
							$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowId, map_colnames($key));
							$col++;
						}
						switch($downloadFileName)
						{
							case "air-way-bills":
							case "cargo-inventory":
							case "cargo-processed":
								$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowId, map_colnames("Checkout Levy"));
								$col++;
								break;
						}
						$flag = true;
					}
					$col = 'A';
					$rowId++;
					foreach($row as $key => $value) {
						$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowId, $value);
						$col++;
					}
					switch($downloadFileName)
					{
						case "air-way-bills":
							$airwaybillEx = getAirWayBill($row['airwaybill']);
							if($airwaybillEx != NULL) {
								$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowId, calculateAirWayBillCheckoutFee($airwaybillEx->getName(), "out"));
								$col++;
							}
							break;
						case "cargo-inventory":
						case "cargo-processed":
							$airwaybillEx = getAirWayBill($row['airwaybill']);
							if($airwaybillEx != NULL) {
								$itemDateUnix = strtotime($airwaybillEx->getDateIn());
								$itemDays = number_of_cargo_days(date('Y-m-d', $itemDateUnix), date('Y-m-d'));
								$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowId, calculateCheckoutFee($itemDays, $row['consignee_type_name'], $row['item_weight'], $row['cargo_type'], $row['refrigerated_time']));
								$col++;
							}
							break;
					}
				}
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
				header('Cache-Control: max-age=0');
				$objWriter->save('php://output'); //str_replace('.php', '.xlsx', __FILE__));
			}
		}
	}
} else {
	header("location: reports.php?error=nonexistantreport");
}
exit();

?>