<?php require_once 'includes/header.php'; ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
				<li class="breadcrumb-item active"><strong>AirWayBill # Entry</strong></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"><strong>Cargo AirWayBill # Entry</strong></div>
				<div class="card-block">
					<form class="form-inline" id="airwaybillEntryForm" method="post">
						<div class="form-group">
							<tag for="carrier-selection" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-control-label">Owner / Carrier</tag>
							<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
								<select class="form-control" id="carrier-selection" name="carrier-selection" required>
								<?php
									foreach($carriers as $carrier) {
										echo '<option value="' . $carrier->getId() . '">' . $carrier->getName() . '</option>';
									}
								?>
								</select>
							</div>
						</div>
						<div class="form-group" id='consignee-group'></div>
						<div class="form-group">
							<tag for="air-way-bill-scan" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-control-label">Air Way Bill #</tag>
							<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
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
</div>

<script type="text/javascript">
$(document).ready(function() {
	var centerX = $(window).width() / 2;
	var centerY = $(window).height() / 2;

	$('#carrier-selection').change(function() {
		var dataString = 'carrierid=' + $("#carrier-selection").val();
		$.ajax({
			type: "POST",
			url: "airwaybillscan_getconsigneelist.php",
			data: dataString,
			cache: false,
			success: function(data) {
				if(data.length) {
					$("#consignee-div").remove();
					var newData = JSON.parse(data);
					if(newData.length > 0) {
						var newConsigneeDiv = $(document.createElement('div')).attr("id", 'consignee-div').attr("class", 'col-xs-2 col-sm-2 col-md-1 col-lg-1');

						var htmlString = '<tag for="consignee-selection" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-control-label">Consignees</tag>' + '<select class="form-control" id="consignee-selection" name="consignee-selection" required>';

						for(var i = 0; i < newData.length; i++) {
							htmlString += '<option value="' + newData[i] + '">' + newData[i] + '</option>';
						}
						htmlString += '</class>';

						newConsigneeDiv.after().html(htmlString);
						newConsigneeDiv.appendTo("#consignee-group");
					}
				} else {
					$("#consignee-div").remove();
				}
				/*if(data instanceof String) {
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
				}*/
			}
		});
	});
	$('#air-way-bill-scan-button').click(function() {
		var dataString = 'airwaybill=' + $("#air-way-bill-scan").val() + '&carrierid=' + $("#carrier-selection").val();
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
						message: JSON.parse(data)
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