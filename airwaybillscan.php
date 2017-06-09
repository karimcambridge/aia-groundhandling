<?php require_once 'includes/header.php'; ?>
	
<?php

if(isset($_SESSION['carrierSelection'])) {
	$previousCarrier = $_SESSION['carrierSelection'];
} else {
	$previousCarrier = "";
}

?>

<div class="row">
  <div class="col-md-12">
  	<ol class="breadcrumb">
  	  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
  	  <li class="breadcrumb-item active"><strong>Airbill Entry</strong></li>
  	</ol>
  </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<span class="glyphicon glyphicon-check"></span> Cargo Airbill Entry
			</div>
			<!-- /card-heading -->
			<div class="card-block">
				<form class="form-inline" id="airwaybillEntryForm" action="php_action\airwaybillscanentry.php" method="post" >
				<div class="form-group">
				  <tag class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Owner / Carrier</label>
				  <div class="clearfix"></div>
				    <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
				      <select class="form-control" name="carrierSelection" id="carrierSelection" required>
						<?php
							foreach($carriers as $carrier) {
								echo "<option value=\"" . $carrier->getName() . "\"";
								if($carrier->getName() == $previousCarrier) {
									echo "selected";
								}
								echo ">" . $carrier->getName() . "</option>";
							}
						?>
				      </select>
				    </div>
				  </div>
				  <div class="form-group">
				    <tag class="col-sm-6 control-label">Air Bill</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="cargoAirbill" placeholder="Liatx123424523" required autofocus />
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-1">
				      <button type="submit" class="btn btn-primary"></span>Save changes</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /card-body -->
		</div>
	</div>
</div>

<?php

if(isset($_SESSION['carrierSelection'])) {
	unset($_SESSION['carrierSelection']);
}

?>

<?php require_once 'includes/footer.php';?>