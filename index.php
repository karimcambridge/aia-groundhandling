<?php
require_once 'php_action/sql_config.php';

session_start();

if(isset($_SESSION['accountId'])) {
	header('location:http://127.00.1/groundopps/dashboard.php');
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
					// set session
					if(!isset($_SESSION['accountId'])) {
						$value = $loginResult->fetch_assoc();
						$user_id = $value['accountid'];
						$_SESSION['accountId'] = $user_id;
					}
					header('location: http://127.0.0.1/groundopps/dashboard.php');
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
<html>
<head>
	<title>AIA Ground OPS System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row vertical">
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign in here</h3>
					</div>
					<div class="panel-body">
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
									<label for="username" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<!-- panel-body -->
				</div>
				<!-- /panel -->
			</div>
			<!-- /col-md-4 -->
		</div>
		<!-- /row -->
	</div>
	<!-- container -->
</body>
</html>
