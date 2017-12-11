<?php
	include 'includes/db.php';
	if ( !$_SESSION['user'] || $_SESSION['user']['kdo'] != 'firma' ) {
		header( 'Location: index.php' );
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include 'includes/head.php' ?>
		<title>Sunny Night</title>
	</head>
	<body>
		<div id="main-body">
			<?php include 'includes/header.php' ?>
			<div id="wrapper">
				<?php include 'includes/create_project.php' ?>
			</div>
		</div>
	</div>
</body>
</html>