<?php require_once 'core.php';?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AIA Ground Ops</title>

    <!-- bootstrap-->
    <link rel="stylesheet" href="assets/bootstrap-4.0.0-alpha.6/css/bootstrap.min.css">

    <!-- FontAwesome css -->
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Custom css -->
    <link rel="stylesheet" href="custom/css/custom.css">

    <!-- jquery v3.2.1 -->
    <script src="assets/jquery/jquery.min.js"></script>

    <!-- tether 1.3.3 -->
    <script src="assets/tether-1.3.3/js/tether.min.js"></script>

    <!-- Bootstrap v4-alhpa.6 js -->
    <script src="assets/bootstrap-4.0.0-alpha.6/js/bootstrap.min.js"></script>

  </head>
  <body>
  <nav class="navbar navbar-inverse bg-inverse sticky-top navbar-toggleable-md navbar-full">
    <a class="navbar-brand" href="index.php">Ground Operations</a>
    <div class="collapse navbar-collapse" id="groundopsNavBar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="index.php"><span class="fa fa-home"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="cargoinventory.php">Cargo Inventory <span class="fa fa-search"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="airwaybillscan.php">AirWayBill Entry <span class="fa fa-briefcase"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="cargoinsert.php">Insert Cargo <span class="fa fa-floppy-o"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="cargofees.php">Cargo Fees <span class="fa fa-eur"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="servicefees.php">Services Fees <span class="fa fa-usd"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="reports.php"><strong>Reports</strong> <span class="fa fa-folder-open"></span></a></li>
        <li class="nav-item dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-user"></span><span class=  "caret"></span></a>
          <ul class="dropdown-menu">
            <li class="dropdown-item" id="topNavlogout"><a href="logout.php"><span class="fa fa-sign-out"> Logout</span></a></li>
            <li class="dropdown-divider" role="separator"></li>
            <li class="dropdown-item" id="topNavsettings"><a href="settings.php"><span class="fa fa-cog"> Settings</span></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>