<?php require_once 'includes/header.php'; ?>

<?php
	include("includes/paginator.php");

	$airwaybill;
	$editingId;

	if(isset( $_GET['airwaybill'] )) {
		$airwaybill = $_GET['airwaybill'];
		include 'custom/css/cargoedit.css';

		if(isset( $_GET['edit'] )) {
			$editingId = $_GET['edit'];
			if(!is_numeric($editingId)) {
				header('location:cargomovement.php?airwaybill=' . $airwaybill);
				die();
			}
		}
		$query      = 'SELECT `cargo_out`.`ID`, `airwaybill`, `cargo_item_types`.`cargo_type` AS `cargo_type`, `item_description`, `item_weight`, `date_in`, `date_out`, `refrigerated_time` FROM `cargo_out`, `cargo_item_types` WHERE `cargo_out`.`cargo_type_id` = `cargo_item_types`.`ID` ';
		if(!empty($airwaybill)) {
			$query  .= "AND `airwaybill` = '" . $airwaybill . "'";
		}
		$query      .= 'ORDER BY `date_in`,`airwaybill` DESC';
	} else {
		$query      = 'SELECT `ID`, `airwaybill`, `carrier_id`, `date_in`, `out_quantity` FROM `airwaybills` WHERE `out_quantity` > 0 ORDER BY `date_in` DESC, `ID` DESC';
	}

	$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 50;
	$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
	$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 15;
	$Paginator  = new Paginator( $connectionHandle, $query );

	$results    = $Paginator->getData( $limit, $page );

	if(empty($results->data)) {
		if(isset( $_GET['airwaybill'] )) {
			header('location:cargomovement.php');
			die();
		}
	}

	if(isset($results) == true && !empty($editingId)) {
		$editingItemType;
		$editingItemDescription;
		$editingItemWeight;
		$editingItemDateUnix;
		$editingItemDays;
		$editingItemFee;
	}
?>

<div class="row">
	<div class="col-md-12">
	 <ol class="breadcrumb">
		 <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
			<?php
				if(!empty($airwaybill)) {
					echo "<li class=\"breadcrumb-item\"><a href=\"" . $_SERVER['SCRIPT_NAME'] . "\">Cargo Movement</a></li>";
					echo "<li class=\"breadcrumb-item active\"><strong>" . $airwaybill . "</strong></li>";
				} else {
					echo "<li class=\"breadcrumb-item active\"><strong>Cargo Movement</strong></li>";
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
					echo "Cargo Movement (Select an AirWayBill to view all items on that AirWayBill)";
				} else {
					echo "Cargo Movement (Select an item (row) to view that cargo item information)";
				}
				?>
			</strong></div>
			<div class="card-block">
				<div class="table-responsive">
					<table class="table" id="cargomovement">
						<thead>
							<tr>
							<?php
								if(empty($airwaybill)) {
									echo '<th class="active">Air Way Bill #</th>';
									echo '<th class="active">Carrier</th>';
									echo '<th class="active">Item Quantity</th>';
									echo '<th class="active">Date Received</th>';
								} else {
									echo '<th class="active">Air Way Bill #</th>';
									echo '<th class="active">Type of Cargo</th>';
									echo '<th class="active">Item Description</th>';
									echo '<th class="active">Item Weight (KG)</th>';
									echo '<th class="active">Time of System Entry</th>';
									echo '<th class="active">Time of System Checkout</th>';
									echo '<th class="active">Days Was In Cargo</th>';
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
											echo "<td>" . $results->data[$i]['out_quantity'] . "</td>";
											echo "<td>" . $results->data[$i]['date_in'] . "</td>";
											echo "</tr>";
										} else {
											$airwaybillEx = getAirWayBill($results->data[$i]['airwaybill']);
											$editingItemDays = number_of_cargo_days(date('Y-m-d', $airwaybillEx->getDateInTimestamp()), date('Y-m-d', strtotime($results->data[$i]['date_out'])));

											echo "<tr class='clickable-row' data-href='" . $_SERVER['SCRIPT_NAME'] . "?airwaybill=" . $results->data[$i]['airwaybill'] . "&edit=" . $results->data[$i]['ID'] . keepLinks('limit', 'page', 'links') . "'>";
											echo "<td>" . $results->data[$i]['airwaybill'] . "</td>";
											echo "<td>" . $results->data[$i]['cargo_type'] . "</td>";
											echo "<td>" . $results->data[$i]['item_description'] . "</td>";
											echo "<td>" . $results->data[$i]['item_weight'] . "</td>";
											echo "<td>" . $results->data[$i]['date_in'] . "</td>";
											echo "<td>" . $results->data[$i]['date_out'] . "</td>";
											echo "<td>" . $editingItemDays . "</td>";
											if($results->data[$i]['refrigerated_time']) {
												echo "<td>" . timeFormat($results->data[$i]['refrigerated_time']) . "</td>";
											} else {
												echo "<td>None</td>";
											}
											echo "</tr>";
											if(!empty($editingId) && $editingId == $results->data[$i]['ID']) {
												$editingItemType = $results->data[$i]['cargo_type'];
												$editingItemDescription = $results->data[$i]['item_description'];
												$editingItemWeight = $results->data[$i]['item_weight'];
												$editingItemDateUnix = strtotime($results->data[$i]['date_in']);
												$editingItemDays = number_of_cargo_days($results->data[$i]['date_out'], $airwaybillEx->getDateIn());
												$editingItemFee = calculateCheckoutFee($editingItemDays, $editingItemWeight, $results->data[$i]['cargo_type'], $results->data[$i]['refrigerated_time']);
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
			 	<div class="modal fade" id="cargoInfoModal" role="dialog" aria-labelledby="cargoInfoModalLabel" aria-hidden="true">
				 	<div class="modal-dialog modal-lg" role="document">
					 	<form id="cargoEdit" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
						 	<div class="modal-content">
							 	<div class="modal-header">
									<h1 class="modal-title text-center" id="cargoInfoModalLabel">Use the current item data below to edit or checkout the item:</h1>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							 	</div>
							 	<div class="modal-body">
								<div class="form-group">
									<input type="hidden" name="item-id" value="<?php echo $editingId; ?>">
									<tag for="air-way-bill-selection" class="form-control-label">AirWayBill #</label>
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
									<tag for="item-datetime" class="form-control-label">AirWayBill date/time:</label>
									<input class="form-control" type="datetime-local" name="item-datetime" id="item-datetime" value="<?php echo date('Y-m-d', $editingItemDateUnix).'T'.date('h:i', $editingItemDateUnix);?>" readonly></input>
									<span class="validity"></span>
								</div>
								<div class="form-group">
									<tag for="item-type" class="form-control-label">Type:</label>
									<select class="form-control" name="item-type" id="item-type" readonly disabled>
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
									<tag for="item-description" class="form-control-label">Description:</label>
									<textarea class="form-control" name="item-description" id="item-description" readonly><?php echo $editingItemDescription; ?></textarea>
								</div>
								<div class="form-group">
									<tag for="item-datetime" class="form-control-label">Enter the items' weight:</label>
									<input class="form-control" type="number" name="item-weight" id="item-weight" step="0.01" min="0" max="10000" <?php echo 'value="' . $editingItemWeight . '"'; ?>   readonly></input>
								</div>
								<div class="form-group">
									<tag for="item-weight-type" class="form-control-label">KG or Pounds (items will be stored as KG):</label>
									<select class="form-control" name="item-weight-type" id="item-weight-type" readonly disabled>
										<option value="kg" selected>KG</option>
										<option value="lb">LBs (Pounds)</option>
									</select>
								</div>
								<div class="form-group">
									<tag for="item-days" class="form-control-label">Days In Cargo:</label>
									<textarea class="form-control" rows="1" id="item-days" readonly><?php echo $editingItemDays ?></textarea>
								</div>
								<div class="form-group">
									<tag for="item-day-fee" class="form-control-label">Checkout Levy:</label>
									<textarea class="form-control" id="item-day-fee" readonly><?php echo number_format($editingItemFee, 2, '.', ''); ?></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cargoInfoModalClose" name="cargoInfoModalClose">Close</button>
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

<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".clickable-row").click(function() {
		window.location = $(this).data("href");
	});
});

$('#cargoInfoModal').on('shown.bs.modal', function () {
	$('#cargoInfoModalClose').focus();
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
	echo "$('#cargoInfoModal').modal('show');";
	echo "});";
	echo "</script>";
}

?>

<?php require_once 'includes/footer.php';?>