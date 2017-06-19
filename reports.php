<?php require_once 'includes/header.php'; ?>

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
					<div class="row mb-3">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
							<tag for="date-start">
								<strong>Starting Date:</strong>
							</tag>
							<input class="form-control" id="date-start" type="date" value="2017-06-13"/>
						</div>
	 					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
							<tag for="date-end">
								<strong>End Date:</strong>
							</tag>
							<input class="form-control" id="date-end" type="date" value="2017-07-23"/>
	 					</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
							<tag for="reportType">
								<strong>Type of Report</strong>
							</tag>
							<select class="form-control" id="reportType" required>
								<option value="services">Services</option>
								<option value="cargo">Cargo</option>
								<option value="inventory">Inventory</option>
								<option value="processed-cargo">Processed Cargo</option>
							</select>
						</div>
	 				</div>
	 				<div class="row">
						<div class="col-md-2">
	 						<!--<button type="submit" class="btn btn-danger" id="generateReportPdfBtn"><span class="fa fa-file-pdf-o"></span> PDF Report</	button>-->
	 						<form id="reportGenerate" action="generate_report.php" method="get">
	 							<button type="submit" class="btn btn-success" id="reportGenerateExcelBtn" form="reportGenerate" value="test"><span class="fa fa-file-excel-o"></span> Excel Report</button>
	 						</form>
		 				</div>
	 				</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once 'includes/footer.php'; ?>