<?php require_once 'includes/header.php'; ?>
	
<div calss="row">  
	<div calss="col-md-12">
		<ol class="breadcrumb">
			<li><a href="dashboard.php">Home</a></li>
			<li class="active"><strong>Caribbean Airlines cargo</li>
		</ol>

	
	<div class="panel panel-default">
  <div class="panel-heading">Cargo </div>
  <div class="panel-body">
    <div class="div-action pull pull-right"style="padding-bottom:20px;">
	 </div><!-- /div-action -->
	 	<?php
	 		$mainSql = "SELECT `Airbill`, `STATUS`, `Carrier`, `Datein`, `dateout` FROM `aircargo`";
			$mainResult = $connect->query($mainSql);
  		?>
		<table class="table" id="CALCARGO">
			<thead>
				<tr>
					<th>Air Bill #</th>
					<th>Carrier</th>
					<th>Status</th>
					<th>Date received</th>
					<th>Days in cargo</th>
					<th>Date collected</th>
					<th>COST</th>
				</tr>
				<?php 
					while($row = $mainResult->fetch_assoc())
					{
						echo "<tr>";

						echo "<td>" . $row['Airbill'] . "</td>";
						echo "<td>" . $row['STATUS'] . "</td>";
						echo "<td>" . $row['Carrier'] . "</td>";
						echo "<td>" . $row['Datein'] . "</td>";
						echo "<td>" . $row['dateout'] . "</td>";

						echo "</tr>";
					}
				?>
			</thead>
			
		</table>
  </div>
</div>

<?php require_once 'includes/footer.php';?>