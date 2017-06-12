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
    $query = "SELECT `airwaybills`.`count` AS `airwaybillcount` FROM `airwaybills` WHERE `airwaybill` = '$airwaybill'";
    if($result = $connectionHandle->query($query)) {
      if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $count = $row['airwaybillcount'] + 1;

        if($itemTypeId != -1) {
          $item_description = $connectionHandle->real_escape_string($item_description);
          if($item_weight_type == 'lb') {
            $item_weight *= 0.45359237;
          }
          $query = "INSERT INTO `cargo_inventory` (`airwaybill`, `cargo_type_id`, `item_description`, `item_weight`, `date_in`, `state`) VALUES ('$airwaybill', '$itemTypeId', '$item_description', '$item_weight', '$item_datetime', 1);";
          $query .= "UPDATE `airwaybills` SET `count` = `count` + 1 WHERE `airwaybills`.`airwaybill` = '" . $airwaybill . "';";

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
    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
    <li class="breadcrumb-item active"><strong>Cargo Insert</strong></li>
  </ol>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <!-- card-heading -->
      <div class="card-header">
        <span class="glyphicon glyphicon-check"></span> Cargo Insert
      </div>
      <!-- card-body -->
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
        <div class="text-center">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargoInsertModal">Insert Cargo</button>
        </div>
        <div class="form-group">
          <div class="modal fade" id="cargoInsertModal" role="dialog" aria-tagledby="cargoInsertModaltag" aria-hidden="true">
            <div class="modal-dialog" role="document">
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
                          echo ">" . $airwaybill->getName()  . " (" . $airwaybill->getDateIn() . ")</option>";
                        }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <tag for="item-datetime" class="form-control-tag">AirWayBill date/time:</tag>
                      <input type="datetime-local" name="item-datetime" id="item-datetime" value="<?php echo date('Y-m-d', $airwaybill->getDateInTimestamp()).'T'.date('h:i', $airwaybill->getDateInTimestamp());?>" required></input>
                      <span class="validity"></span>
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
                      <input type="number" name="item-weight" id="item-weight" step="0.01" min="0" max="1000" value="0.00" required></input>
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

<script type="text/javascript">
$(window).on('load',function(){
  $('#cargoInsertModal').modal('show');
});

$('#air-way-bill-selection').change(function(){
    if($(this).val() == 'Liatx970423') {
        console.log("test");
        //$('#item-datetime').val() = "test";
    }
});
</script>

<?php

if(isset($_SESSION['air-way-bill-selection'])) {
  unset($_SESSION['air-way-bill-selection']);
}

?>

<?php require_once 'includes/footer.php';?>