<?php

require_once 'core.php';

$amerijet = 'Amerijet';
$valid['success'] =array('seccess' => false, 'messages' =>array());

if($_POST) {
	$amerijetcargo = $_POST['liatcargo'];

	$sql = "INSERT INTO aircargo (`Airbill`, `Carrier`) VALUES ('$liatcargo','$liat')";

	if($connect->query($sql) == true){
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";
	} else {
		$valid['success'] = false;
		$valid['messages'] ="ERROR WHILE ADDING CARGO";
	}
	$connect->close();

	echo json_encode($valid);
}

?>
