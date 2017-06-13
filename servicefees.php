<?php require_once 'includes/header.php'; ?>

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
				<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Registration #<br><br></label>
				<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
					<input type="text" class="form-control" id="aircraftTurns" placeholder="Y000" autofocus required />
				</div>
				<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Flight #</label>
				<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
					<input type="text" class="form-control" id="aircraftFlight#" placeholder="LI000" required />
				</div>
				<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Owner / Carrier</label>
				<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
					<select class="form-control" id="aircraftType" required>
					<option value="liat">LIAT</option>
					<option value="cal">CAL</option>
					<option value="dhl">DHL</option>
					<option value="fedex">Fedex</option>
					<option value="amerijet">AmeriJet</option>
					<option value="jetpack">JetPack</option>
					</select>
				</div>
				<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Unscheduled?</label>
				<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 checkbox">
					<input type="checkbox" id="unscheduled" onchange="onCalculateServiceFees()" />
				</div>
				<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Aircraft Weight (KG)</label>
				<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
					<input type="number" class="form-control" id="aircraftWeight" min="0" placeholder="1000" onchange="onCalculateServiceFees()" required />
				</div>
				<tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Aircraft Type</label>
				<select id="aircraftType" onchange="onCalculateServiceFees()" required>
					<option value="widebody">Wide Body</option>
					<option value="narrowbody">Narrow Body</option>
				</select>
				<div class="clearfix"></div>
				<div class="table-responsive col-md-3">
				<table>
					<tr>
						<th>Service</th>
						<th>Quantity Used</th>
						<th>Time Used (hrs)</th>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Wheelchair<br><br></label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="quantityWheelchair" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timeWheelchair" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Airbridge</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="quantityAirbridge" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timeAirbridge" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Highlift Loader</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="quantityHL" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timeHL" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">GPU<br><br></label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="quantityGPU" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timeGPU" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ACU</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="quantityACU" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timeACU" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge Belt</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="quantityBgeBelt" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timeBgeBelt" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge cart/dolly</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="quantityBgeCart" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timeBgeCart" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Tractor</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="quantityTractor" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timeTractor" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Pax Stairs</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="quantityPaxStairs" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timePaxStairs" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
					<tr>
						<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">AC Mntx equipment</label></td>
						<td><div class="col-xs-12 col-sm-s6 col-md-3 col-lg-3">
							<input type="number" id="quantityACMntxEquipment" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<input type="number" id="timeACMntxEquipment" min="0" max="24" value="0" onchange="onCalculateServiceFees()" />
						</div></td>
					</tr>
				</table>
				</div>
				<div class="table-responsive col-md-3">
				<table>
					<tr>
					<th>Service</th>
					<th>Pushes / Starts / Services</th>
					</tr>
					<tr>
					<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Turns<br></label></td>
					<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<input type="number" id="quantityTurns" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
					</div></td>
					</tr>
					<tr>
					<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Payload Mover</label></td>
					<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<input type="number" id="quantityPayload" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
					</div></td>
					</tr>
					<tr>
					<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Towbar<br><br></label></td>
					<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<input type="number" id="quantityTowbar" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
					</div></td>
					</tr>
					<tr>
					<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ASU</label></td>
					<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<input type="number" id="quantityASU" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
					</div></td>
					</tr>
					<tr>
					<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Sewage Charge</label></td>
					<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<input type="number" id="quantitySewage" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
					</div></td>
					</tr>
					<tr>
					<td><tag class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Portable Water</label></td>
					<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<input type="number" id="quantityPortableWater" min="0" max="20" value="0" onchange="onCalculateServiceFees()" />
					</div></td>
					</tr>
				</table>
				</div>
				<div class="clearfix"></div>
				<div class="text-center">
				<button type="button" class="btn btn-info top-buffer" onclick="onCalculateServiceFees()" /><span class="glyphicon glyphicon-ok-sign"></span> Calculate Fees</button>
				</div>
				<div class="servicefeeout text-center" id="servicefeeout"></div>
			</div>
			<!-- /card-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/servicefees.js"></script>

<?php require_once 'includes/footer.php'; ?>