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
        header('location:http://127.00.1/groundopps/cargoinventory.php?airwaybill=' . $airwaybill);
        die();
      }
    }
  }

  $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 10;
  $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
  $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 15;
  $query      = 'SELECT `cargo_inventory`.`ID`, `airwaybill`, `cargo_item_types`.`cargo_type` AS `cargo_type`, `item_description`, `item_weight`, `date_in` FROM `cargo_inventory`, `cargo_item_types` WHERE `cargo_inventory`.`cargo_type_id` = `cargo_item_types`.`ID` ';
  if(!empty($airwaybill)) {
    $query    .= "AND `airwaybill` = '" . $airwaybill . "'";
  }
  $query      .= 'ORDER BY `date_in`,`airwaybill` DESC';
 
  $Paginator  = new Paginator( $connectionHandle, $query );

  $results    = $Paginator->getData( $limit, $page );

  if(isset($results) == true && !empty($editingId)) {
    $editingItemType;
    $editingItemDescription;
    $editingItemWeight;
    $editingItemDateUnix;
  }
  if(isset($_POST['cargoEdit']) || isset($_POST['cargoCheckout'])) {
    $item_id = $_POST['item-id'];
    if(!is_numeric($item_id)) {
      header('location:http://127.00.1/groundopps/cargoinventory.php?airwaybill=' . $airwaybill);
      die();
    }
    $item_datetime = $_POST['item-datetime']; // AirWayBill Date
    $item_type = $_POST['item-type'];
    $item_description = $_POST['item-description'];
    $item_weight = $_POST['item-weight'];
    $item_weight_type = $_POST['item-weight-type'];

    $itemTypeId = -1; // Cargo Type ID

    foreach($cargotypes as $cargotype) {
      if(strcmp($cargotype->getName(), $item_type) == 0) {
        $itemTypeId = $cargotype->getId();
      }
    }

    if($itemTypeId != -1) {
      $item_description = $connectionHandle->real_escape_string($item_description);
      if($item_weight_type == 'lb') {
        $item_weight = poundsToKG($item_weight);
      }
      if(isset($_POST['cargoEdit'])) {
        unset($_POST['cargoEdit']);
        $query = "UPDATE `cargo_inventory` SET `cargo_type_id` = " . $itemTypeId . ", `item_description` = '" . $item_description . "', `item_weight` = " . $item_weight . " WHERE `ID` = " . $item_id . ";";
        if($result = $connectionHandle->query($query)) {
          if($connectionHandle->errno) {
            $errors[] = 'Database Failed (' . $connectionHandle->error . ')';
          }
        }
      }
      else if(isset($_POST['cargoCheckout'])) {
        unset($_POST['cargoCheckout']);
        $connectionHandle->begin_transaction();
        $connectionHandle->query("INSERT INTO `cargo_out` (`ID`, `airwaybill`, `cargo_type_id`, `item_description`, `item_weight`, `date_in`) SELECT `ID`, `airwaybill`, `cargo_type_id`, `item_description`, `item_weight`, `date_in` FROM `cargo_inventory` WHERE `ID` = " . $item_id . ";");
        $connectionHandle->query("UPDATE `cargo_out` SET `date_out` = NOW() WHERE `ID` = " . $item_id . ";");
        $connectionHandle->query("DELETE FROM `cargo_inventory` WHERE `ID` = " . $item_id . ";");
        $connectionHandle->commit();
        sleep(1); // Sleep in order for the SQL to be updated so it won't fetch the data back on the inventory page on form refresh
      }
    }
  }
?>

<div class="row">
  <div class="col-md-12">
	 <ol class="breadcrumb">
	   <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <?php
        if(!empty($airwaybill)) {
          echo "<li class=\"breadcrumb-item\"><a href=\"" . $_SERVER['SCRIPT_NAME'] . "\">Cargo Inventory</a></li>";
          echo "<li class=\"breadcrumb-item active\"><strong>" . $airwaybill . "</strong></li>";
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
      <div class="card-header">
        <?php
        if(empty($airwaybill)) {
          echo "Cargo Inventory (Select an AirWayBill to view all items on that AirWayBill)";
        } else {
          echo "Cargo Inventory (Select an item (row) to edit or checkout that cargo item)";
        }
        ?>
      </div>
      <div class="card-block">
        <div class="table-responsive">
      	  <table class="table" id="cargoinventory">
      	  	<thead>
      	  		<tr>
      	  			<th class="active">Air Way Bill #</th>
                <th class="active">Type of Cargo</th>
                <th class="active">Item Description</th>
                <th class="active">Item Weight (KG)</th>
      	  			<th class="active">Date Received</th>
      	  		</tr>
      	  	</thead>
      	  	<tbody>
      	  		<?php
                if(isset($results) == true) {
                  for( $i = 0; $i < count( $results->data ); $i++ ) {
                    if(empty($airwaybill)) {
                      echo "<tr>";
                    } else {
                      echo "<tr class='clickable-row' data-href='" . $_SERVER['SCRIPT_NAME'] . "?airwaybill=" . $results->data[$i]['airwaybill'] . "&edit=" . $results->data[$i]['ID'] . keepLinks('limit', 'page', 'links') . "'>";
                    }
                    if(empty($airwaybill)) {
                      echo "<td><a href=" . $_SERVER['SCRIPT_NAME'] . "?airwaybill=" . $results->data[$i]['airwaybill'] . keepLinks('limit', 'page', 'links') . ">" . $results->data[$i]['airwaybill'] . "</a></td>";
                    } else {
                      echo "<td>" . $results->data[$i]['airwaybill'] . "</td>";
                    }
                    echo "<td>" . $results->data[$i]['cargo_type'] . "</td>";
                    echo "<td>" . $results->data[$i]['item_description'] . "</td>";
                    echo "<td>" . $results->data[$i]['item_weight'] . "</td>";
                    echo "<td>" . $results->data[$i]['date_in'] . "</td>";
                    echo "</tr>";
                    if(!empty($editingId) && $editingId == $results->data[$i]['ID']) {
                      $editingItemType = $results->data[$i]['cargo_type'];
                      $editingItemDescription = $results->data[$i]['item_description'];
                      $editingItemWeight = $results->data[$i]['item_weight'];
                      $editingItemDateUnix = strtotime($results->data[$i]['date_in']);
                    }
      	  		 	 }
                }
      	  		?>
      	  	</tbody>
      	  </table>
      	</div>
        <?php echo $Paginator->createLinks( $links, 'pagination justify-content-center' ); ?>
      </div>
      <div class="form-group">
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
                    <input type="hidden" name="item-id" value="<?php echo $editingId; ?>">
                    <tag for="air-way-bill-selection" class="form-control-label">AirWayBill #</label>
                    <select class="form-control" name="air-way-bill-selection" id="air-way-bill-selection" required>
                    <?php
                      foreach($airwaybills as $value) {
                        echo "<option value=\"" . $value->getName() . "\"";
                        if($value->getName() == $airwaybill) {
                          echo "selected";
                        } else {
                          echo "disabled";
                        }
                        echo ">" . $value->getName()  . " (" . $value->getDateIn() . ")</option>";
                      }
                    ?>
                    </select>
                   </div>
                   <div class="form-group">
                     <tag for="item-datetime" class="form-control-label">AirWayBill date/time:</label>
                     <input type="datetime-local" name="item-datetime" id="item-datetime" value="<?php echo date('Y-m-d', $editingItemDateUnix).'T'.date('h:i', $editingItemDateUnix);?>" required></input>
                     <span class="validity"></span>
                   </div>
                   <div class="form-group">
                     <tag for="item-type" class="form-control-label">Type:</label>
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
                     <tag for="item-description" class="form-control-label">Description:</label>
                     <textarea class="form-control" name="item-description" id="item-description" required><?php echo $editingItemDescription; ?></textarea>
                   </div>
                   <div class="form-group">
                     <tag for="item-datetime" class="form-control-label">Enter the items' weight:</label>
                     <input type="number" name="item-weight" id="item-weight" step="0.01" min="0" max="1000" <?php echo 'value="' . $editingItemWeight . '"'; ?>   required></input>
                   </div>
                   <div class="form-group">
                     <tag for="item-weight-type" class="form-control-label">KG or Pounds (items will be stored as KG):</label>
                     <select class="form-control" name="item-weight-type" id="item-weight-type" required>
                       <option value="kg" selected>KG</option>
                       <option value="lb">LBs (Pounds)</option>
                     </select>
                   </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="cargoEdit" class="btn btn-primary">Edit</button>
                    <button type="submit" name="cargoCheckout" class="btn btn-success">Checkout</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

$('#cargoEditModal').on('shown.bs.modal', function () {
  $('#item-description').focus();
})
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