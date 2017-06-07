<?php require_once 'includes/header.php'; ?>

<?php
  include("includes/paginator.php");

  $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 10;
  $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
  $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 15;
  $query      = "SELECT `airwaybill`, `state`, `date_in`, `date_out`, `item_weight` FROM `cargo_inventory`";
 
  $Paginator  = new Paginator( $connectionHandle, $query );

  $results    = $Paginator->getData( $limit, $page );
?>

<div class="row">
  <div class="col-md-12">
	<ol class="breadcrumb">
	  <li><a href="dashboard.php">Home</a></li>
	  <li class="active"><strong>Cargo Inventory</strong></li>
	</ol>
    <div class="panel panel-primary">
      <div class="panel-heading">Cargo Inventory</div>
      <div class="panel-body">
        <div class="table-responsive">
      	  <table class="table" id="cargoinventory">
      	  	<thead>
      	  		<tr>
      	  			<th class="active">Air Way Bill #</th>
      	  			<th class="active">State</th>
      	  			<th class="active">Date Received</th>
      	  			<th class="active">Item Weight</th>
      	  		</tr>
      	  	</thead>
      	  	<tbody>
      	  		<?php
                if(isset($results) == true) {
      	  		 	 for( $i = 0; $i < count( $results->data ); $i++ ) {
      	  		 	 	echo "<tr>";

      	  		 	 	echo "<td>" . $results->data[$i]['airwaybill'] . "</td>";
      	  		 	 	echo "<td>" . $results->data[$i]['state'] . "</td>";
      	  		 	 	echo "<td>" . $results->data[$i]['date_in'] . "</td>";
      	  		 	 	echo "<td>" . $results->data[$i]['item_weight'] . "</td>";

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