<?php require_once 'includes/header.php'; ?>

<?php
	$shippingCompany = $_GET['shippingCompany'];
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<strong> <?php echo $shippingCompany ?> Service Fees </strong>
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				<form class="form-horizontal" role="form">
				  <div class="form-group">
					<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Aircraft Weight (KG)</label>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					  <input type="number" class="form-control" id="aircraftWeight" min="0" placeholder="1000 KG" onchange="onCalculateServiceFees()" autofocus />
					</div>
					<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Turns</label>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
					  <input type="number" class="form-control" id="aircraftTurns" min="0" max="10" placeholder="1000 KG" onchange="onCalculateServiceFees()" autofocus />
					</div>
					<div class="clearfix"></div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<table>
						<tr>
							<th><div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">Service</div></th>
							<th><div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">Quantity Used</div></th>
							<th><div class="col-xs-12 col-sm-6 col-md-3 col-lg-4">Time Used</div></th>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Payload Mover</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Highlift Loader</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">GPU</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ACU</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge Belt</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge cart/dolly</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Tractor</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Towbar</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Pax Stairs</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ASU</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">AC Mntx equipment</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Sewage Charge</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Portable Water</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Wheelchair</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="" min="0" max="24" value="0" onchange="onCalculateServiceFees()" onchange="onCalculateServiceFees()">
								</div>
							</td>
						</tr>
					</table>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				      <button type="button" class="btn btn-info top-buffer" onclick="onCalculateServiceFees()"><i class="glyphicon glyphicon-ok-sign"></i> Calculate Fees</button>
				    </div>
					</div>
				  </div>
				</form>
			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/report.js"></script>
<script src="custom/js/servicefees.js"></script>

<?php require_once 'includes/footer.php'; ?>