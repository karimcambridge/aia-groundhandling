<?php require_once 'includes/header.php'; ?>

<?php

$errors = array();
$messages = array();

if(isset($_POST['cargoCheckout'])) {
	$airwaybill = $_POST['air-way-bill-checkout'];
	echo $airwaybill;
}

?>

<div class="row">
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li class="active"><strong>Checkout Cargo</strong></li>
  </ol>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
			  <span class="glyphicon glyphicon-check"></span> Cargo Checkout
			</div>
			<!-- panel-heading -->
			<div class="panel-body">
			  <form class="form-horizontal" action="" method="post" id="cargoCheckout">
			  	<div class="form-group col-md-12">
			  		<div class="text-center">
			  			<h3>Select an Air Way Bill below in order to begin the checkout process</h3>
			  		</div>
			  	</div>
          <div class="clearfix"></div>
			    <div class="form-group col-md-12">
			      <div class="text-center">
			      	<select class="form-control" name="air-way-bill-selection" id="air-way-bill-selection" required autofocus>
                <?php
                  foreach($airwaybills as $airwaybill) {
                    echo "<option value=\"" . $airwaybill->getName() . "\"";
                    //if($airwaybill->getName() == $previousAirWayBill) {
                    //  echo "selected";
                    //}
                    echo ">" . $airwaybill->getName() . " (" . $airwaybill->getDateIn() . ")</option>";
                  }
                ?>
                </select>
			      </div>
			    </div>
			    <div class="form-group col-md-12">
			      <div class="text-center">
			        <button type="submit" class="btn btn-primary">Search <span class="glyphicon glyphicon-search"></span></button>
			      </div>
			    </div>
			  </form>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
</div>

<?php require_once 'includes/footer.php';?>