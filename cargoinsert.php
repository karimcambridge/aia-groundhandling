<?php require_once 'includes/header.php'; ?>

<?php

$errors = array();
$messages = array();
$hasAnAirWayBill = true;

if(isset($_POST['cargoInsert'])) {
	$airwaybill = $_POST['air-way-bill-selection'];
	$item_datetime = $_POST['item-datetime']; // AirWayBill Date
	$item_type = $_POST['item-type'];
	$item_description = $_POST['item-description'];
	$item_weight = $_POST['item-weight'];
	$item_weight_type = $_POST['item-weight-type'];

	$itemTypeId = getItemTypeId($item_type); // Cargo Type ID

	if($item_weight == 0.0) {
		$errors[] = 'Please enter an item weight.';
	} else {
		if($itemTypeId != -1) {
			$airwaybill = $connectionHandle->real_escape_string($airwaybill);
			$item_description = $connectionHandle->real_escape_string($item_description);
			if($item_weight_type == 'lb') {
				$item_weight = poundsToKG($item_weight);
			}
			$query = "INSERT INTO `cargo_inventory` (`airwaybill`, `cargo_type_id`, `item_description`, `item_weight`, `date_in`) VALUES ('$airwaybill', '$itemTypeId', '$item_description', '$item_weight', CURRENT_TIMESTAMP());";
			$query .= "UPDATE `airwaybills` SET `in_quantity` = `in_quantity` + 1 WHERE `airwaybills`.`airwaybill` = '" . $airwaybill . "';";

			if($result = $connectionHandle->multi_query($query)) {
				if($connectionHandle->insert_id == 0) { // handle first result
					$errors[] = '[1] Database Failed (' . $connectionHandle->error . ')';
				}
				$connectionHandle->next_result();
				if($connectionHandle->errno) { // handle second result
					$errors[] = '[2] Database Failed (' . $connectionHandle->error . ')';
				}
			}
			$_SESSION['air-way-bill-selection'] = $airwaybill;
			if(empty($errors)) {
				$messages[] = 'Item (' . $item_description . ') (' . $item_type . ') (' . $item_weight . ' ' . $item_weight_type . ') has been inserted in the cargo inventory under AirWayBill (' . $airwaybill . ') successfully.';
			}
			unset($_POST['cargoInsert']);
		} else {
			$errors[] = 'Error finding selected Item Type ID ('. $item_type . '). Please report the issue.';
		}
	}
}

if(isset($_SESSION['air-way-bill-selection'])) {
	$previousAirWayBill = $_SESSION['air-way-bill-selection'];
	$airwaybill_datetimeUnix = getAirWayBill($previousAirWayBill)->getDateInTimestamp();
} else {
	$previousAirWayBill = "";
	if(empty($airwaybills)) {
		$hasAnAirWayBill = false;
	} else {
		$airwaybill_datetimeUnix = $airwaybills[0]->getDateInTimestamp();
	}
}

?>
<div calss="row">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
		<li class="breadcrumb-item active"><strong>Cargo Insert</strong></li>
	</ol>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<!-- card-heading -->
			<div class="card-header"><strong>Cargo Insert</strong></div>
			<!-- card-body -->
			<div class="card-block text-center">
				<?php
					if($errors) {
						echo '<div class="messages">';
						foreach ($errors as $key => $value) {
							echo '<div class="alert alert-danger alert-dismissible" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign"></span>';
							echo '<h4 class="alert-heading">ERROR!</h4>';
							echo '<button type="button" class="close" data-dismiss="alert" aria-tag="Close"><span aria-hidden="true">&times;</span></button>';
							echo $value . '</div>';
						}
						echo '</div>';
					}
				?>
				<?php
					if($messages) {
						echo '<div class="messages">';
						foreach ($messages as $key => $value) {
							echo '<div class="alert alert-success alert-dismissible" role="alert">
							<span class="glyphicon glyphicon-exclamation-sign"></span>';
							echo '<h4 class="alert-heading">SUCCESS!</h4>';
							echo '<button type="button" class="close" data-dismiss="alert" aria-tag="Close"><span aria-hidden="true">&times;</span></button>';
							echo $value . '</div>';
						}
						echo '</div>';
					}
				?>
				<?php
						echo ($hasAnAirWayBill == true) ? '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargoInsertModal">Insert Cargo</button>' : '<small>There are no Air Way Bills in the database. Please enter one.</small><br><button type="button" class="btn btn-danger" onclick="location.href=\'airwaybillscan.php\'";>Insert Air Way Bill</button>';
				?>
				<div class="form-group mb-0">
					<div class="modal fade" id="cargoInsertModal" role="dialog" aria-tagledby="cargoInsertModaltag" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<form id="cargoInsert" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title text-center" id="cargoInsertModaltag">Enter the item information:</h1>
										<button type="button" class="close" data-dismiss="modal" aria-tag="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<tag for="air-way-bill-selection" class="form-control-tag">Select AirWayBill #</tag>
											<select class="form-control" name="air-way-bill-selection" id="air-way-bill-selection" required>
											<?php
												foreach($airwaybills as $airwaybill) {
													echo "<option value=\"" . $airwaybill->getName() . "\"";
													if($airwaybill->getName() == $previousAirWayBill) {
														echo "selected";
													}
													echo ">" . $airwaybill->getName()  . "</option>";
												}
											?>
											</select>
										</div>
										<div class="form-group">
											<tag for="item-datetime" class="form-control-tag">AirWayBill date/time:</tag>
											<input class="form-control" type="datetime-local" name="item-datetime" id="item-datetime" value="<?php echo date('Y-m-d', $airwaybill_datetimeUnix).'T'.date('h:i:s', $airwaybill_datetimeUnix);?>" readonly></input>
										</div>
										<div class="form-group">
											<tag for="item-type" class="form-control-tag">Type:</tag>
											<select class="form-control" name="item-type" id="item-type" required>
											<?php
												foreach($cargotypes as $cargotype) {
													echo '<option value="' . $cargotype->getName() . '">' . $cargotype->getName() . '</option>';
												}
											?>
											</select>
										</div>
										<div class="form-group">
											<tag for="item-description" class="form-control-tag">Description:</tag>
											<textarea class="form-control" name="item-description" id="item-description" required></textarea>
										</div>
										<div class="form-group">
											<tag for="item-datetime" class="form-control-tag">Enter the items' weight:</tag>
											<input class="form-control" type="number" name="item-weight" id="item-weight" step="0.01" min="0" max="1000" value="0.00" required></input>
										</div>
										<div class="form-group">
											<tag for="item-weight-type" class="form-control-tag">KG or Pounds (items will be stored as KG):</tag>
											<select class="form-control" name="item-weight-type" id="item-weight-type" required>
												<option value="kg" selected>KG</option>
												<option value="lb">LBs (Pounds)</option>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" name="cargoInsert" class="btn btn-primary">Add to inventory</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /card-body -->
		</div>
	</div>
</div>

<!-- Date.js -->
<script src="custom/js/moment.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	var $hasAnAirWayBill = <?php echo $hasAnAirWayBill; ?>;
	if($hasAnAirWayBill) {
		$('#cargoInsertModal').modal('show');
	}
	$('#cargoInsertModal').on('shown.bs.modal', function () {
		$('#item-description').focus();
	})
	$('#air-way-bill-selection').change(function() {
		var selectedAirwaybill = $(this).val();
		var dataString = 'airwaybill=' + selectedAirwaybill;
		$.ajax({
			type: "POST",
			url: "cargoinsert_dateupdate.php",
			data: dataString,
			cache: false,
			success: function(data)
			{
				var timeStamp = parseInt(data);
				$("#item-datetime").val(moment.unix(timeStamp).format('YYYY-MM-DDTHH:mm:ss'));
			}
		});
	});
});

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 12000);
</script>

<?php

if(isset($_SESSION['air-way-bill-selection'])) {
	unset($_SESSION['air-way-bill-selection']);
}

?>

<?php require_once 'includes/footer.php';?>