<?php require_once 'includes/header.php'; ?>

<?php
	$mainSql = "SELECT `Airbill`, `STATUS`, `Carrier`, `Datein`, `dateout` FROM `aircargo`";
	$mainResult = $connect->query($mainSql);
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
      	  			<th class="active">Air Bill #</th>
      	  			<th class="active">Carrier</th>
      	  			<th class="active">Status</th>
      	  			<th class="active">Date received</th>
      	  			<th class="active">Days in cargo</th>
      	  			<th class="active">Date collected</th>
      	  			<th class="active">Cost</th>
      	  		</tr>
      	  	</thead>
      	  	<tbody>
      	  		<?php
      	  			while($row = $mainResult->fetch_assoc()) {
      	  				echo "<tr>";
    
      	  				echo "<td>" . $row['Airbill'] . "</td>";
      	  				echo "<td>" . $row['STATUS'] . "</td>";
      	  				echo "<td>" . $row['Carrier'] . "</td>";
      	  				echo "<td>" . $row['Datein'] . "</td>";
      	  				echo "<td>" . $row['dateout'] . "</td>";
    
      	  				echo "</tr>";
      	  			}
      	  			$mainResult->free();
      	  		?>
      	  	</tbody>
      	  </table>
      	</div>
      </div>
    </div>
  <div>
</div>

<?php require_once 'includes/footer.php';?>