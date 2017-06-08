<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<span class="glyphicon glyphicon-book"></span> <strong>Reports</strong>
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				<form class="form-inline" action="php_action/getOrderReport.php" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-8 control-label">Start Date</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="startDate" placeholder="Start Date" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-8 control-label">End Date</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="endDate" placeholder="End Date" />
				    </div>
				  </div>
				  	<div class="form-group">
				    <label for="startDate" class="col-sm-8 control-label">Report Type</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="reportType" />
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-success" id="generateReportBtn"><span class="glyphicon glyphicon-ok-sign"></span> Generate Report</button>
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

<script src="custom/js/report.js"></script>

<?php require_once 'includes/footer.php'; ?>