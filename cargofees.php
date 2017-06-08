<?php require_once 'includes/header.php'; ?>

<div calss="row">
	<ol class="breadcrumb">
		<li><a href="dashboard.php">Home</a></li>
		<li class="active"><strong>Cargo Fees</strong></li>
	</ol>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<!-- panel-heading -->
			<div class="panel-heading">
				<strong>Cargo Fees</strong>
			</div>
			<!-- panel-body -->
			<div class="panel-body">
				<form class="form-horizontal" method="post" id="cargoFees">
					<div class="form-group">
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Owner / Carrier </label>
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<select class="form-control" name="carrierSelection" id="carrierSelection" required>
						<?php
							foreach($carriers as $carrier) {
								echo "<option value=\"" . $carrier->getName() . "\">" . $carrier->getName() . "</option>";
							}
						?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Import weight </label>
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<input type="text" class="form-control" id="Importweight" name="Importweight" placeholder="45Kg" autofocus />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Export Weight</label>
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<input type="text" class="form-control" id="exportweight" name="exportweight" placeholder="75KG" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Total Weight</label>
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<input type="text" class="form-control" id="" name="" placeholder="120KG" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Security Fee</label>
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<input type="text" class="form-control" id="" name="" placeholder="0.29 per KG" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Storage</label>
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<input type="text" class="form-control" id="" name="storagekilo" placeholder="0.015 per kilo reg." />
						</div>
						<div class="col-md-offset-1 col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<input type="text" class="form-control" id="" name="storageref" placeholder="15% of s/chge (ref)" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">DG Fees</label>
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<input type="text" class="form-control" id="" name="" placeholder="175 per UNI #" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Lcl/Rgnl</label>
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<input type="text" class="form-control" id="" name="" placeholder="10.25 per mvmt" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Int'l/Cmcl</label>
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							<input type="text" class="form-control" id="" name="" placeholder="174 per day or part" />
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group">
						<div class="text-center">
							<button type="submit" class="btn btn-info top-buffer" id="generateReportBtn"><span class="glyphicon glyphicon-ok-sign"></span> Calculate Fees</button>
						</div>
					</div>
				</form>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<?php require_once 'includes/footer.php'; ?>