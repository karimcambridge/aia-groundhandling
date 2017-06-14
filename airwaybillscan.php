<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
			<li class="breadcrumb-item active"><strong>AirWayBill Entry</strong></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><strong>Cargo AirWayBill Entry</strong></div>
			<!-- /card-heading -->
			<div class="card-block">
				<form class="form-inline" id="airwaybillEntryForm" action="" method="post" >
					<div class="form-group">
						<tag class="col-xs-12 col-sm-12 col-md-12 col-lg-12 control-label">Owner / Carrier</tag>
						<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
							<select class="form-control" id="carrier-selection" name="carrier-selection" required>
							<?php
								foreach($carriers as $carrier) {
									echo "<option value=\"" . $carrier->getId() . "\"";
									echo ">" . $carrier->getName() . "</option>";
								}
							?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<tag class="col-sm-6 control-label">Air Way Bill #</tag>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="air-way-bill-scan" name="air-way-bill-scan" placeholder="xxx-xxx-xxx" required autofocus />
						</div>
					</div>
					<div class="form-group">
						<button type="button" id="air-way-bill-scan-button" name="air-way-bill-scan-button" class="btn btn-primary"></span>Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	var centerX = $(window).width() / 2;
	var centerY = $(window).height() / 2;

	$('#air-way-bill-scan-button').click(function() {
		var scannedAirWayBill = $("#air-way-bill-scan").val();
		var scannedCarrier = $("#carrier-selection").val();

		var dataString = 'airwaybill=' + scannedAirWayBill + '&carrierid=' + scannedCarrier;
		$.ajax({
			type: "POST",
			url: "airwaybillscan_update.php",
			data: dataString,
			cache: false,
			success: function(data) {
				if(data) {
					$.notify({
						icon: 'fa fa-exclamation-triangle',
						title: '<strong>Error!</strong>',
						message: data
					},{
						type: 'danger',
						animate: {
							enter: 'animated zoomInDown',
							exit: 'animated zoomOutUp'
						},
						newest_on_top: true,
						offset: {
							x: centerX,
							y: centerY
						}
					});
				} else {
					$.notify({
						icon: 'fa fa-check',
						title: '<strong>Success!</strong>',
						message: 'This Air Way Bill (' + $("#air-way-bill-scan").val() + ') has been inserted correctly.'
					},{
						type: 'success',
						animate: {
							enter: 'animated zoomInDown',
							exit: 'animated zoomOutUp'
						},
						newest_on_top: true,
						offset: {
							x: centerX,
							y: centerY
						}
					});
					$("#air-way-bill-scan").val("");
					$("#air-way-bill-scan").focus();
				}
			}
		});
	});
});
</script>

<?php require_once 'includes/footer.php';?>