<?php require_once 'includes/header.php'; ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><strong>Settings</strong></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header"><strong><?php echo 'Hello ' . $_SESSION['accountUsername'] . '. You are a ' . USER_LEVEL_NAME[$_SESSION['accountLevel']] . ' User.'; ?></strong></div>
				<div class="card-block">
					<div class="row">
						<div class="col-lg-1">
							<h3>Users</h3>
							<button type="button" class="btn btn-outline-info" id="user-list-button">List</button>
							<button type="button" class="btn btn-outline-primary" id="user-add-button">Add</button>
							<button type="button" class="btn btn-outline-warning" id="user-disable-button">Disable</button>
							<button type="button" class="btn btn-outline-danger btn-sm" id="user-delete-button">Delete</button>
						</div>
						<div class="col-lg-2">
							<h3>Item Types</h3>
							<button type="button" class="btn btn-outline-info" id="itemtype-list-button">List</button>
							<button type="button" class="btn btn-outline-warning" id="itemtype-add-button">Add</button>
							<button type="button" class="btn btn-outline-danger btn-sm" id="itemtype-delete-button">Delete</button>
						</div>
						<div class="col-lg-1">
							<h3>Carrier</h3>
							<button type="button" class="btn btn-outline-info" id="carrier-list-button">List</button>
							<button type="button" class="btn btn-outline-warning" id="carrier-add-button">Add</button>
							<button type="button" class="btn btn-outline-danger btn-sm" id="carrier-delete-button">Delete</button>
						</div>
						<div class="col-lg-1">
							<h3>Consignee</h3>
							<button type="button" class="btn btn-outline-info" id="consignee-list-button">List</button>
							<button type="button" class="btn btn-outline-warning" id="consignee-add-button">Add</button>
							<button type="button" class="btn btn-outline-danger btn-sm" id="consignee-delete-button">Delete</button>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-1" id="user-group">
						</div>
						<div class="col-lg-2" id="item-type-group">
						</div>
						<div class="col-lg-1" id="carrier-group">
						</div>
						<div class="col-lg-1" id="consignee-group">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function ajaxListUsers() {
	var newUserDiv = undefined;
	$errList = 'Error. Invalid post.';
	$.ajax({
		type: "POST",
		url: "settings_getdata.php",
		data: "getusers=1",
		cache: false,
		success: function(data) {
			if(data.length && $errList.indexOf(data) == -1) {
				$("#user-div").remove();
				var newData = JSON.parse(data);
				if(newData.length > 0) {
					newUserDiv = $(document.createElement('div')).attr("id", 'user-div');
					console.log(newUserDiv);

					var htmlString = '<tag for="user-selection" class="form-control-label">Users</tag>' + '<select class="form-control" id="user-selection" name="user-selection" required>';

					for(var i = 0; i < newData.length; i += 4) {
						htmlString += '<option value="' + newData[i] + '">' + newData[i + 1] + '</option>';
					}
					htmlString += '</class>';

					newUserDiv.after().html(htmlString);
					newUserDiv.appendTo("#user-group");
				}
			} else {
				$("#user-div").remove();
			}
		}
	});
	return newUserDiv;
}

$(document).ready(function() {
	$('#user-list-button').click(function() {
		ajaxListUsers();
	});
	$('#user-add-button').click(function() {
		var userDiv = ajaxListUsers();
		//console.log(userDiv);
		if(userDiv != undefined) {
			var htmlString = '<tag for="user-selection" class="form-control-label">Users</tag>' + '<select class="form-control" id="user-selection" name="user-selection" required></class>';

			userDiv.after().html(htmlString);
			userDiv.appendTo("#user-group");
		}
	});
	$('#user-disable-button').click(function() {
		ajaxListUsers();
	});
	$('#user-delete-button').click(function() {
		ajaxListUsers();
	});
});

</script>

<?php require_once 'includes/footer.php'; ?>