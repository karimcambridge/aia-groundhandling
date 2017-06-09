<?php require_once 'includes/header.php'; ?>

<?php

$airwaybill;

if(isset($_POST['cargoCheckout'])) {
	$airwaybill = $_POST['air-way-bill-checkout'];
}

if(empty($airwaybill)) {
	header('location:http://127.00.1/groundopps/cargocheckout.php');
}

?>

<div class="row">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
		<?php
    	    echo "<li class=\"breadcrumb-item\"><a href=\"" . $_SERVER['SCRIPT_NAME'] . "\">Cargo Checkout</a></li>";
    	    echo "<li class=\"breadcrumb-item active\"><strong>" . $airwaybill . "</strong></li>";
    	?>
	</ol>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<span class="glyphicon glyphicon-check"></span> Cargo Edit & Checkout
			</div>
			<!-- panel-heading -->
			<div class="panel-body">
				<form class="form-horizontal" id="cargoCheckout" action="" method="post">
					<div class="form-group">
						<div class="text-center">
							<h3>Please Select An Item To Checkout From AirWayBill <font color="green"><?php echo $airwaybill ?></font></h3>
						</div>
					</div>
				</form>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
</div>

<?php require_once 'includes/footer.php';?>