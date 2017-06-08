<?php require_once 'includes/header.php'; ?>

<?php
  include("includes/paginator.php");

  $useAirWayBill;
  if(isset( $_GET['airwaybill'] )) {
    $useAirWayBill = $_GET['airwaybill'];
  }

  $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 10;
  $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
  $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 15;
  $query      = 'SELECT `airwaybill`, `cargo_item_types`.`cargo_type` AS `cargo_type`, `item_description`, `item_weight`, `date_in`, `state` FROM `cargo_inventory`, `cargo_item_types` WHERE `cargo_inventory`.`cargo_type_id` = `cargo_item_types`.`ID` ';
  if(!empty($useAirWayBill)) {
    $query .= "AND `airwaybill` = '" . $useAirWayBill . "'";
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
      if(!empty($useAirWayBill)) {
        echo "<li><a href=\"" . $_SERVER['SCRIPT_NAME'] . "\">Cargo Inventory</a></li>";
        echo "<li class=\"active\"><strong>" . $useAirWayBill . "</strong></li>";
      } else {
        echo "<li class=\"active\"><strong>Cargo Inventory</strong></li>";
      }
    ?>
	</ol>
    <div class="panel panel-primary">
      <div class="panel-heading">Cargo Inventory</div>
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
      	  		 	 	echo "<tr>";

      	  		 	 	echo "<td><a href=" . $_SERVER['SCRIPT_NAME'] . "?airwaybill=" . $results->data[$i]['airwaybill'] . ">" . $results->data[$i]['airwaybill'] . "</a></td>";
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
          <div class="text-center">
            <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
          </div>
      	</div>
      </div>
    </div>
  <div>
</div>

<?php require_once 'includes/footer.php';?>