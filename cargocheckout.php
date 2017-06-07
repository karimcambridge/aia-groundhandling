<?php require_once 'includes/header.php'; ?>

<div calss="row">
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li class="active"><strong>Checkout Cargo</strong></li>
  </ol>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
			  <span class="glyphicon glyphicon-check"></span> Cargo Checkout
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
			  <form class="form-inline" action="php_action/cargocheckoutdb.php" method="post" id="cargoCheckout">
			    <div class="form-group">
			      <label class="col-md-6 control-label">Air Bill</label>
			      <div class="col-md-10">
			        <input type="text" class="form-control" placeholder="Liatx123424523" required autofocus />
			      </div>
			    </div>
			    <div class="form-group">
			      <div class="col-md-offset-2">
			        <button type="submit" class="btn btn-info">Search <span class="glyphicon glyphicon-search"></span></button>
			      </div>
			    </div>
			  </form>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
</div>

<?php require_once 'includes/footer.php';?>