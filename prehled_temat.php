<?php include 'includes/db.php' ?>

<!DOCTYPE html>
<html>
	<head>
		<?php include 'includes/head.php' ?>
		<title>Přehled odborných prací</title>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.14/js/jquery.tablesorter.min.js'></script>
		<script  src="js/javascript.js"></script>
	</head>
	<body>
		<div id="main-body">
			<?php include 'includes/header.php' ?>
			<div id="wrapper">
				<h2>Přehled odborných prací</h2>
				<p class="featureless">
					Zde si můžete vybrat, které práce Vás zajímají.
					V kolonce Obor a Podobor si můžete vybrat určité specifické odvětví.
					Díky kolonce Škola můžete vybrat témata, která byla schválena na Vaší škole.
					Kolonka Firma specifikuje všechny práce vytvořené danou firmou.
					Některé práce mohou být omezeny jen na určitá města, kvůli nutnosti osobních konzultací nebo práci na určité místě (např. laboratoři).
				</p>
				<?php include 'includes/tabulka_temata.php' ?>
			</div>
			<div id="footer">
				<a href="./index.php"><img src="./pictures/point_hand_left.png" class="icon_point_hand"><span>Zpět na úvod</span></a>
			</div>
		</div>
	</body>
</html>
