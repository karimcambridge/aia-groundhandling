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
	'item_weight' => "Item Weight"
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
	case "cargo-inventory":
		$query = "SELECT `". TABLE_CARGO_INVENTORY ."`.`ID`, `airwaybill`, `". TABLE_CARGO_ITEM_TYPES ."`.`cargo_type` AS `cargo_type`, `item_description`, `item_weight`, `date_in` FROM `". TABLE_CARGO_INVENTORY ."`, `". TABLE_CARGO_ITEM_TYPES ."` WHERE `". TABLE_CARGO_INVENTORY ."`.`cargo_type_id` = `". TABLE_CARGO_ITEM_TYPES ."`.`ID` AND `date_in` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "';"; // , `refrigerated_time`, `refrigerated_unix`
		break;
	case "cargo-processed":
		$query = "SELECT `". TABLE_CARGO_OUT ."`.`ID`, `airwaybill`, `". TABLE_CARGO_ITEM_TYPES ."`.`cargo_type` AS `cargo_type`, `item_description`, `item_weight`, `date_in`, `date_out`, `refrigerated_time` FROM `". TABLE_CARGO_OUT ."`, `". TABLE_CARGO_ITEM_TYPES ."` WHERE `". TABLE_CARGO_OUT ."`.`cargo_type_id` = `". TABLE_CARGO_ITEM_TYPES ."`.`ID` AND `date_in` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "';";
		break;
	case "air-way-bills":
		$query = "SELECT `". TABLE_AIRWAYBILLS ."`.`ID`, `airwaybill`, `". TABLE_CARRIERS ."`.`name` AS `carrier_name`, `". TABLE_CONSIGNEES ."`.`name` AS `consignee_name`, `date_in`, `scan_quantity`, `in_quantity`, `out_quantity` FROM `". TABLE_AIRWAYBILLS ."`, `". TABLE_CARRIERS ."`, `". TABLE_CONSIGNEES ."` WHERE `". TABLE_AIRWAYBILLS ."`.`carrier_id` = `". TABLE_CARRIERS ."`.`ID` AND `". TABLE_AIRWAYBILLS ."`.`consignee_id` = `". TABLE_CONSIGNEES ."`.`ID` AND `date_in` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "';";
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
						$flag = true;
					}
					$col = 'A';
					$rowId++;
					foreach($row as $key => $value) {
						$objPHPExcel->getActiveSheet()->SetCellValue($col.$rowId, $value);
						$col++;
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