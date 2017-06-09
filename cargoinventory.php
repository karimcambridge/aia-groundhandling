<?php require_once 'includes/header.php'; ?>

<?php
  include("includes/paginator.php");

  $airwaybill;
  if(isset( $_GET['airwaybill'] )) {
    $airwaybill = $_GET['airwaybill'];
    include 'custom/css/cargoedit.css';
  }

  $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 10;
  $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
  $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 15;
  $query      = 'SELECT `airwaybill`, `cargo_item_types`.`cargo_type` AS `cargo_type`, `item_description`, `item_weight`, `date_in`, `state` FROM `cargo_inventory`, `cargo_item_types` WHERE `cargo_inventory`.`cargo_type_id` = `cargo_item_types`.`ID` ';
  if(!empty($airwaybill)) {
    $query .= "AND `airwaybill` = '" . $airwaybill . "'";
  }
  $query .= 'ORDER BY `date_in`,`airwaybill` DESC';
 
  $Paginator  = new Paginator( $connectionHandle, $query );

  $results    = $Paginator->getData( $limit, $page );
?>

<div class="row">
  <div class="col-md-12">
	<ol class="breadcrumb">
	  <li><a href="dashboard.php">Home</a></li>
    <?php
      if(!empty($airwaybill)) {
        echo "<li><a href=\"" . $_SERVER['SCRIPT_NAME'] . "\">Cargo Inventory</a></li>";
        echo "<li class=\"active\"><strong>" . $airwaybill . "</strong></li>";
      } else {
        echo "<li class=\"active\"><strong>Cargo Inventory</strong></li>";
      }
    ?>
	</ol>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <?php
        if(empty($airwaybill)) {
          echo "Cargo Inventory (Select an AirWayBill to view all items on that AirWayBill)";
        } else {
          echo "Cargo Inventory (Select a row to edit or checkout that cargo item)";
        }
        ?>
      </div>
      <div class="panel-body">
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
                      echo "<tr class='clickable-row' data-href='url://' data-toggle='modal' data-id='". $results->data[$i]['airwaybill'] . "' data-target='#cargoEditModal'>";
                    }
    
                    echo "<td><a href=" . $_SERVER['SCRIPT_NAME'] . "?airwaybill=" . $results->data[$i]['airwaybill'] . ">" . $results->data[$i]['airwaybill'] . "</a></  td>";
                    echo "<td>" . $results->data[$i]['cargo_type'] . "</td>";
                    echo "<td>" . $results->data[$i]['item_description'] . "</td>";
                    echo "<td>" . $results->data[$i]['item_weight'] . "</td>";
                    echo "<td>" . $results->data[$i]['date_in'] . "</td>";
                    echo "</tr>";
      	  		 	 }
                }
      	  		?>
      	  	</tbody>

      	  </table>
          <div class="form-group">
          <div class="modal fade" id="cargoEditModal" role="dialog" aria-labelledby="cargoEditModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <form id="cargoEdit" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title text-center" id="cargoEditModalLabel">Use the current item data below to edit or checkout the item:</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
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
          <div class="text-center">
            <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
          </div>
      	</div>
      </div>
    </div>
  <div>
</div>

<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

<?php require_once 'includes/footer.php';?>