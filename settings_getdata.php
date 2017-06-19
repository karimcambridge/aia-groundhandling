<?php

require_once 'core.php';

if($_POST['getusers']) {
	$userlist = array();
	$query = "SELECT `accountid`, `username`, `level`, `can_be_altered` FROM `users`";
	if($result = $connectionHandle->query($query)) {
		while($row = $result->fetch_assoc()) {
			$userlist[] = $row['accountid'];
			$userlist[] = $row['username'];
			$userlist[] = $row['level'];
			$userlist[] = $row['can_be_altered'];
		}
	}
	if(!empty($userlist)) {
		echo json_encode($userlist);
	}
} else {
	echo json_encode('Error. Invalid post.');
}

?>