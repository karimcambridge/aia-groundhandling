<?php require_once 'includes/header.php'; ?>

<?php

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
        <div class="text-center">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargoInsertModal">Insert Cargo</button>
        </div>
        <div class="form-group">
          <div class="modal fade" id="cargoInsertModal" role="dialog" aria-labelledby="cargoInsertModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title" id="cargoInsertModalLabel">Enter the item information:</h1>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                  <form action="php_action/cargoinsertdb.php" method="post" id="cargoInsert">
                    <div class="form-group">
                      <label for="item-datetime" class="form-control-label">Current date/time:</label>
                      <input type="datetime-local" name="item-datetime" id="item-datetime" value="<?php echo date('Y-m-d').'T'.date('h:i');?>" required></input>
                      <span class="validity"></span>
                    </div>
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
                      <label for="item-type" class="form-control-label">Type:</label>
                      <select class="form-control" name="item-type" id="item-type" required>
                      <?php
                        foreach($cargotypes as $cargotype) {
                          echo '<option value="' . $airwaybill->getName() . '">' . $cargotype->getName() . '</option>';
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
                      <label for="item-weight-type" class="form-control-label">KG (2.2 * 1 pound) or Pounds:</label>
                      <select class="form-control" name="item-weight-type" id="item-weight-type" required>
                        <option value="lb">LBs</option>
                        <option value="kg">KG</option>
                      </select>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Add to inventory</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
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