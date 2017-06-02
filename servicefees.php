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
					<label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Aircraft Weight</label>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					  <input type="text" class="form-control" id="" name="" placeholder="1000 KG" required="required" autofocus />
					</div>
					<div class="clearfix"></div>

					<table>
						<tr>
							<th><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">Service</div></th>
							<th><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">Quantity Used</div></th>
							<th><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">Time Used</div></th>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Payload Mover</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Highlift Loader</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">GPU</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ACU</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge Belt</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge cart/dolly</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Tractor</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Towbar</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Pax Stairs</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ASU</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">AC Mntx equipment</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Sewage Charge</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Portable Water</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
						<tr>
							<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Wheelchair</label></td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="20" value="0">
								</div>
							</td>
							<td>
								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						 			<input type="number" name="quantity" min="0" max="24" value="0">
								</div>
							</td>
						</tr>
					</table>
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
<script src="custom/js/spinner.js"></script>

<?php require_once 'includes/footer.php'; ?>