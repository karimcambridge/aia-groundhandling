<?php require_once 'includes/header.php'; ?>
	
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
				<span class="glyphicon glyphicon-check"></span> Cargo
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				<form class="form-inline" id="submitliatform" action="php_action\creat_liat_cargo.php" method="post" >
				<div class="form-group">
				    <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Owner / Carrier</label>
				    <div class="clearfix"></div>
				    <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
				      <select class="form-control" id="aircraftType" required>
				        <option value="liat">LIAT</option>
				        <option value="cal">CAL</option>
				        <option value="dhl">DHL</option>
				        <option value="fedex">Fedex</option>
				        <option value="amerijet">AmeriJet</option>
				        <option value="jetpack">JetPack</option>
				      </select>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-6 control-label">Air Bill</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="cargoairbill" placeholder="Liatx123424523" autofocus />
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-1">
				      <button type="submit" class="btn btn-primary"><span class="createCALCARGObtn" data-loading-text="loading..."><span/>Save changes</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	
	
	<script type="text/javascript"src="custom/js/liat.js"
<?php require_once 'includes/footer.php';?>
	