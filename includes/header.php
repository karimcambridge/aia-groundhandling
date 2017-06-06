<?php require_once 'php_action/core.php';?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>GroundOPS System</title>

    <!-- bootstrap-->
    <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">

    <!-- bootstrap theme -->
    <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

    <!--custom css -->
    <link rel="stylesheet" href="custom/css/custom.css">

    <!-- dataTables
    <script src="assests/plugins/datatables/datatables.min.css"></script> -->

    <!-- file input
    <script src="assests/plugins/fileinput/css/fileinput.min.css"></script> -->

    <!-- jquery -->
    <script src="assests/jquery/jquery.min.js"></script>

    <!-- jquery -->
    <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
    <script src="assests/jquery-ui/jquery-ui.min.js"></script>

    <!--bootstrap js-->
    <script src="assests/bootstrap/js/bootstrap.min.js"></script>

  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top"">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">GroundOPS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="index.php"><span class="glyphicon glyphicon-home "></span></a></li>
            <li><a href="cargoinventory.php"><strong>View Cargo </strong><span class="glyphicon glyphicon-search "></span></a></li>
            <li><a href="cargoentry.php">Airbill Entry <span class="glyphicon glyphicon-briefcase"></span></a></li>
				    <li><a href="checkoutcargo.php">Check Out Cargo <span class="glyphicon glyphicon-plane"></span></a></li>
            <li><a href="cargofees.php">Cargo Fees <span class="glyphicon glyphicon-eur"></span></a></li>
			      <li><a href="servicefees.php">Services Fees <span class="glyphicon glyphicon-usd"></span></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
			     <li id="navDashboard"><a href="report.php"><strong>Reports</strong> <span class="glyphicon glyphicon-folder-open"></span></a></li>
		        <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li id="topNavlogout"><a href="logout.php"><span class="glyphicon glyphicon-log-out"> Logout</span></a></li>
                <li role="separator" class="divider"></li>
                <li id="topNavsettings"><a href="settings.php"><span class="glyphicon glyphicon-cog"> Settings</span></a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>