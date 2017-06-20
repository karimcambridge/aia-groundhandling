<?php require_once 'includes/header.php'; ?>

<?php
	include("includes/paginator.php");

	$limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 12;
	$page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
	$links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 15;
	$Paginator  = new Paginator( $connectionHandle, "SELECT `accountid`, `event_id`, `datetime`, `data` FROM `". TABLE_EVENT_LOGS ."` ORDER BY `". TABLE_EVENT_LOGS ."`.`datetime` DESC" );

	$results    = $Paginator->getData( $limit, $page );

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
				<li class="breadcrumb-item active"><strong>Logs</strong></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong>Account Event Log</strong>
				</div>
				<div class="card-block">
					<div class="table-responsive">
						<table class="table" id="cargoinventory">
							<thead>
								<tr>
									<th class="active">Account</th>
									<th class="active">Event Occured</th>
									<th class="active">Time</th>
									<th class="active">Extra Information</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(isset($results) == true) {
										for( $i = 0; $i < count( $results->data ); $i++ ) {
											echo "<tr>";
											echo "<td>" . getAccountNameFromId($results->data[$i]['accountid']) . "</td>";
											echo "<td>" . $eventlognames[$results->data[$i]['event_id']] . "</td>";
											echo "<td>" . $results->data[$i]['datetime'] . "</td>";
											echo "<td>" . $results->data[$i]['data'] . "</td>";
											echo "</tr>";
										}
									}
								?>
							</tbody>
						</table>
					</div>
					<?php echo $Paginator->createLinks( $links, 'pagination justify-content-center', count($results->data) ); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once 'includes/footer.php'; ?>