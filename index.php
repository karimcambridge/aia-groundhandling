<?php

require_once 'core.php';

if(isset($_SESSION['accountId'])) {
	header('location:' . FILE_DASHBOARD);
	die();
} else {
	$errors = array();

	if(!empty($_POST)) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(empty($username) || empty($password)) {
			if($username == "") {
				$errors[] = "Username is required";
			}
			if($password == "") {
				$errors[] = "Password is required";
			}
		} else {
			$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
			$result = $connectionHandle->query($sql);

			if($result->num_rows == 1) {
				$password = $password;

				$loginSql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
				$loginResult = $connectionHandle->query($loginSql);

				if($loginResult->num_rows == 1) {
					if(!isset($_SESSION['accountId'])) {
						$value = $loginResult->fetch_assoc();
						$user = new User($value['accountid']);
						$_SESSION['accountId'] = $value['accountid'];
					}
					header('location:' . FILE_DASHBOARD);
				} else{
					$errors[] = "Incorrect username/password combination";
				} // else
			} else {
				$errors[] = "Username does not exists";
			} // else
		} // else not empty username // password
	} // if $_POST
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIA Ground Handling Web System</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap-4.0.0-alpha.6/css/bootstrap.min.css">

    <!-- FontAwesome css -->
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="custom/css/custom.css">

    <!-- jquery -->
    <script src="assets/jquery/jquery.min.js"></script>

    <!-- tether -->
    <script src="assets/tether-1.3.3/js/tether.min.js"></script>

    <!-- Bootstrap js -->
    <script src="assets/bootstrap-4.0.0-alpha.6/js/bootstrap.min.js"></script>
    
    <!-- Bootstrap notify js -->
    <script src="assets/bootstrap-notify-3.1.3/bootstrap-notify.min.js"></script>
</head>
<body style="background-color: #2A2A2A">
	<div class="text-center">
		<img src="assets/images/brand/AIA_GroundHandling_Logo_NoBackground_white_v1.png" alt="">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title mb-0">Please Sign in:</h3>
					</div>
					<div class="card-block">
						<?php
        				  if($errors) {
        				    echo '<div class="messages">';
        				    foreach ($errors as $key => $value) {
        				      echo '<div class="alert alert-danger" role="alert">
        				      <span class="glyphicon glyphicon-exclamation-sign"></span>
        				      '.$value.'</div>';
        				    }
        				    echo '</div>';
        				  }
        				?>
						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group">
									<tag for="username" class="col-sm-12 form-control-label">Username</tag>
									<div class="col-sm-12">
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<tag for="password" class="col-sm-12 form-control-label">Password</tag>
									<div class="col-sm-12">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>
								<div class="form-group mb-0">
									<div class="col-sm-12 text-center">
									  <button type="submit" class="btn btn-secondary"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
