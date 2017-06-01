<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<STRONG>
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">

				<form class="form-inline" action="php_action/getOrderReport.php" method="post" id="getOrderReportForm">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-8 control-label"></label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-8 control-label"></label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="endDate" name="endDate" placeholder="" />
				    </div>
				  </div>
				  	<div class="form-group">
				    <label for="startDate" class="col-sm-8 control-label"></label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" name="" placeholder="" />
				    </div>
				  </div>

				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-info" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> calculate fees</button>
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
<div class="panel-body">
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputName2"></label>
    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2"></label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="">
  </div>

</form>

</div>
<div class="panel-body">
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputName2"></label>
    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
      <input type="email" class="form-control" id="exampleInputEmail2" placeholder="">

  </div>

  <div class="form-group">
    <label for="exampleInputEmail2"></label>
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="">
  </div>

</form>

</div>
<script src="custom/js/report.js"></script>


<?php require_once 'includes/footer.php'; ?>
