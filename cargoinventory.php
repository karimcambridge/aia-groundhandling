<?php require_once 'includes/header.php'; ?>

<?php
	include("includes/paginator.php");

	$airwaybill;
	$partialAirwaybill;
	$editingId;
	$errors = array();
	$messages_info = array();
	$messages_success = array();

	if(isset($_GET['airwaybill'])) {
		$airwaybill = $_GET['airwaybill'];
		include 'custom/css/cargoedit.css';

		if(isset( $_GET['edit'] )) {
			$editingId = $_GET['edit'];
			if(!is_numeric($editingId)) {
				header('location:cargoinventory.php?airwaybill=' . $airwaybill);
				exit();
			}
		}
		$query      = 'SELECT `' . TABLE_CARGO_INVENTORY . '`.`ID`, `' . TABLE_CARGO_INVENTORY . '`.`airwaybill`, `' . TABLE_CARGO_ITEM_TYPES . '`.`cargo_type` AS `cargo_type`, `item_quantity`, `item_description`, `item_weight`, `' . TABLE_CARGO_INVENTORY . '`.`date_in`, `refrigerated_time`, `refrigerated_unix`, `'. TABLE_AIRWAYBILLS .'`.`consignee_type_id` FROM `' . TABLE_CARGO_INVENTORY . '`, `' . TABLE_CARGO_ITEM_TYPES . '`, `'. TABLE_AIRWAYBILLS .'` WHERE `' . TABLE_CARGO_INVENTORY . '`.`cargo_type_id` = `' . TABLE_CARGO_ITEM_TYPES . '`.`ID` AND `' . TABLE_CARGO_INVENTORY . '`.`airwaybill` = `'. TABLE_AIRWAYBILLS .'`.`airwaybill` ';
		if(!empty($airwaybill)) {
			$query  .= "AND `" . TABLE_CARGO_INVENTORY . "`.`airwaybill` = '" . $airwaybill . "'";
		}
		$query      .= ' ORDER BY `date_in`,`airwaybill` DESC';
	}
	else if(isset($_GET['search-airwaybill'])) {
		$partialAirwaybill = $_GET['search-airwaybill'];
		$query = 'SELECT `ID`, `airwaybill`, `carrier_id`, `consignee_id`, `consignee_type_id`, `date_in`, `in_quantity` FROM `' . TABLE_AIRWAYBILLS . '` WHERE `airwaybill` LIKE \'%' . $partialAirwaybill . '%\' AND `in_quantity` > 0 ORDER BY `date_in` DESC, `ID` DESC';
	} else {
		$query      = 'SELECT `ID`, `airwaybill`, `carrier_id`, `consignee_id`, `consignee_type_id`, `date_in`, `in_quantity` FROM `' . TABLE_AIRWAYBILLS . '` WHERE `in_quantity` > 0 ORDER BY `date_in` DESC, `ID` DESC';
	}

	$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 12;
	$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
	$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 15;
	$Paginator  = new Paginator( $connectionHandle, $query );

	$results    = $Paginator->getData( $limit, $page );

	if(empty($results->data) && !empty($airwaybill)) {
		header('location:cargoinventory.php');
		exit();
	}
	if(isset($results) == true && !empty($editingId)) {
		$editingItemType;
		$editingItemQuantity;
		$editingItemDescription;
		$editingItemWeight;
		$editingItemDateUnix;
		$editingItemDays;
		$editingItemFee;
		$editingItemRefrigeratedUnix;
	}
	if(isset($_POST['cargoDelete'])) {
		unset($_POST['cargoDelete']);
 		$item_id = $_POST['item-id'];
		if(!is_numeric($item_id)) {
			header('location:cargoinventory.php?airwaybill=' . $airwaybill);
			exit();
		}
		$errorCount = 0;
		$item_airwaybill = $_POST['item-airwaybill'];
		$item_type = $_POST['item-type'];
		$item_description = $_POST['item-description'];
		$item_weight = $_POST['item-weight'];
		$item_weight_type = $_POST['item-weight-type'];

		$query = "INSERT INTO `" . TABLE_DELETED_CARGO_INVENTORY . "` (`ID`, `airwaybill`, `cargo_type_id`, `item_quantity`, `item_description`, `item_weight`, `date_in`, `refrigerated_time`, `refrigerated_unix`) SELECT * FROM `" . TABLE_CARGO_INVENTORY . "` WHERE `" . TABLE_CARGO_INVENTORY . "`.`ID` = " . $item_id . ";";
		if($result = $connectionHandle->query($query)) { // Never delete data!
			if($connectionHandle->errno) {
				$errors[] = 'Database Failed (' . $connectionHandle->error . ')';
				$errorCount++;
			} else {
				$query = "DELETE FROM `" . TABLE_CARGO_INVENTORY . "` WHERE `ID` = " . $item_id . ";";
				if($result = $connectionHandle->query($query)) {
					if($connectionHandle->errno) {
						$errors[] = 'INCONSISTENCY 0 (REPORT FOR MANUAL FIX) Database Failed (' . $connectionHandle->error . ')';
						$errorCount++;
					}
				}
				$query = "UPDATE `" . TABLE_AIRWAYBILLS . "` SET `in_quantity` = `in_quantity` - 1, `scan_quantity` = `scan_quantity` - 1 WHERE `ID` = " . $item_id . ";";
				if($result = $connectionHandle->query($query)) {
					if($connectionHandle->errno) {
						$errors[] = 'INCONSISTENCY 1 (REPORT FOR MANUAL FIX) Database Failed (' . $connectionHandle->error . ')';
						$errorCount++;
					}
				}
			}
		}
		if(empty($errorCount)) {
			$messages_success[] = 'Item (' . $item_description . ') (' . $item_type . ') (' . $item_weight . ' ' . $item_weight_type . ') has been deleted successfully.';
		}
	}
	else if(isset($_POST['cargoEdit']) || isset($_POST['cargoCheckout'])) {
		$item_airwaybill = $_POST['item-airwaybill'];
		if(empty($item_airwaybill)) {
			$errors[] = "There may have been an error. The airwaybill from the menu may not have been parsed properly. Please refresh the entire page.";
		}
 		$item_id = $_POST['item-id'];
		if(!is_numeric($item_id)) {
			header('location:cargoinventory.php?airwaybill=' . $airwaybill);
			exit();
		}
		$item_refrigerated_unix = 0;
		$item_refrigerated_time = 0;

		$item_datetime = $_POST['item-datetime']; // AirWayBill Date
		$item_type = $_POST['item-type'];
		$item_quantity = $_POST['item-quantity'];
		$item_description = $_POST['item-description'];
		$item_weight = $_POST['item-weight'];
		$item_weight_type = $_POST['item-weight-type'];

		$frozenRow = getCargoRefrigeratedTimes($item_id);
		if(!empty($frozenRow)) {
			$item_refrigerated_time = $frozenRow['refrigerated_time'];
			$item_refrigerated_unix = $frozenRow['refrigerated_unix'];
		}
		if(isset($_POST['item-refrigerated'])) {
			$item_refrigerated = $_POST['item-refrigerated'];
			if($item_refrigerated == 'yes' && $item_refrigerated_unix == 0) { // was not refrigerated before .. so change to refrigerated!
				$item_refrigerated_unix = time();
			}
		} else {
			if($item_refrigerated_unix) {
				$item_refrigerated_time += time() - $item_refrigerated_unix;
				$item_refrigerated_unix = 0;
			}
		}
		$itemTypeId = getItemTypeId($item_type); // Cargo Type ID

		if($itemTypeId != -1) {
			$item_airwaybill = $connectionHandle->real_escape_string($item_airwaybill);
			$item_description = $connectionHandle->real_escape_string($item_description);
			if($item_weight_type == 'lb') {
				$item_weight = poundsToKG($item_weight);
			}
			if(isset($_POST['cargoEdit'])) {
				unset($_POST['cargoEdit']);
				$query = "UPDATE `" . TABLE_CARGO_INVENTORY . "` SET `cargo_type_id` = " . $itemTypeId . ", `item_quantity` = " . $item_quantity . ", `item_description` = '" . $item_description . "', `item_weight` = " . $item_weight . ", `refrigerated_time` = " . $item_refrigerated_time . ", `refrigerated_unix` = " . $item_refrigerated_unix . " WHERE `ID` = " . $item_id . ";";

				if($result = $connectionHandle->query($query)) {
					if($connectionHandle->errno) {
						$errors[] = 'Database Failed (' . $connectionHandle->error . ')';
					} else {
						$messages_success[] = 'Item (' . $item_description . ') (' . $item_type . ') (' . $item_weight . ' ' . $item_weight_type . ') has been edited successfully.';
					}
				}
			}
			else if(isset($_POST['cargoCheckout'])) {
				unset($_POST['cargoCheckout']);
				$connectionHandle->query("INSERT INTO `" . TABLE_CARGO_OUT . "` (`ID`, `airwaybill`, `cargo_type_id`, `item_quantity`, `item_description`, `item_weight`, `date_in`, `refrigerated_time`) SELECT `ID`, `airwaybill`, `cargo_type_id`, `item_quantity`, `item_description`, `item_weight`, `date_in`, `refrigerated_time` FROM `" . TABLE_CARGO_INVENTORY . "` WHERE `ID` = " . $item_id . ";");
				$connectionHandle->query("UPDATE `" . TABLE_CARGO_OUT . "` SET `date_out` = NOW() WHERE `ID` = " . $item_id . ";");
				$connectionHandle->query("DELETE FROM `" . TABLE_CARGO_INVENTORY . "` WHERE `ID` = " . $item_id . ";");
				$connectionHandle->query("UPDATE `" . TABLE_AIRWAYBILLS . "` SET `in_quantity` = `in_quantity` - 1, `out_quantity` = `out_quantity` + 1 WHERE `airwaybill` = '" . $item_airwaybill . "';");
				$messages_info[] = 'Item (' . $item_description . ') (' . $item_type . ') (' . $item_weight . ' ' . $item_weight_type . ') has been checked-out successfully.';
			}
		}
	}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
				<?php
					if(!empty($airwaybill) || !empty($partialAirwaybill)) {
						echo "<li class=\"breadcrumb-item\"><a href=\"" . $_SERVER['SCRIPT_NAME'] . "\">Cargo Inventory</a></li>";
						echo "<li class=\"breadcrumb-item active\"><strong>" . (empty($airwaybill) == true ? $partialAirwaybill : $airwaybill) . "</strong></li>";
					} else {
						echo "<li class=\"breadcrumb-item active\"><strong>Cargo Inventory</strong></li>";
					}
				?>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"><strong>
					<?php
					if(empty($airwaybill)) {
						echo "Cargo Inventory (Select an AirWayBill to view all items on that AirWayBill)";
					} else {
						echo "Cargo Inventory (Select an item (row) to edit or checkout that cargo item)";
					}
					?>
				</strong></div>
				<div class="card-block">
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
						if($messages_info) {
							echo '<div class="messages">';
							foreach ($messages_info as $key => $value) {
								echo '<div class="alert alert-info alert-dismissible" role="alert">
								<span class="glyphicon glyphicon-exclamation-sign"></span>';
								echo '<h4 class="alert-heading">NOTE:</h4>';
								echo '<button type="button" class="close" data-dismiss="alert" aria-tag="Close"><span aria-hidden="true">&times;</span></button>';
								echo $value . '</div>';
							}
							echo '</div>';
						}
					?>
					<?php
						if($messages_success) {
							echo '<div class="messages">';
							foreach ($messages_success as $key => $value) {
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
						if(empty($airwaybill)) {
							echo '<form id="airwaybill-search-form" name="airwaybill-search-form" action="" onsubmit="return checkSearchValue()">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search Air Way Bill #" name="search-airwaybill" id="search-airwaybill">
									<div class="input-group-btn">
										<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
									</div>
								</div>
							</form>';
						}
						else if(!empty($airwaybill)) {
							echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 form-control">';
							echo '<strong>Air Way Bill #:</strong> ' . $airwaybill . ' <strong>Consignee:</strong> ' . getConsigneeNameFromId(getAirWayBill($airwaybill)->getConsigneeId());
							echo '</div>';
						}
					?>
					<div class="table-responsive">
						<table class="table" id="cargoinventory">
							<thead>
								<tr>
								<?php
									if(empty($airwaybill)) {
										echo '<th class="active">Air Way Bill #</th>';
										echo '<th class="active">Carrier</th>';
										echo '<th class="active">Consignee</th>';
										echo '<th class="active">Type of Consignee</th>';
										echo '<th class="active">Item Quantity</th>';
										echo '<th class="active">Date Received</th>';
										echo '<th class="active">Checkout Levy</th>';
									} else {
										echo '<th class="active">Type of Cargo</th>';
										echo '<th class="active">Item Quantity</th>';
										echo '<th class="active">Item Description</th>';
										echo '<th class="active">Item Weight (KG)</th>';
										echo '<th class="active">Time of System Entry</th>';
										echo '<th class="active">Days In Cargo</th>';
										echo '<th class="active">Being Refrigerated Currently?</th>';
										echo '<th class="active">Time Refrigerated</th>';
									}
								?>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($results) == true) {
										for( $i = 0; $i < count( $results->data ); $i++ ) {
											if(empty($airwaybill)) {
												echo "<tr>";
												echo "<td><a href=" . $_SERVER['SCRIPT_NAME'] . "?airwaybill=" . $results->data[$i]['airwaybill'] . keepLinks('limit', 'page', 'links') . ">" . $results->data[$i]['airwaybill'] . "</a></td>";
												echo "<td>" . getCarrierNameFromId($results->data[$i]['carrier_id']) . "</td>";
												echo "<td>" . getConsigneeNameFromId($results->data[$i]['consignee_id']) . "</td>";
												echo "<td>" . getConsigneeTypeNameFromId($results->data[$i]['consignee_type_id']) . "</td>";
												echo "<td>" . $results->data[$i]['in_quantity'] . "</td>";
												echo "<td>" . $results->data[$i]['date_in'] . "</td>";
												echo "<td>$" . calculateAirWayBillCheckoutFee($results->data[$i]['airwaybill'], "in") . "</td>";
												echo "</tr>";
											} else {
												$airwaybillPtr = getAirWayBill($results->data[$i]['airwaybill']);
												$editingItemDateUnix = strtotime($airwaybillPtr->getDateIn());
												$editingItemDays = number_of_cargo_days($airwaybillPtr->getDateIn(), date('Y-m-d')); // date('Y-m-d', $editingItemDateUnix)
												echo "<tr class='clickable-row' data-href='" . $_SERVER['SCRIPT_NAME'] . "?airwaybill=" . $results->data[$i]['airwaybill'] . "&edit=" . $results->data[$i]['ID'] . keepLinks('limit', 'page', 'links') . "'>";
												echo "<td>" . $results->data[$i]['cargo_type'] . "</td>";
												echo "<td>" . $results->data[$i]['item_quantity'] . "</td>";
												echo "<td>" . $results->data[$i]['item_description'] . "</td>";
												echo "<td>" . $results->data[$i]['item_weight'] . "</td>";
												echo "<td>" . $results->data[$i]['date_in'] . "</td>";
												echo "<td>" . $editingItemDays . "</td>";
												if($results->data[$i]['refrigerated_unix']) {
													echo "<td>Yes</td>";
												} else {
													echo "<td>No</td>";
												}
												if($results->data[$i]['refrigerated_time']) {
													$cur_refrigerated_time = 0;
													if($results->data[$i]['refrigerated_unix']) {
														$cur_refrigerated_time += (time() - $results->data[$i]['refrigerated_unix']);
													}
													$cur_refrigerated_time += $results->data[$i]['refrigerated_time'];
													echo "<td>" . timeFormat($cur_refrigerated_time) . "</td>";
												} else {
													echo "<td>Never</td>";
												}
												echo "</tr>";
												if(!empty($editingId) && $editingId == $results->data[$i]['ID']) {
													$editingItemType = $results->data[$i]['cargo_type'];
													$editingItemQuantity = $results->data[$i]['item_quantity'];
													$editingItemDescription = $results->data[$i]['item_description'];
													$editingItemWeight = $results->data[$i]['item_weight'];
													$editingItemFee = calculateCheckoutFee($editingItemDays, getConsigneeTypeNameFromId($results->data[$i]['consignee_type_id']), $editingItemWeight, $results->data[$i]['cargo_type'], $results->data[$i]['refrigerated_time']);
													$editingItemRefrigeratedUnix = $results->data[$i]['refrigerated_unix'];
												}
											}
										}
									}
								?>
							</tbody>
						</table>
					</div>
					<?php echo $Paginator->createLinks( $links, 'pagination justify-content-center', count($results->data) ); ?>
				</div>
				<div class="form-group mb-0 text-center">
				 	<div class="modal fade" id="cargoEditModal" role="dialog" aria-labelledby="cargoEditModalLabel" aria-hidden="true">
					 	<div class="modal-dialog modal-lg" role="document">
						 	<form id="cargoEdit" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
							 	<div class="modal-content">
								 	<div class="modal-header">
										<h1 class="modal-title text-center" id="cargoEditModalLabel">Use the current item data below to edit or checkout the item:</h1>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								 	</div>
								 	<div class="modal-body">
									<div class="form-group">
										<input type="hidden" name="item-airwaybill" value="<?php echo $airwaybill; ?>">
										<input type="hidden" name="item-id" value="<?php echo $editingId; ?>">
										<tag for="air-way-bill-selection" class="form-control-label">AirWayBill #</tag>
										<select class="form-control" name="air-way-bill-selection" id="air-way-bill-selection" readonly disabled>
										<?php
											foreach($airwaybills as $value) {
												echo "<option value=\"" . $value->getName() . "\"";
												if($value->getName() == $airwaybill) {
													echo "selected";
												} else {
													echo "disabled";
												}
												echo ">" . $value->getName()  . "</option>";
											}
										?>
										</select>
									</div>
									<div class="form-group">
										<tag for="item-datetime" class="form-control-label">AirWayBill date/time:</tag>
										<input class="form-control" type="datetime-local" name="item-datetime" id="item-datetime" value="<?php echo date('Y-m-d', $editingItemDateUnix).'T'.date('h:i', $editingItemDateUnix);?>" readonly></input>
									</div>
									<div class="form-group">
										<tag for="item-type" class="form-control-label">Type:</tag>
										<select class="form-control" name="item-type" id="item-type" required>
										<?php
											foreach($cargotypes as $value) {
												echo "<option value=\"" . $value->getName() . "\"";
												if($value->getName() == $editingItemType) {
													 echo "selected";
												}
												echo ">" . $value->getName()  . "</option>";
											}
										?>
										</select>
									</div>
									<div class="form-group">
										<tag for="item-quantity" class="form-control-label">Quantity:</tag>
										<input class="form-control" type="number" name="item-quantity" id="item-quantity" value="<?=$editingItemQuantity; ?>" min="1" required></input>
									</div>
									<div class="form-group">
										<tag for="item-description" class="form-control-label">Description:</tag>
										<textarea class="form-control" name="item-description" id="item-description" required><?php echo $editingItemDescription; ?></textarea>
									</div>
									<div class="form-group">
										<tag for="item-datetime" class="form-control-label">Enter the items' weight:</tag>
										<input class="form-control" type="number" name="item-weight" id="item-weight" step="0.01" min="0" max="10000" <?php echo 'value="' . $editingItemWeight . '"'; ?>   required></input>
									</div>
									<div class="form-group">
										<tag for="item-weight-type" class="form-control-label">KG or Pounds (items will be stored as KG):</tag>
										<select class="form-control" name="item-weight-type" id="item-weight-type" required>
											<option value="kg" selected>KGS</option>
											<option value="lb">LBS (Pounds)</option>
										</select>
									</div>
									<div class="form-check">
										<tag for="item-refrigerated" class="form-check-label">
											<input type="checkbox" class="form-check-input" name="item-refrigerated" id="item-refrigerated" value="yes" <?php if($editingItemRefrigeratedUnix) { echo "checked"; } ?>>
											Is the item being refrigerated?
										</tag>
									</div>
									<div class="form-group">
										<tag for="item-days" class="form-control-label">Days In Cargo:</tag>
										<textarea class="form-control" rows="1" id="item-days" readonly><?php echo $editingItemDays ?></textarea>
									</div>
									<div class="form-group">
										<tag for="item-day-fee" class="form-control-label">Checkout Levy:</tag>
										<textarea class="form-control" id="item-day-fee" readonly><?php echo number_format($editingItemFee, 2, '.', ''); ?></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" name="cargoDelete" class="btn btn-danger mr-auto">DELETE</button>
									<button type="submit" name="cargoEdit" class="btn btn-success">EDIT</button>
									<button type="submit" name="cargoCheckout" class="btn btn-primary">CHECKOUT</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
								</div>
								</div>
							 	</div>
						 	</form>
					 	</div>
				 	</div>
				</div>
			</div>
		<div>
	</div>
</div>

<script type="text/javascript">
function checkSearchValue() {
	var x;
	x = document.getElementById("search-airwaybill").value;
	if (x == "") {
		alert("Please Enter a Valid Character.");
		return false;
	};
}

jQuery(document).ready(function($) {
	$(".clickable-row").click(function() {
		window.location = $(this).data("href");
	});
});

$('#cargoEditModal').on('shown.bs.modal', function () {
	var fieldInput = $('#item-description');
	var fieldLen = fieldInput.val().length;
	fieldInput.focus();
	fieldInput[0].setSelectionRange(fieldLen, fieldLen);
})

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 7000);
</script>

<?php

if(!empty($editingId)) {
	echo "<script type=\"text/javascript\">";
	echo "$(window).on('load',function(){";
	echo "$('#cargoEditModal').modal('show');";
	echo "});";
	echo "</script>";
}

?>

<?php require_once 'includes/footer.php';?>