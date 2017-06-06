<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<strong>Cargo Fees</strong>
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
			  <table>
				<form class="form-inline" method="post" id="cargoFees">
			      <div class="form-group">
				    <label class="col-xs-1 col-sm-1 control-label">Owner / Carrier </label>
				    <div class="col-xs-1 col-sm-12">
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
				    <label class="col-xs-1 col-sm-1 control-label">Import weight </label>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="Importweight" name="Importweight" placeholder="45Kg" autofocus />
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-xs-1 col-sm-1 control-label">Import weight </label>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="Importweight" name="Importweight" placeholder="45Kg" autofocus />
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-xs-1 col-sm-1 control-label">Export Weight</label>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="exportweight" name="exportweight" placeholder="75KG" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-xs-1 col-sm-1 control-label">Total Weight</label>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="" name="" placeholder="120KG" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-xs-1 col-sm-1 control-label">Security Fee</label>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="" name="" placeholder="0.29 per KG" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-xs-1 col-sm-2 control-label">Storage</label>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="" name="storagekilo" placeholder="0.015 per kilo reg." />
				    </div>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="" name="storageref" placeholder="15% of s/chge (ref)" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-xs-1 col-sm-2 control-label">DG Fees</label>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="" name="" placeholder="175 per UNI #" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-xs-1 col-sm-2 control-label">Lcl/Rgnl</label>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="" name="" placeholder="10.25 per mvmt" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-xs-1 col-sm-2 control-label">Int'l/Cmcl</label>
				    <div class="col-xs-1 col-sm-12">
				      <input type="text" class="form-control" id="" name="" placeholder="174 per day or part" />
				    </div>
				  </div>
				  <div class="clearfix"></div>
				  <div class="form-group">
				    <div class="text-center">
				      <button type="submit" class="btn btn-info top-buffer" id="generateReportBtn"><i class="glyphicon glyphicon-ok-sign"></i> Calculate Fees</button>
				    </div>
				  </div>
				</form>
			  </table>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<?php require_once 'includes/footer.php'; ?>