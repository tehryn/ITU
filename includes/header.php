<?php
	$registrace = '<li><a href="./registrace.php">Registrace</a></li><li><a href="./prihlaseni.php">Přihlášení</a></li>';
	$nova_prace = "";
	if ( $_SESSION['user'] ) {
		$registrace = '<li><a href="./odhlaseni.php">Odhlášení</a></li>';
		if ( $_SESSION['user']['kdo'] == 'firma' ) {
			$nova_prace = '<li><a href="./nova_prace.php">Vypsat práci</a></li>';
		}
	}
	echo '
		<div id="header">
			<a id="company-name" href="./index.php"><h1>Sunny Night</h1></a>
			<div id="menu-wrapper">
				<ul id="menu">
					<li><a href="./index.php">Domů</a></li>
					<li><a href="./prehled_temat.php">Přehled témat</a></li>
					'.$nova_prace.'
					<li><a href="./o_nas.php">O nás</a></li>
					'.$registrace.'
				</ul>
			</div>
		</div>
	';
?>
