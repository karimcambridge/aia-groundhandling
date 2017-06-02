<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<STRONG> LIAT Fees </STRONG>
			</div>
			<!-- /panel-heading -->
			<div class="panel-body">
				<table>
				<form class="form-inline" action="" method="post" id="">
				  <div class="form-group">
				    <label class="col-sm-1 control-label">Aircraft Weight</label>
				    <div class="col-xs-12 col-sm-6 ">
				      <input type="text" class="form-control" id="" name="" placeholder="1000 KG" autofocus />
				    </div>
				  </div>
			</div>
			<div class="panel-body">
			    <div class="form-group">
						<div class="checkbox">
							<label></label>
						</div>
					<div class="checkbox">
					  <label><input type="checkbox" value="">Payload Mover</label>
 						<label></label> <label></label> <label><input type="checkbox" value="">Payload Mover</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">Highlift Loader</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">GPU</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">ACU</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">Bge Belt</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">Bge cart/dolly</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">Tractor</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">Towbar</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">Pax Stairs</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">ASU</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">AC Mntx equipment</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">Sewage Charge</label>
				  </div>
				  <div class="checkbox">
					  <label><input type="checkbox" value="">Portable Water</label>
				  </div>
                </div>
				  <div class="form-group">
				    <div class="col-sm-offset-5 col-sm-4">
				      <button type="submit" class="btn btn-info top-buffer" id="generateReportBtn"><i class="glyphicon glyphicon-ok-sign"></i> Calculate Fees</button>
				    </div>
				  </div>
				</form>
				</table>

			</div>
			<!-- /panel-body -->
		</div>
	</div>
	<!-- /col-dm-12 -->
</div>
<!-- /row -->

<script src="custom/js/report.js"></script>

<?php require_once 'includes/footer.php'; ?>
