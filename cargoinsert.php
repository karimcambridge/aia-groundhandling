<?php require_once 'includes/header.php'; ?>

<?php

$errors = array();
$messages = array();

if(isset($_POST['cargoInsert'])) {
  $airwaybill = $_POST['air-way-bill-selection'];
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
  if($item_weight == 0.0) {
    $errors[] = 'Please enter an item weight.';
  } else {
    $sql = "SELECT COUNT(`airwaybill`) AS `airwaybillcount` FROM `cargo_inventory` WHERE `airwaybill` = '$airwaybill'";
    if($result = $connectionHandle->query($sql)) {
      if($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['airwaybillcount'];
        if($itemTypeId != -1) {
          $item_description = $connectionHandle->real_escape_string($item_description);
          if($item_weight_type == 'lb') {
            $item_weight *= 0.45359237;
          }

          $sql = "INSERT INTO `cargo_inventory` (`airwaybill`, `cargo_type_id`, `item_description`, `item_weight`, `date_in`, `state`, `count`) VALUES ('$airwaybill', '$itemTypeId', '$item_description', '$item_weight', '$item_datetime', 1, '$count')";
          
          if($result = $connectionHandle->query($sql)) {
            if($connectionHandle->insert_id == 0) {
              $errors[] = 'Database Failed (' . $result->error . ')';
            }
          }
          $_SESSION['air-way-bill-selection'] = $airwaybill;
          $messages[] = 'Item ' . $item_description . ' has been inserted in the cargo inventory under AirWayBill ' . $airwaybill . ' successfully.';
          unset($_POST['cargoInsert']);
        } else {
          $errors[] = 'Error finding selected Item Type ID ('. $item_type . '). Please report the issue.';
        }
      }
    }
  }
}

if(isset($_SESSION['air-way-bill-selection'])) {
  $previousAirWayBill = $_SESSION['air-way-bill-selection'];
} else {
  $previousAirWayBill = "";
}

?>
<div calss="row">
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li class="active"><strong>Cargo Insert</strong></li>
  </ol>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <span class="glyphicon glyphicon-check"></span> Cargo Insert
      </div>
      <!-- /panel-heading -->
      <div class="panel-body">
        <?php
          if($errors) {
            echo '<div class="messages">';
            foreach ($errors as $key => $value) {
              echo '<div class="alert alert-danger alert-dismissible" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign"></span>';
              echo '<h4 class="alert-heading">ERROR!</h4>';
              echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
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
              echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
              echo $value . '</div>';
            }
            echo '</div>';
          }
        ?>
        <div class="text-center">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargoInsertModal">Insert Cargo</button>
        </div>
        <div class="form-group">
          <div class="modal fade" id="cargoInsertModal" role="dialog" aria-labelledby="cargoInsertModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <form id="cargoInsert" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title" id="cargoInsertModalLabel">Enter the item information:</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                        <label for="air-way-bill-selection" class="form-control-label">Select AirWayBill #</label>
                        <select class="form-control" name="air-way-bill-selection" id="air-way-bill-selection" required>
                        <?php
                          foreach($airwaybills as $airwaybill) {
                            echo "<option value=\"" . $airwaybill->getName() . "\"";
                            if($airwaybill->getName() == $previousAirWayBill) {
                              echo "selected";
                            }
                            echo ">" . $airwaybill->getName() . "</option>";
                          }
                        ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="item-datetime" class="form-control-label">AirWayBill date/time:</label>
                        <input type="datetime-local" name="item-datetime" id="item-datetime" value="<?php echo date('Y-m-d').'T'.date('h:i');?>" required></input>
                        <span class="validity"></span>
                      </div>
                      <div class="form-group">
                        <label for="item-type" class="form-control-label">Type:</label>
                        <select class="form-control" name="item-type" id="item-type" required>
                        <?php
                          foreach($cargotypes as $cargotype) {
                            echo '<option value="' . $cargotype->getName() . '">' . $cargotype->getName() . '</option>';
                          }
                        ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="item-description" class="form-control-label">Description:</label>
                        <textarea class="form-control" name="item-description" id="item-description" required></textarea>
                      </div>
                      <div class="form-group">
                        <label for="item-datetime" class="form-control-label">Enter the items' weight:</label>
                        <input type="number" name="item-weight" id="item-weight" step="0.01" min="0" max="1000" value="0.00" required></input>
                      </div>
                      <div class="form-group">
                        <label for="item-weight-type" class="form-control-label">KG or Pounds (items will be stored as KG):</label>
                        <select class="form-control" name="item-weight-type" id="item-weight-type" required>
                          <option value="kg">KG</option>
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
      <!-- /panel-body -->
    </div>
  </div>
</div>

<script src="custom/js/showmodal.js"></script>

<?php

if(isset($_SESSION['air-way-bill-selection'])) {
  unset($_SESSION['air-way-bill-selection']);
}

?>

<?php require_once 'includes/footer.php';?>