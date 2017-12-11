<?php
	$nazev     = isset( $_POST['nazev'] ) ? trim( $_POST['nazev'] ) : '';
	$plat      = isset( $_POST['plat'] ) ? trim( $_POST['plat'] ) : '';
	$zadani    = isset( $_POST['zadani'] ) ? trim( $_POST['zadani'] ) : '';
	$narocnost = isset( $_POST['narocnost'] ) ? trim( $_POST['narocnost'] ) : '';
	$file      = isset( $_POST['file'] ) ? trim( $_POST['file'] ) : '';
	$obory     = isset( $_POST['obory'] ) ? $_POST['obory'] : array();
	$mesta     = isset( $_POST['mesta'] ) ? $_POST['mesta'] : array();
	$podobory  = isset( $_POST['podobory'] ) ? $_POST['podobory'] : array();

	if ( $nazev && $zadani && $file ) {
		$ok = mysql_query( "SELECT ID from itu_h_firmy where email = '".$_SESSION['user']['email']."'" );
		$id = mysql_fetch_assoc( $ok );
		$zadavatel = $id['ID'];
		$prevodni_tabulka = Array(
			'ä'=>'a', 'Ä'=>'A', 'á'=>'a', 'Á'=>'A', 'à'=>'a','À'=>'A', 'ã'=>'a', 'Ã'=>'A', 'â'=>'a',
			'Â'=>'A', 'č'=>'c', 'Č'=>'C', 'ć'=>'c', 'Ć'=>'C', 'ď'=>'d', 'Ď'=>'D', 'ě'=>'e', 'Ě'=>'E',
			'é'=>'e', 'É'=>'E', 'ë'=>'e', 'Ë'=>'E', 'è'=>'e', 'È'=>'E', 'ê'=>'e', 'Ê'=>'E', 'í'=>'i',
			'Í'=>'I', 'ï'=>'i', 'Ï'=>'I', 'ì'=>'i', 'Ì'=>'I', 'î'=>'i', 'Î'=>'I', 'ľ'=>'l', 'Ľ'=>'L',
			'ĺ'=>'l', 'Ĺ'=>'L', 'ń'=>'n', 'Ń'=>'N', 'ň'=>'n', 'Ň'=>'N', 'ñ'=>'n', 'Ñ'=>'N', 'ó'=>'o',
			'Ó'=>'O', 'ö'=>'o', 'Ö'=>'O', 'ô'=>'o', 'Ô'=>'O', 'ò'=>'o', 'Ò'=>'O', 'õ'=>'o', 'Õ'=>'O',
			'ő'=>'o', 'Ő'=>'O', 'ř'=>'r', 'Ř'=>'R', 'ŕ'=>'r', 'Ŕ'=>'R', 'š'=>'s', 'Š'=>'S', 'ś'=>'s',
			'Ś'=>'S', 'ť'=>'t', 'Ť'=>'T', 'ú'=>'u', 'Ú'=>'U', 'ů'=>'u', 'Ů'=>'U', 'ü'=>'u', 'Ü'=>'U',
			'ù'=>'u', 'Ù'=>'U', 'ũ'=>'u', 'Ũ'=>'U', 'û'=>'u', 'Û'=>'U', 'ý'=>'y', 'Ý'=>'Y', 'ž'=>'z',
			'Ž'=>'Z', 'ź'=>'z', 'Ź'=>'Z'
		);
		$zadani_odkaz = strtr($nazev, $prevodni_tabulka);
		$zadani_odkaz = str_replace(' ', '_', $zadani_odkaz);
		$zadani_odkaz = './prace/'.$zadavatel.'_'.$zadani_odkaz;
		mysql_query( "START TRANSACTION" );
		$ok = mysql_query(
			"INSERT INTO itu_h_prace( nazev, plat, zadavatel, zadani_strucne, zadani_odkaz, casova_narocnost )
			 values('$nazev', '$plat', $zadavatel, '$zadani', '$zadani_odkaz', '$narocnost' )
			"
		);
		if ( $ok ) {
			$prace = mysql_insert_id($db);
		}
		foreach ($podobory as $podobor) {
			if ( !$ok ) {
				break;
			}
			else {
				$ok = mysql_query( "INSERT INTO itu_s_prace_podobory(podobor, prace) values( $podobor, $prace )" );
			}
		}
		foreach ($mesta as $mesto) {
			if ( !$ok ) {
				break;
			}
			else {
				$ok = mysql_query( "INSERT INTO itu_s_prace_mesta(mesto, prace) values( $mesto, $prace )" );
			}
		}
		if ( $ok ) {
			echo '<p class="ok">Práce byla vložena do systému.</p>';
			mysql_query("COMMIT");
		}
		else {
			echo '<p class="error">Zadané údaje nejsou platné.</p>';
			mysql_query("ROLLBACK");
		}
	}
	echo '
		<form method="post">
			<table class="neohranicena_tabulka">
				<tbody>
					<tr>
						<td>Název práce:</td>
						<td><input type="text" class="required" name="nazev" required></td>
					</tr>
					<tr>
						<td>Finanční ohodnocení:</td>
						<td><input type="text" name="plat"></td>
					</tr>
					<tr>
						<td>Časová náročnost:</td>
						<td><input type="text" name="narocnost"></td>
					</tr>
					<tr>
						<td>Stručné zadání:</td>
						<td>
							<textarea rows="12" cols="80" name="zadani" required></textarea>
						</td>
					</tr>
					<tr>
						<td>Kompletní zadání:</td>
						<td><input type="file" name="file" required></td>
					</tr>
					<tr>
						<td class="top">Podbory:</td>
						<td class="bunka_s_tabulkou">
							<table class="tabulka_vyber">
								<tbody>
	';
	$podobory_select = mysql_query( "SELECT ID, nazev FROM itu_h_podobory ORDER BY nazev" );
	if ( $podobory_select ) {
		$i     = 0;
		$frist = true;
		while ( $row = mysql_fetch_assoc( $podobory_select ) ) {
			if ( $i == 0 ) {
				echo '<tr>';
			}
			echo '
				<td >
					<input type="checkbox" name="podobory[]" value="'.$row['ID'].'">
					'.$row['nazev'].'
				</td>
			';
			$i++;
			if ( $i == 3) {
				echo '</tr>';
				$i = 0;
			}
		}
		if ( $i != 0 ) {
			echo '</tr></tbody></table>';
		}
		else {
			echo '</tbody></table>';
		}
	}
	echo '
						</td>
					</tr>
					<tr>
						<td class="top">Města:</td>
						<td class="bunka_s_tabulkou">
							<table class="tabulka_vyber">
								<tbody>
	';
	$mesta = mysql_query( "SELECT ID, nazev FROM itu_h_mesta ORDER BY nazev" );
	if ( $mesta ) {
		$i     = 0;
		$frist = true;
		while ( $row = mysql_fetch_assoc( $mesta ) ) {
			if ( $i == 0 ) {
				echo '<tr>';
			}
			echo '
				<td >
					<input type="checkbox" name="mesta[]" value="'.$row['ID'].'">
					'.$row['nazev'].'
				</td>
			';
			$i++;
			if ( $i == 6) {
				echo '</tr>';
				$i = 0;
			}
		}
		if ( $i != 0 ) {
			echo '</tr></tbody></table>';
		}
		else {
			echo '</tbody></table>';
		}
	}
	echo '
								</tbody>
							</table>
						</td>
					<tr>
					<tr>
						<td><input type="submit" name="vytvorit" value="Vytvořit" required></td>
					</tr>
				</tbody>
			</table>
		</form>
	';
?>