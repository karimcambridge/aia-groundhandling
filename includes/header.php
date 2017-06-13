<?php require_once 'core.php';?>

<!DOCTYPE html>
<html lang="en">
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
    <a class="navbar-brand" href="#"><img src="assets/images/brand/AIA_Logo_NoBackground_v1.png" width="80" height="40" alt=""> Ground Operations <small>beta</small></a>
    <div class="collapse navbar-collapse justify-content-end" id="groundopsNavBar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a class="nav-link" href="index.php"><span class="fa fa-home"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="cargoinventory.php">Cargo Inventory <span class="fa fa-search"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="airwaybillscan.php">AirWayBill Entry <span class="fa fa-briefcase"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="cargoinsert.php">Insert Cargo <span class="fa fa-floppy-o"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="cargofees.php">Cargo Fees <span class="fa fa-eur"></span></a></li>
        <li class="nav-item"><a class="nav-link" href="servicefees.php">Services Fees <span class="fa fa-usd"></span></a></li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="reports.php">Reports <span class="fa fa-folder-open"></span></a></li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user"></span></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="logout.php"><span class="fa fa-sign-out"> Logout</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="settings.php"><span class="fa fa-cog"> Settings</span></a>
          </div >
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>