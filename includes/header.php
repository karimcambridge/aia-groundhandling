<?php require_once'php_action/core.php';?>

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

    <!-- dataTables -->
    <script src="assests/plugins/datatables/datatables.min.css"></script>

    <!-- file input-->
    <script src="assests/plugins/fileinput/css/fileinput.min.css"></script>

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
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">GroundOPS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
          <li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-home "></i></a></li>
            <li id="navBrand"><a href="viewcargo.php"> <strong>View Cargo </strong><i class="glyphicon glyphicon-search "></i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Enter Cargo <i class="glyphicon glyphicon-briefcase"></i><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="liat.php">Liat</a></li>
				<li role="separator" class="divider"></li>
			   <li><a href="DhL.php">DHL</a></li>
                <li role="separator" class="divider"></li>
				<li><a href="fedex.php">Fedex</a></li>
			   <li role="separator" class="divider"></li>
                <li><a href="ameri_jet.php">Ameri Jet</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="cal.php">CAL</a></li>
              </ul>
				<li id="navDashboard"><a href="checkoutcargo.php"> <strong>Check Out Cargo</strong> <i class="glyphicon glyphicon-plane "></i></a></li>
				
            </li>
			 <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Cargo Fees <i class="glyphicon glyphicon-briefcase"></i><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="cargofees.php?cargoCompany=LIAT">Liat</a></li>
				<li role="separator" class="divider"></li>
			   <li><a href="cargofees.php?cargoCompany=DHL">DHL</a></li>
                <li role="separator" class="divider"></li>
				<li><a href="cargofees.php?cargoCompany=FEDEX">Fedex</a></li>
			   <li role="separator" class="divider"></li>
                <li><a href="cargofees.php?cargoCompany=AMERIJET">Amerijet</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="cargofees.php?cargoCompany=CAL">CAL</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="cargofees.php?cargoCompany=JETPACK">JetPack</a></li>

              </ul></li>
			        <li><a href="servicefees.php">Services Fees <i class="glyphicon glyphicon-usd"></i></a></li>
			
          </ul>
          <ul class="nav navbar-nav navbar-right">
			<li id="navDashboard"><a href="report.php"> <strong>Reports</strong> <i class="glyphicon glyphicon-folder-open "></i></a></li>
		  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i><span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li id="topNavlogout"><a href="logout.php">Logout   <i class="glyphicon glyphicon-log-out"></i></a></li>
				<li role="separator" class="divider"></li>
				<li id="topNavsettings"><a href="settings.php">Settings   <i class="glyphicon glyphicon-wrench"></i></a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>