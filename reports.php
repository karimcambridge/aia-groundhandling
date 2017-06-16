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
				<div class="card-header"><strong>Reports</strong></div>
				<div class="card-block">
					<tag for="meeting"><strong>Starting Date:</strong> </tag><input id="meeting" type="date" value="2017-06-13"/>
					<tag for="meeting"><strong>End Date:</strong> </tag><input id="meeting" type="date" value="2017-07-23"/>
	 				<button type="submit" class="btn btn-danger" id="generateReportBtnPdf"><span class="fa fa-file-pdf-o"></span> PDF Report</button>
	 				<button type="submit" class="btn btn-info" id="generateReportBtnExcel"><span class="fa fa-file-excel-o"></span> Excel Report</button>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
						<tag><strong>Type of Report</strong></tag>
				    	<select class="form-control" id="aircraftType" required>
				    		<option value="">Services</option>
				    		<option value="">Cargo</option>
				    		<option value="">Inventory</option>
				    		<option value="">processed cargo</option>
				    	</select>
				    </div>
				</div>
				<!-- /card-body -->
			</div>
		</div>
		<!-- /col-md-12 -->
	</div>
	<!-- /row -->
</div>

<?php require_once 'includes/footer.php'; ?>