<?php require_once 'includes/header.php'; ?>

<div calss="row">
  <ol class="breadcrumb">
    <li><a href="dashboard.php">Home</a></li>
    <li>Cargo Inventory</li>
    <li class="active"><strong>Cargo Insert</strong></li>
  </ol>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <span class="glyphicon glyphicon-check"></span> Cargo Insert
      </div>
      <!-- /panel-heading -->
      <div class="panel-body">
        <form class="form-inline" id="cargoInsert">
          <div class="form-group">
            <div class="modal fade" id="cargoInsertModal" role="dialog" aria-labelledby="cargoInsertModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="cargoInsertModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-group">
                        <label for="recipient-name" class="form-control-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="form-control-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /panel-body -->
    </div>
  </div>
</div>

<script src="custom/js/showmodal.js"></script>

<?php require_once 'includes/footer.php';?>