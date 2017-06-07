<?php require_once 'includes/header.php'; ?>
	
<?php

if(isset($_SESSION['cargoEntryCarrier'])) {
	$carrier = $_SESSION['cargoEntryCarrier'];
} else {
	$carrier = "";
}

?>

<div calss="row">
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li class="active"><strong>Airbill Entry</strong></li>
  </ol>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<span class="glyphicon glyphicon-check"></span> Cargo Airbill Entry
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				<form class="form-inline" id="cargoentryform" action="php_action\cargoentrydb.php" method="post" >
				<div class="form-group">
				    <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Owner / Carrier</label>
				    <div class="clearfix"></div>
				    <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
				      <select class="form-control" name="cargoEntryCarrier" id="cargoEntryCarrier" required>
				        <option value="liat" <?= ($carrier == "liat") ? "selected" : "" ?>>LIAT</option>
				        <option value="cal" <?= ($carrier == "cal") ? "selected" : "" ?>>CAL</option>
				        <option value="dhl" <?= ($carrier == "dhl") ? "selected" : "" ?>>DHL</option>
				        <option value="fedex" <?= ($carrier == "fedex") ? "selected" : "" ?>>Fedex</option>
				        <option value="amerijet" <?= ($carrier == "amerijet") ? "selected" : "" ?>>AmeriJet</option>
				        <option value="jetpack" <?= ($carrier == "jetpack") ? "selected" : "" ?>>JetPack</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-6 control-label">Air Bill</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" name="cargoAirbill" placeholder="Liatx123424523" required autofocus />
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-1">
				      <button type="submit" class="btn btn-primary"><span class="createCALCARGObtn" data-loading-text="saving..."></span>Save changes</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
</div>

<!--<script type="text/javascript">
var carrier = <?php echo json_encode($carrier, JSON_HEX_TAG);?>;
console.log(carrier);

if(carrier) {
	var mySelect = document.getElementById('cargoEntryCarrier');

	for(var i, j = 0; i = mySelect.options[j]; j++) {
		console.log(i.value);
	    if(i.value == carrier) {
	        mySelect.selectedIndex = j;
	        break;
	    }
	}
}</script>

<script src="custom/js/cargoentryselect.js"></script> -->

<?php

if(isset($_SESSION['cargoEntryCarrier'])) {
	unset($_SESSION['cargoEntryCarrier']);
}

?>

<?php require_once 'includes/footer.php';?>