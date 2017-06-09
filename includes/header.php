<?php require_once 'core.php';?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIA Ground Ops</title>

    <!-- bootstrap-->
    <link rel="stylesheet" href="assets/bootstrap-4.0.0-alpha.6/css/bootstrap.min.css">

    <!--custom css -->
    <link rel="stylesheet" href="custom/css/custom.css">

    <!-- jquery v3.2.1 -->
    <script src="assets/jquery/jquery.min.js"></script>

    <!-- tether 1.3.3 -->
    <script src="assets/tether-1.3.3/js/tether.min.js"></script>

    <!--bootstrap v4-alhpa.6 js-->
    <script src="assets/bootstrap-4.0.0-alpha.6/js/bootstrap.min.js"></script>

  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top"">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">Ground Operations</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
            <li><a href="cargoinventory.php">Cargo Inventory <span class="glyphicon glyphicon-search"></span></a></li>
            <li><a href="airwaybillscan.php">AirWayBill Entry <span class="glyphicon glyphicon-briefcase"></span></a></li>
            <li><a href="cargoinsert.php">Insert Cargo <span class="glyphicon glyphicon-floppy-save"></span></a></li>
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