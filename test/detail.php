<?php include 'includes/db.php' ?>

<!DOCTYPE html>
<html>
	<head>
		<?php include 'includes/head.php' ?>
		<title>Přehled odborných prací</title>
	</head>
	<body>
		<div id="main-body">
			<?php include 'includes/header.php' ?>
			<div id="wrapper">
				<?php include 'includes/show_detail.php' ?>
			</div>
			<div id="footer">
				<table>
					<tbody>
						<tr>
							<td>
								<a href="./prehled_temat.php"><img src="./pictures/point_hand_left.png" class="icon_point_hand" alt="prehled_footer"><span>Zpět na přehled prací</span></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href="./index.php"><img src="./pictures/point_hand_left.png" class="icon_point_hand" alt="index_footer"><span>Zpět na úvod</span></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>
