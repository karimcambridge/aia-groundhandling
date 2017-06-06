<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<strong> Aircraft Carrier Service Fees </strong>
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
			  <label class="col-xs-1 col-sm-1 col-md-1 col-lg-2 control-label">Registration #<br><br></label>
			    <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
			      <input type="text" class="form-control" id="aircraftTurns" placeholder="Y000" autofocus required />
			    </div>
			  <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Flight #</label>
			    <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
			      <input type="text" class="form-control" id="aircraftFlight#" placeholder="LI000" required />
			    </div>
			  <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Owner / Carrier</label>
			    <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
			      <input type="text" class="form-control" id="aircraftCarrier" required />
			    </div>
			  <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Unscheduled?</label>
			    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 checkbox">
			  	  <input type="checkbox" id="unscheduled" onchange="onCalculateServiceFees()"/>
			    </div>
			  <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Aircraft Weight (KG)</label>
			    <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
			      <input type="number" class="form-control" id="aircraftWeight" min="0" placeholder="1000" required />
			    </div>
			  <label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Aircraft Type</label>
			    <select id="aircraftType" required>
			        <option value="narrowbody">Narrow Body</option>
			        <option value="widebody">Wide Body</option>
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
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Wheelchair<br><br></label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="quantityWheelchair" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="timeWheelchair" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
						</div></td>
					</tr>
					<tr>
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Airbridge</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="quantityAirbridge" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="timeAirbridge" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
						</div></td>
					</tr>
					<tr>
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Highlift Loader</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="quantityHL" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="timeHL" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
						</div></td>
					</tr>
					<tr>
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">GPU<br><br></label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="GPUQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="GPUTime" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
						</div></td>
					</tr>
					<tr>
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ACU</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="ACUQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="ACUTime" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
						</div></td>
					</tr>
					<tr>
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge Belt</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="BgeBeltQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="BgeBeltTime" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
						</div></td>
					</tr>
					<tr>
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Bge cart/dolly</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="BgeCartQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="BgeCartTime" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
						</div></td>
					</tr>
					<tr>
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Tractor</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="tractorQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="tractorTime" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
						</div></td>
					</tr>
					<tr>
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Pax Stairs</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="paxStairsQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="paxStairsTime" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
						</div></td>
					</tr>
					<tr>
						<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">AC Mntx equipment</label></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="ACMntxEquipmentQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
						</div></td>
						<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
					 		<input type="number" id="ACMntxEquipmentTime" min="0" max="24" value="0" onchange="onCalculateServiceFees()">
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
			    	<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Turns<br></label></td>
			    	<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			    	 	<input type="number" id="turnQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
			    	</div></td>
			      </tr>
			      <tr>
			      	<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Payload Mover</label></td>
			      	<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			      	 	<input type="number" id="payloadQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
			      	</div></td>
			      </tr>
			      <tr>
			    	<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Towbar<br><br></label></td>
			    	<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			    	 	<input type="number" id="towbarQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
			    	</div></td>
			      </tr>
			      <tr>
			    	<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">ASU</label></td>
			    	<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			    	 	<input type="number" id="ASUQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
			    	</div></td>
			      </tr>
			      <tr>
			    	<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Sewage Charge</label></td>
			    	<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			    	 	<input type="number" id="sewageQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
			    	</div></td>
			      </tr>
			      <tr>
			    	<td><label class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Portable Water</label></td>
			    	<td><div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			    	 	<input type="number" id="portableWaterQuantity" min="0" max="20" value="0" onchange="onCalculateServiceFees()">
			    	</div></td>
			      </tr>
			    </table>
			  </div>
			  <div class="clearfix"></div>
			  <div class="text-center">
			    <button type="button" class="btn btn-info top-buffer" onclick="onCalculateServiceFees()"><i class="glyphicon glyphicon-ok-sign"></i> Calculate Fees</button>
			  </div>
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