<?php require_once 'includes/header.php'; ?>
	
<div calss="row">
<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li class="active"><strong>Amerijet Cargo</strong></li>
</ol>

</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i> Cargo
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-inline" id="submitliatform" action="php_action\creat_liat_cargo.php" method="post" >
				  <div class="form-group">
				    <label for="startDate" class="col-sm-6 control-label">Air Bill</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="liatcargo" name="liatcargo" placeholder="Liatx123424523" autofocus />
				    </div>
				  </div>
				 
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-primary"><i class="createCALCARGObtn"data-loading-text=loading..."><i/>Save changes</button>
				    </div>
				  </div>
				</form>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	
	
	<script type="text/javascript"src="custom/js/liat.js"
<?php require_once 'includes/footer.php';?>
	