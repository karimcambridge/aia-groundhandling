<?php require_once 'includes/header.php'; ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
				<li class="breadcrumb-item active"><strong>Service Fees</strong></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"><strong>Aircraft Carrier Service Fees</strong></div>
				<!-- /card-heading -->
				<div class="card-panel">
					<div class="col-md-4">
						<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Registration #</tag>
						<div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
							<input type="text" class="form-control" id="aircraftTurns" placeholder="Y000" autofocus required />
						</div>
						<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Flight #</tag>
						<div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
							<input type="text" class="form-control" id="aircraftFlight#" placeholder="LI000" required />
						</div>
						<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Owner / Carrier</tag>
						<div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
							<select class="form-control" id="aircraftType" required>
							<option value="liat">LIAT</option>
							<option value="cal">CAL</option>
							<option value="dhl">DHL</option>
							<option value="fedex">Fedex</option>
							<option value="amerijet">AmeriJet</option>
							<option value="jetpack">JetPack</option>
							</select>
						</div>
						<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Unscheduled?</tag>
						<div class="col-xs-8 col-sm-6 col-md-4 col-lg-4 checkbox">
							<input type="checkbox" id="unscheduled" onchange="onCalculateServiceFees()" />
						</div>
						<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Aircraft Weight (KG)</tag>
						<div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
							<input type="number" class="form-control" id="aircraftWeight" min="0" placeholder="1000" onchange="onCalculateServiceFees()" required />
						</div>
						<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Aircraft Type</tag>
						<select id="aircraftType" onchange="onCalculateServiceFees()" required>
							<option value="widebody">Wide Body</option>
							<option value="narrowbody">Narrow Body</option>
						</select>
					</div>
					<div class="col-md-8">
						<div class="col-md-4">
						<table>
							<tr>
								<th>Service</th>
								<th>Quantity Used</th>
								<th>Time Used (hrs)</th>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Wheelchair<br><br></tag></td>
								<td><div class="col-md-2">
									<input type="number" id="quantityWheelchair" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
								<td><div class="col-md-2">
									<input type="number" id="timeWheelchair" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Highlift Loader</tag></td>
								<td><div class="col-md-2">
									<input type="number" id="quantityHL" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
								<td><div class="col-md-2">
									<input type="number" id="timeHL" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">GPU<br><br></tag></td>
								<td><div class="col-md-2">
									<input type="number" id="quantityGPU" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
								<td><div class="col-md-2">
									<input type="number" id="timeGPU" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ACU</tag></td>
								<td><div class="col-md-2">
									<input type="number" id="quantityACU" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
								<td><div class="col-md-2">
									<input type="number" id="timeACU" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge Belt</tag></td>
								<td><div class="col-md-2">
									<input type="number" id="quantityBgeBelt" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
								<td><div class="col-md-2">
									<input type="number" id="timeBgeBelt" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge cart/dolly</tag></td>
								<td><div class="col-md-2">
									<input type="number" id="quantityBgeCart" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
								<td><div class="col-md-2">
									<input type="number" id="timeBgeCart" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Tractor</tag></td>
								<td><div class="col-md-2">
									<input type="number" id="quantityTractor" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
								<td><div class="col-md-2">
									<input type="number" id="timeTractor" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Pax Stairs</tag></td>
								<td><div class="col-md-2">
									<input type="number" id="quantityPaxStairs" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
								<td><div class="col-md-2">
									<input type="number" id="timePaxStairs" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">AC Mntx equipment</tag></td>
								<td><div class="col-xs-12 col-sm-s6 col-md-3 col-lg-3">
									<input type="number" id="quantityACMntxEquipment" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
								<td><div class="col-md-2">
									<input type="number" id="timeACMntxEquipment" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
								</div></td>
							</tr>
						</div>
						<div class="col-md-4">
							<tr>
								<th>Service</th>
								<th>Pushes / Starts / Services</th>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Turns<br></tag></td>
								<td><div class="col-md-2">
										<input type="number" id="quantityTurns" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
									</div>
								</td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Payload Mover</tag></td>
								<td><div class="col-md-2">
										<input type="number" id="quantityPayload" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
									</div>
								</td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Towbar<br><br></tag></td>
								<td><div class="col-md-2">
										<input type="number" id="quantityTowbar" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
									</div>
								</td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ASU</tag></td>
								<td><div class="col-md-2">
										<input type="number" id="quantityASU" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
									</div>
								</td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Sewage Charge</tag></td>
								<td><div class="col-md-2">
										<input type="number" id="quantitySewage" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
									</div>
								</td>
							</tr>
							<tr>
								<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Portable Water</tag></td>
								<td><div class="col-md-2">
										<input type="number" id="quantityPortableWater" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="text-center">
						<button type="button" class="btn btn-info top-buffer" onclick="onCalculateServiceFees()" /><span class="glyphicon glyphicon-ok-sign"></span> Calculate Fees</button>
					</div>
					<div class="servicefeeout text-center" id="servicefeeout"></div>
				</div>
				<!-- /card-panel -->
			</div>
		</div>
		<!-- /col-md-12 -->
	</div>
	<!-- /row -->
</div>

<script src="custom/js/servicefees.js"></script>

<?php require_once 'includes/footer.php'; ?>