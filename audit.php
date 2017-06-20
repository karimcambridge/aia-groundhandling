<?php require_once 'includes/header.php'; ?>

<?php
	include("includes/paginator.php");

	$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 50;
	$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
	$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 15;
	$Paginator  = new Paginator( $connectionHandle, "SELECT * FROM `". TABLE_AUDIT ."` ORDER BY `aia_audit`.`datetime` DESC" );

	$results    = $Paginator->getData( $limit, $page );

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
				<li class="breadcrumb-item active"><strong>Audit</strong></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong>Audit Log</strong>
				</div>
				<div class="card-block">
				<div class="table-responsive">
						<table class="table" id="cargoinventory">
							<thead>
								<tr>
									<th class="active">Account</th>
									<th class="active">Event Occured</th>
									<th class="active">Time</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($results) == true) {
										for( $i = 0; $i < count( $results->data ); $i++ ) {
											echo "<tr>";
											echo "<td>" . getAccountNameFromId($results->data[$i]['accountid']) . "</td>";
											echo "<td>" . $auditeventnames[$results->data[$i]['event_id']] . "</td>";
											echo "<td>" . $results->data[$i]['datetime'] . "</td>";
											echo "</tr>";
										}
									}
								?>
							</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once 'includes/footer.php'; ?>