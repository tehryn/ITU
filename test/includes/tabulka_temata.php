<?php
	echo '
		<form method="post">
		<table class="filtr">
			<tbody>
				<tr>
					<td>
						Obor:
					</td>
					<td>
						<select name="obor">
							<option value="0">-- nezvoleno --</option>
	';
		$obor         = ( isset( $_POST[ 'obor' ] ) ? trim( $_POST[ 'obor' ] ) : '' );
		$obory_select = mysql_query( "SELECT ID, nazev FROM itu_h_obory ORDER BY nazev" );
		if ( $obory_select ) {
			while ( $row = mysql_fetch_assoc( $obory_select ) ) {
				if ( $obor == $row['ID'] ) {
					echo '<option value="'.$row['ID'].'" selected>'.$row['nazev'].'</option>';
				}
				else {
					echo '<option value="'.$row['ID'].'">'.$row['nazev'].'</option>';
				}
			}
		}
	echo '
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Podobor:
					</td>
					<td>
						<select name="podobor">
							<option value="0">-- nezvoleno --</option>
	';
	$podobor         = ( isset( $_POST[ 'podobor' ] ) ? trim( $_POST[ 'podobor' ] ) : '' );
	$podobory_select = mysql_query( "SELECT ID, nazev FROM itu_h_podobory ORDER BY nazev" );
	if ( $podobory_select ) {
		while ( $row = mysql_fetch_assoc( $podobory_select ) ) {
			if ( $podobor == $row['ID'] ) {
				echo '<option value="'.$row['ID'].'" selected>'.$row['nazev'].'</option>';
			}
			else {
				echo '<option value="'.$row['ID'].'">'.$row['nazev'].'</option>';
			}
		}
	}
	echo '
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Škola:
					</td>
					<td>
						<select name="skola">
							<option value="0">-- nezvoleno --</option>
	';
	$skola        = ( isset( $_POST[ 'skola' ] ) ? trim( $_POST[ 'skola' ] ) : '' );
	$skoly_select = mysql_query( "SELECT ID, jmeno AS nazev FROM itu_h_skoly ORDER BY nazev" );
	if ( $skoly_select ) {
		while ( $row = mysql_fetch_assoc( $skoly_select) ) {
			if ( $skola == $row['ID'] ) {
				echo '<option value="'.$row['ID'].'" selected>'.$row['nazev'].'</option>';
			}
			else {
				echo '<option value="'.$row['ID'].'">'.$row['nazev'].'</option>';
			}
		}
	}
	echo '
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Firma:
					</td>
					<td>
						<select name="firma">
							<option value="0">-- nezvoleno --</option>
	';
	$firma        = ( isset( $_POST[ 'firma' ] ) ? trim( $_POST[ 'firma' ] ) : '' );
	$firma_select = mysql_query( "SELECT ID, nazev FROM itu_h_firmy ORDER BY nazev" );
	if ( $firma_select ) {
		while ( $row = mysql_fetch_assoc( $firma_select) ) {
			if ( $firma == $row['ID'] ) {
				echo '<option value="'.$row['ID'].'" selected>'.$row['nazev'].'</option>';
			}
			else {
				echo '<option value="'.$row['ID'].'">'.$row['nazev'].'</option>';
			}
		}
	}
	echo '
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Město:
					</td>
					<td>
						<select name="mesto">
							<option value="0">-- nezvoleno --</option>
	';
	$mesto        = ( isset( $_POST[ 'mesto' ] ) ? trim( $_POST[ 'mesto' ] ) : '' );
	$mesta_select = mysql_query( "SELECT ID, nazev FROM itu_h_mesta ORDER BY nazev" );
	if ( $mesta_select ) {
		while ( $row = mysql_fetch_assoc( $mesta_select ) ) {
			if ( $mesto == $row['ID'] ) {
				echo '<option value="'.$row['ID'].'" selected>'.$row['nazev'].'</option>';
			}
			else {
				echo '<option value="'.$row['ID'].'">'.$row['nazev'].'</option>';
			}
		}
	}
	echo '
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="omezit" value="omezit">
					</td>
				</tr>
			</tbody>
		</table>
		</form>
		<table id="keywords" class="ohranicena_tabulka">
			<thead>
				<tr>
					<th><span>Název práce</span><div class="arrow-up"></div><div class="arrow-down"></div></th>
					<th><span>Obory</span><div class="arrow-up"></div><div class="arrow-down"></div></th>
					<th><span>Zadavatel</span><div class="arrow-up"></div><div class="arrow-down"></div></th>
					<th><span>Města</span><div class="arrow-up"></div><div class="arrow-down"></div></th>
					<!-- <th><span>Finanční ohodnocení</span><div class="arrow-up"></div><div class="arrow-down"></div></th> -->
	';
	if ( $_SESSION['user'] && ($_SESSION['user']['kdo'] == 'student' || $_SESSION['user']['kdo'] == 'skola') ) {
		echo '<th><span>Schváleno školou</span><div class="arrow-up"></div><div class="arrow-down"></div></th>';

	}
	echo '
					<th><span>Podrobnosti</span><div class="arrow-up"></div><div class="arrow-down"></div></th>
				</tr>
			</thead>
			<tbody>
	';
	$where = "1 = 1";
	if ( $mesto ) {
		$where .= " AND (itu_h_mesta.ID IS NULL OR itu_h_mesta.ID = $mesto)";
	}
	if ( $obor ) {
		$where .= " AND itu_h_obory.ID = $obor";
	}
	if ( $podobor ) {
		$where .= " AND itu_s_prace_podobory.podobor = $podobor";
	}
	if ( $skola ) {
		$where .= " AND itu_h_skoly.ID = $skola";
	}
	if ( $firma ) {
		$where .= " AND itu_h_firmy.ID = $firma";
	}
 	$prace_select = mysql_query(
		"SELECT DISTINCT
		  itu_h_prace.ID,
		  itu_h_prace.nazev,
		  itu_h_prace.plat,
		  itu_h_mesta.nazev AS mesto,
		  itu_h_obory.nazev AS obor,
		  itu_h_firmy.nazev AS firma,
		  itu_h_skoly.ID AS skola
		FROM
		  itu_h_prace
		    LEFT JOIN itu_s_prace_mesta    ON itu_h_prace.ID    = itu_s_prace_mesta.prace
			LEFT JOIN itu_s_prace_skoly    ON itu_h_prace.ID    = itu_s_prace_skoly.prace
			LEFT JOIN itu_s_prace_podobory ON itu_h_prace.ID    = itu_s_prace_podobory.prace
			LEFT JOIN itu_h_mesta          ON itu_h_mesta.ID    = itu_s_prace_mesta.mesto
			LEFT JOIN itu_h_skoly          ON itu_h_skoly.ID    = itu_s_prace_skoly.skola
			LEFT JOIN itu_h_firmy          ON itu_h_firmy.ID    = itu_h_prace.zadavatel
			LEFT JOIN itu_h_podobory       ON itu_h_podobory.ID = itu_s_prace_podobory.podobor
			LEFT JOIN itu_h_obory          ON itu_h_obory.ID    = itu_h_podobory.obor
		WHERE
		  $where
		ORDER BY itu_h_prace.nazev, itu_h_obory.nazev, itu_h_firmy.nazev, itu_h_mesta.nazev"
	);

	$num_rows = mysql_num_rows( $prace_select );
	$id = 0;
	if ( $_SESSION['user'] && ($_SESSION['user']['kdo'] == 'student' || $_SESSION['user']['kdo'] == 'skola') ) {
		$id_data = mysql_query( "SELECT skola FROM itu_h_studenti WHERE email = '".$_SESSION['user']['email']."'" );
		if ( $id_data && ($row = mysql_fetch_assoc( $id_data ) ) ) {
		}
		else {
			$id_data = mysql_query( "SELECT ID AS skola FROM itu_h_skoly WHERE email = '".$_SESSION['user']['email']."'" );
			$row = mysql_fetch_assoc( $id_data );
		}
		$id = $row['skola'];
	}
	$prace = array();
	while ( $row = mysql_fetch_assoc( $prace_select ) ) {
		array_push( $prace, $row );
	}

	$mesta = array();
	$obory = array();
	$skoly = array();
	$next_row = "";
	$prev_id = 0;
	foreach ($prace as $row) {
		if ( $prev_id != $row['ID']  ) {
			$mesta = array();
			$obory = array();
			$schvaleno_slolou = 'Ne';
			foreach ( $prace as $next_row) {
				if ( $next_row['ID'] == $row['ID'] ) {
					if ( $next_row['mesto'] != NULL ) {
						if ( !in_array( $next_row['mesto'], $mesta ) ) {
							array_push( $mesta, $next_row['mesto'] );
						}
					}
					if ( $next_row['obor'] != NULL ) {
						if ( !in_array( $next_row['obor'], $obory ) ) {
							array_push( $obory, $next_row['obor'] );
						}
					}
					if ( $next_row['skola'] != NULL && $row['skola'] == $id ) {
						$schvaleno_slolou = 'Ano';
					}
				}
			}
			sort( $mesta );
			sort( $obory );
			$obory = implode( ',<br>', $obory );
			$mesta = implode( ',<br>', $mesta );

			echo '
				<tr>
					<td class="lalign">'.$row['nazev'].'</td>
					<td class="lalign nowrap"><span class="max_height">'.$obory.'</span></td>
					<td class="lalign nowrap">'.$row['firma'].'</td>
					<td class="lalign nowrap"><span class="max_height">'.$mesta.'</span></td>
					<!-- <td>'.$row['plat'].'</td> -->
			';
			if ( $id ) {
				echo '<td>'.$schvaleno_slolou.'</td>';
			}
			echo '
					<td><a href="./detail.php?prace='.$row['ID'].'"><img src="./pictures/detail_icon.png" class="icon_detail"></a></td>
				</tr>
			';
			$prev_id = $row['ID'];
		}
	}
	if ( $num_rows == 0 ) {
		if ( $id ) {
			echo '<tr><td colspan="6">Nenalezeny žádné odpovídající práce</td></tr>';
		}
		else {

			echo '<tr><td colspan="5">Nenalezeny žádné odpovídající práce</td></tr>';
		}
	}
	echo '
			</tbody>
		</table>
	';
?>