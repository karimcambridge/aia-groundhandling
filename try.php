  <?php require_once 'includes/header.php'; ?>

     <form class="form-horizontal" action="function.php" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                             


                                <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"><strong>Reports</strong></div>
				<div class="card-block">
					<tag for="meeting"><strong>Starting Date:</strong> </tag><input id="meeting" type="date" value="2017-06-13"/>
					<tag for="meeting"><strong>End Date:</strong> </tag><input id="meeting" type="date" value="2017-07-23"/>

					<div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input type="submit" name="Export" class="btn btn-success" value="export to excel2"/>
                            </div>
                   </div>                    
            </form>           
 </div>

<?php require_once 'includes/footer.php'; ?>