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
					
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once 'includes/footer.php'; ?>