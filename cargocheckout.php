<?php require_once 'includes/header.php'; ?>

<div class="row">
	<ol class="breadcrumb">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active"><strong>Cargo Checkout</strong></li>
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
				<form class="form-horizontal" id="cargoCheckout" action="cargoedit.php" method="post">
					<div class="form-group">
						<div class="text-center">
							<h3>Select an Air Way Bill below in order to begin the checkout process</h3>
						</div>
					</div>
					<div class="form-group">
						<div class="text-center">
							<select class="form-control" name="air-way-bill-checkout" id="air-way-bill-checkout" required autofocus>
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
					<div class="form-group">
						<div class="text-center">
							<button type="submit"  name="cargoCheckout" class="btn btn-primary">Search <span class="glyphicon glyphicon-search"></span></button>
						</div>
					</div>
				</form>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
</div>

<?php require_once 'includes/footer.php';?>