<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="glyphicon glyphicon-check"></i> Cargo Checkout
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				
				<form class="form-inline" action="php_action\creat_liat_cargo.php" method="post" id="submitliatform">
				  <div class="form-group">
				    <label for="startDate" class="col-sm-6 control-label">Air Bill</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="liatcargo" name="laitcargo" placeholder="Liatx123424523" autofocus />
				    </div>
				  </div>
				 
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-info"><i class="createCALCARGObtn"data-loading-text=loading..."><i/>Search</button>
				    </div>
				  </div>
				</form>
			</div>
			<!-- /panel-body -->
		</div>
	</div>

<script type="text/javascript" src="custom/js/liat.js"></script>
<?php require_once 'includes/footer.php';?>