<?php

require_once 'core.php';
$liat='LIAT';
$valid['success'] =array('seccess' => false, 'messages' =>array());

if($_POST){
	
	$liatcargo= $_POST['liatcargo'];

$sql = "INSERT INTO aircargo (Airbill,Carrier ) VALUES ('$liatcargo','$liat')";

if($connect->query($sql) == TRUE){
			$valid['success'] = true;
		    $valid['messges'] = "Successfully Added";
		}else{
			$valid['success'] = false;
			$valid['messages'] ="ERROR  WHILE ADDING CARGO";
		}
$connect->close();

echo json_encode($valid);
	
}//  / if $post



?>