<?php require_once 'includes/header.php'; ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active"><strong>Settings</strong></li>
			</ol>
		</div>
	</div>
</div>

<?php echo 'Hello ' $_SESSION['accountUsername'] . '. You are of level ' . USER_LEVEL_NAME[$_SESSION['accountLevel']]; ?>

<?php require_once 'includes/footer.php'; ?>