<?php require_once 'includes/header.php'; ?>

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
			<!-- /card-heading -->
			<div class="card-block">
				<label for="meeting">starting Date</label><input id="meeting" type="date" value="2017-06-13"/>
				<label for="meeting">End Date: </label><input id="meeting" type="date" value="2017-07-23"/>
 			<button type="submit" class="btn btn-danger" id="generateReportBtn"><span class="glyphicon glyphicon-ok-sign"></span>  PDF Report</button>
 			<button type="submit" class="btn btn-info" id="generateReportBtn"><span class="glyphicon glyphicon-ok-sign"></span> Excel Report</button>
				  
				  </div>
				 
				   <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
			      <select class="form-control" id="aircraftType" required>
			        <option value="liat">LIAT</option>
			        <option value="cal">CAL</option>
			        <option value="dhl">DHL</option>
			        <option value="fedex">Fedex</option>
			        <option value="amerijet">AmeriJet</option>
			        <option value="jetpack">JetPack</option>
			      </select>
			    </div>
				  


			</div>
			<!-- /card-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/report.js"></script>

<?php require_once 'includes/footer.php'; ?>