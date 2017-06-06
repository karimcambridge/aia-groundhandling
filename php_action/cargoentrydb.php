<?php

require_once 'core.php';

if($_POST) {
	$airbill = $_POST['cargoAirbill'];
	$carrier = $_POST['cargoEntryCarrier'];

	$sql = "INSERT INTO aircargo (`Airbill`, `Carrier`) VALUES ('$airbill', '$carrier')";

	if($connectionHandle->query($sql) == true) {
		$_SESSION['cargoEntryCarrier'] = $carrier;
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
		die();
	}
} else {
	echo 'POST FAILED!';
}

?>