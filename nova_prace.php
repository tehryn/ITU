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
				<h2>Zadání nové práce</h2>
				<p>
					Pomocí následujícího formuláře můžete vypsat nové téma pro práci.
					Každé téma spadá pod nějaké podobory. Podobory patří k oborům a budou
					následně doplněny automaticky. Města označujte pouze tehdy,
					pokud chcete omezit vypracování práce pro určité město, např.
					když vyžadujete pravidelné návštevy na pobočce firmy. Pokud
					neoznačíté jakékoliv město, práce bude označena jako přístupná ve všech
					lokalitách.
				</p>
				<?php include 'includes/create_project.php' ?>
			</div>
			<div id="footer">
				<a href="./index.php"><img src="./pictures/point_hand_left.png" class="icon_point_hand"><span>Zpět na úvod</span></a>
			</div>
		</div>
	</div>
</body>
</html>