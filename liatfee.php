<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<STRONG> 
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				<table>
				<form class="form-inline" action="" method="post" id="">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-8 control-label">Import weight</label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" id="startDate" name="startDate" placeholder="45Kg" />
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="endDate" class="col-sm-8 control-label">Export weight</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="endDate" name="endDate" placeholder="75KG" />
				    </div>
				  </div>
				  	<div class="form-group">
				    <label for="startDate" class="col-sm-8 control-label">Totalweight</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="" name="" placeholder="120KG" />
				    </div>
				  </div>
				 
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-info" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> calculate fees</button>
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
<?php

$jamal=98;
$time=date("Y/m/d");
echo $jamal*4;
echo $time;
 echo date("Y/m/d");
 
?>
<script src="custom/js/report.js"></script>


<?php require_once 'includes/footer.php'; ?>
