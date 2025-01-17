<?php require_once 'includes/header.php'; ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
				<li class="breadcrumb-item active"><strong>Cargo Fees</strong></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"><strong>Cargo Fees</strong></div>
				<div class="card-block">
					<form class="form-horizontal" method="post" id="cargoFees">
						<div class="form-group">
							<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 form-control-label">Owner / Carrier </tag>
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
							<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 form-control-label">Import weight </tag>
							<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
								<input type="text" class="form-control" id="Importweight" name="Importweight" placeholder="45Kg" autofocus />
							</div>
						</div>
						<div class="form-group">
							<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 form-control-label">Export Weight</tag>
							<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
								<input type="text" class="form-control" id="exportweight" name="exportweight" placeholder="75KG" />
							</div>
						</div>
						<div class="form-group">
							<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 form-control-label">Total Weight</tag>
							<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
								<input type="text" class="form-control" id="" name="" placeholder="120KG" />
							</div>
						</div>
						<div class="form-group">
							<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 form-control-label">Security Fee</tag>
							<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
								<input type="text" class="form-control" id="" name="" placeholder="0.29 per KG" />
							</div>
						</div>
						<div class="form-group">
							<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 form-control-label">Storage</tag>
							<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
								<input type="text" class="form-control" id="" name="storagekilo" placeholder="0.015 per kilo reg." />
							</div>
							<div class="col-md-offset-1 col-xs-11 col-sm-11 col-md-11 col-lg-11">
								<input type="text" class="form-control" id="" name="storageref" placeholder="15% of s/chge (ref)" />
							</div>
						</div>
						<div class="form-group">
							<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 form-control-label">DG Fees</tag>
							<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
								<input type="text" class="form-control" id="" name="" placeholder="175 per UNI #" />
							</div>
						</div>
						<div class="form-group">
							<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 form-control-label">Lcl/Rgnl</tag>
							<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
								<input type="text" class="form-control" id="" name="" placeholder="10.25 per mvmt" />
							</div>
						</div>
						<div class="form-group">
							<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 form-control-label">Int'l/Cmcl</tag>
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
			</div>
		</div>
	</div>
</div>
<?php require_once 'includes/footer.php'; ?>