<?php require_once 'includes/header.php'; ?>

<?php

$errors = array();

foreach($_GET as $key => $value) {
	switch($value)
	{
		case "nonexistantreport":
			$errors[] = "This report type does not yet exist or should not exist. Please tell an administrator.";
			break;
		case "nodata":
			$errors[] = "This report type has no data between " . $_GET['datestart'] . " and " . $_GET['dateend'] . ".";
			break;
	}
}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
				<li class="breadcrumb-item active"><strong>Reports</strong></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong>Reports</strong>
				</div>
				<div class="card-block">
					<?php
						if(!empty($errors)) {
							echo '<div class="messages">';
							foreach ($errors as $key => $value) {
								echo '<div class="alert alert-danger alert-dismissible" role="alert">
								<span class="glyphicon glyphicon-exclamation-sign"></span>';
								echo '<h4 class="alert-heading">ERROR!</h4>';
								echo '<button type="button" class="close" data-dismiss="alert" aria-tag="Close"><span aria-hidden="true">&times;</span></button>';
								echo $value . '</div>';
							}
							echo '</div>';
						}
					?>
					<form id="reportGenerate" action="generate_report.php" method="POST">
						<div class="row mb-3">
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<tag for="date-start">
									<strong>Starting Date:</strong>
								</tag>
								<input class="form-control" id="date-start" name="date-start" type="date" value="2017-06-13"/>
							</div>
		 					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<tag for="date-end">
									<strong>End Date:</strong>
								</tag>
								<input class="form-control" id="date-end" name="date-end" type="date" value="2017-07-23"/>
		 					</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
								<tag for="reportType">
									<strong>Type of Report</strong>
								</tag>
								<select class="form-control" id="reportType" name="reportType" required>
									<option value="air-way-bills">Air Way Bills</option>
									<option value="cargo-inventory">Cargo Inventory</option>
									<option value="cargo-removed">Cargo Removed</option>
									<option value="carriers">Carriers</option>
									<option value="consignees">Consignees</option>
								</select>
							</div>
		 				</div>
		 				<div class="row">
							<div class="col-md-2">
		 						<button type="submit" class="btn btn-success" name="reportGenerateExcelBtn" form="reportGenerate"><span class="fa fa-file-excel-o"></span> Excel Report (XLXS)</button>
		 					</div>
		 					<div class="col-md-2">
		 						<button type="submit" class="btn btn-success" name="reportGenerateExcelCsvBtn" form="reportGenerate"><span class="fa fa-file-text-o"></span> Excel Report (CSV)</button>
			 				</div>
		 				</div>
		 			</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 7000);
</script>

<?php require_once 'includes/footer.php'; ?>