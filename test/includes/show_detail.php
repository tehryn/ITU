<?php
	$prace = isset( $_GET['prace'] ) ? trim( $_GET['prace'] ) : '';
	if ( !$prace || isset( $_POST['zrusit_praci'] ) ) {
		if ( isset( $_POST['zrusit_praci'] ) ) {
			$ok = mysql_query( "DELETE FROM itu_h_prace where id = $prace" );
			echo '<p class="ok">Práce byla zrušena.</p>';
		}
		else {
			echo '<p class="error">Zvolená práce neexistuje.</p>';
		}
	}
	else {
		$id = 0;
		$nazev_skoly = '';
		$id_data = false;
		if ( $_SESSION['user'] ) {
			if ( $_SESSION['user']['kdo'] == 'student' ) {
				$id_data = mysql_query(
					"SELECT skola, itu_h_skoly.jmeno
					FROM itu_h_studenti, itu_h_skoly
					WHERE skola = itu_h_skoly.ID AND itu_h_studenti.email = '".$_SESSION['user']['email']."'"
				);
			}
			elseif ( $_SESSION['user']['kdo'] == 'skola' ) {
				$id_data = mysql_query(
					"SELECT ID as skola, jmeno
					FROM itu_h_skoly
					WHERE email = '".$_SESSION['user']['email']."'"
				);
			}
			if ( $id_data && $row = mysql_fetch_assoc( $id_data ) ) {
				$id          = $row['skola'];
				$nazev_skoly = $row['jmeno'];
			}
		}
		if ( isset( $_POST['registrovat_praci'] ) ) {
			$email = $_SESSION['user']['email'];
			$student = mysql_query( "SELECT ID FROM itu_h_studenti WHERE email = '$email'" );
			$student = mysql_fetch_assoc( $student );
			$student = $student['ID'];
			$ok = mysql_query( "INSERT INTO itu_s_prace_studenti( prace, student ) values( $prace, $student )" );
			if ( $ok ) {
				echo '<p class="ok">Žádost k registraci této práce byla úspěšně podána.</p>';
			}
		}
		if ( isset( $_POST['odregistrovat_praci'] ) ) {
			$email = $_SESSION['user']['email'];
			$student = mysql_query( "SELECT ID FROM itu_h_studenti WHERE email = '$email'" );
			$student = mysql_fetch_assoc( $student );
			$student = $student['ID'];
			$ok = mysql_query( "DELETE FROM itu_s_prace_studenti WHERE prace = $prace AND student = $student" );
			if ( $ok ) {
				echo '<p class="ok">Zrušil jste registraci k této práci.</p>';
			}
		}
		if ( isset( $_POST['schvalit_praci'] ) ) {
			$komentar = isset( $_POST['komentar'] ) ? trim( $_POST['komentar'] ) : 'NULL';
			$ok = mysql_query( "INSERT INTO itu_s_prace_skoly( prace, skola, komentar ) values( $prace, $id, '$komentar' )" );
			if ( $ok ) {
				echo '<p class="ok">Práce byla schválena.</p>';
			}
		}
		if ( isset( $_POST['odschvalit_praci'] ) ) {
			$ok = mysql_query( "DELETE FROM itu_s_prace_skoly WHERE prace = $prace AND skola = $id" );
			if ( $ok ) {
				echo '<p class="ok">Práce byla zrušena pro vaši školu.</p>';
			}
		}
		$prace_select = mysql_query(
			"SELECT DISTINCT
			  itu_h_prace.ID,
			  itu_h_prace.nazev,
			  itu_h_prace.plat,
			  itu_h_prace.zadani_strucne,
			  itu_h_prace.zadani_odkaz,
			  itu_h_mesta.nazev AS mesto,
			  itu_h_obory.nazev AS obor,
			  itu_h_firmy.nazev AS firma,
			  itu_h_firmy.email,
			  itu_h_firmy.telefon,
			  itu_h_firmy.mesto AS mesto_firma,
			  itu_h_firmy.ulice,
			  itu_h_firmy.psc,
			  itu_h_firmy.cislo_popisne,
			  itu_h_skoly.ID AS skola,
			  itu_s_prace_skoly.komentar
			FROM
			  itu_h_prace
			    LEFT JOIN itu_s_prace_mesta    ON itu_h_prace.ID    = itu_s_prace_mesta.prace
				LEFT JOIN itu_s_prace_skoly    ON itu_h_prace.ID    = itu_s_prace_skoly.prace
				LEFT JOIN itu_s_prace_podobory ON itu_h_prace.ID    = itu_s_prace_podobory.prace
				LEFT JOIN itu_h_mesta          ON itu_h_mesta.ID    = itu_s_prace_mesta.mesto
				LEFT JOIN itu_h_skoly          ON itu_h_skoly.ID    = itu_s_prace_skoly.skola
				LEFT JOIN itu_h_podobory       ON itu_h_podobory.ID = itu_s_prace_podobory.podobor
				LEFT JOIN itu_h_firmy          ON itu_h_firmy.ID    = itu_h_prace.zadavatel
				LEFT JOIN itu_h_obory          ON itu_h_obory.ID    = itu_h_podobory.obor
			WHERE
			  itu_h_prace.ID = $prace"
		);

		if ( $prace_select && mysql_num_rows( $prace_select ) > 0  ) {
			$mesta = array();
			$obory = array();
			$schvaleno_slolou = 'Ne';
			$last_row = '';
			$vyjadreni_sloly = '-- neuvedeno --';
			while ( $row = mysql_fetch_assoc( $prace_select ) ) {
				$last_row = $row;
				if ( $row['mesto'] != NULL ) {
					if ( !in_array( $row['mesto'], $mesta ) ) {
						array_push( $mesta, $row['mesto'] );
					}
				}
				if ( $row['obor'] != NULL ) {
					if ( !in_array( $row['obor'], $obory ) ) {
						array_push( $obory, $row['obor'] );
					}
				}
				if ( $row['skola'] != NULL && $row['skola'] == $id ) {
					$schvaleno_slolou = 'Ano';
					if ( $row['komentar'] ) {
						$vyjadreni_sloly  = $row['komentar'];
					}
				}
			}
			sort( $mesta );
			sort( $obory );
			$obory  = implode( '; ', $obory );
			$mesta  = implode( '; ', $mesta );
			$adresa = "-- neuvedeno --";
			$schvaleno_skolach = array();
			$skoly = mysql_query(
				"SELECT DISTINCT jmeno
				 FROM itu_s_prace_skoly INNER JOIN itu_h_skoly ON skola = itu_h_skoly.ID
				 WHERE itu_s_prace_skoly.prace = $prace
				 ORDER BY jmeno"
			);
			while ( $row = mysql_fetch_assoc( $skoly ) ) {
				array_push( $schvaleno_skolach, $row['jmeno'] );
			}
			$schvaleno_skolach = implode( '; ', $schvaleno_skolach );
			$schvaleno_skolach = $schvaleno_skolach ? $schvaleno_skolach : 'Práce nebyla zatím nikde schválena.';
			$data = mysql_query( " SELECT 1 FROM itu_s_prace_studenti WHERE prace = $prace" );
			$pocet_studentu_celkem = mysql_num_rows ( $data );
			$pocet_studentu_skola = 0;
			if ( $id ) {
				$email = $_SESSION['user']['email'];
				$student = mysql_query( "SELECT ID FROM itu_h_studenti WHERE email = '$email'" );
				$student = mysql_fetch_assoc( $student );
				$student = $student['ID'];
				$data = mysql_query(
					"SELECT 1
					 FROM itu_s_prace_studenti, itu_h_studenti
					 WHERE prace = $prace AND itu_h_studenti.ID = student AND skola = $id
				");
				$pocet_studentu_skola = mysql_num_rows( $data );
			}

			if ( $last_row['psc'] && $last_row['ulice'] && $last_row['cislo_popisne'] ) {
				$sidlo = mysql_query( "SELECT nazev FROM itu_h_mesta WHERE ID = ".$last_row['mesto_firma']);
				$row = mysql_fetch_assoc( $sidlo );
				$adresa = $last_row['ulice'].' '.$last_row['cislo_popisne'].', '.$last_row['psc'].' '.$row['nazev'];
			}
			echo '<h2>Téma: '.$last_row['nazev'].'</h2>';
			echo '
				<form method="post">
				<table class="neohranicena_tabulka">
					<tbody>
						<tr>
							<td>Název práce:</td>
							<td>'.$last_row['nazev'].'</td>
						</tr>
						<tr>
							<td>Obory:</td>
							<td>'.($obory?$obory:'-- neuvedeno --').'</td>
						</tr>
						<tr>
							<td>Vedoucí:</td>
							<td>'.$last_row['firma'].'</td>
						</tr>
						<tr>
							<td>Města:</td>
							<td>'.($mesta?$mesta:'-- neuvedeno --').'</td>
						</tr>
						<tr>
							<td class="lalign">Finanční ohodnocení:</td>
							<td>'.($last_row['plat']?$last_row['plat']:'Práce není finančně ohodnocena').'</td>
						</tr>
			';

			if ( $nazev_skoly ) {
				echo '
					<tr>
						<td class="lalign">Schváleno školou '.$nazev_skoly.':</td>
						<td>'.$schvaleno_slolou.'</td>
					</tr>
				';

			}

			echo '
						<tr>
							<td>Stručné zadání:</td>
							<td>
								'.$last_row['zadani_strucne'].'
							</td>
						</tr>
						<tr>
							<td class="top">Kompletní zadání:</td>
							<td><a href="'.$last_row['zadani_odkaz'].'"> <img class="icon_pdf_download" src="./pictures/pdf_download.png" alt="PDF_download"></td>
						</tr>
						<tr class="kontakt_info">
							<td class="top">Kontakt:</td>
							<td>
								<table class="kontakt_info">
									<tbody>
										<tr>
											<td>
												<h4>Email:</h4>
											</td>
											<td>
												<a href="mailto:'.$last_row['email'].'" class="mail_link">'.$last_row['email'].'</a>
											</td>
										</tr>
										<tr>
											<td>
												<h4>Telefon:</h4>
											</td>
											<td>
												'.($last_row['telefon']?$last_row['telefon']:'-- neuvedeno --').'
											</td>
										</tr>
										<tr>
											<td>
												<h4>Adresa:</h4>
											</td>
											<td>
												'.$adresa.'
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								Shváleno na školách:
							</td>
							<td>
								'.$schvaleno_skolach.'
							</td>
						</tr>
						<tr>
							<td>
								Počet zájemců:
							</td>
							<td>
								'.$pocet_studentu_celkem.'
							</td>
						</tr>

			';

			if ( $_SESSION['user'] ) {
				if ( $_SESSION['user']['kdo'] == 'student' ) {
					$email = $_SESSION['user']['email'];
					$student = mysql_query( "SELECT ID FROM itu_h_studenti WHERE email = '$email'" );
					$student = mysql_fetch_assoc( $student );
					$student = $student['ID'];
					$ok = mysql_query( "SELECT 1 FROM itu_s_prace_studenti WHERE student = $student AND prace = $prace" );
					$content  = "";
					if ( mysql_num_rows( $ok ) ) {
						$content  = '<p class="warning">K této práci jste registrován.</p>';
						$content .= '<input type="submit" name="odregistrovat_praci" value="Nemám zájem o tuto práci">';
					}
					else {
						$content .= '<input type="submit" name="registrovat_praci" value="Mám zájem o tuto práci">';
					}
					echo '
								<tr>
									<td>
										Počet zájemců na škole '.$nazev_skoly.':
									</td>
									<td>
										'.$pocet_studentu_skola.'
									</td>
								</tr>
								<tr>
									<td>
										Vyjádření školy '.$nazev_skoly.':
									</td>
									<td>
										'.$vyjadreni_sloly.'
									</td>
								</tr>
								<tr>
									<td colspan="2">
										'.$content.'
									</td>
								</tr>
							</tbody>
						</table>
						</form>
					';
				}
				elseif ( $_SESSION['user']['kdo'] == 'firma' && $_SESSION['user']['email'] == $last_row['email'] ) {
					$content = "";
					$disabled = "";
					if ( $pocet_studentu_celkem ) {
						$disabled = 'disabled';
						$content = '<p class="warning">Tuto práci nelze editovat ani odstranit, protože jsou k ní přihlášeni studenti.</p>';
					}
					echo '
								<tr>
									<td colspan="2">
										'.$content.'
										<input type="submit" name="upravit_praci" value="Upravit práci" '.$disabled.'>
										<input type="submit" name="zrusit_praci" value="Zrušit práci" '.$disabled.'>
									</td>
								</tr>
							</tbody>
						</table>
						</form>
					';
				}
				elseif ( $_SESSION['user']['kdo'] == 'skola' ) {
					$email = $_SESSION['user']['email'];
					$skola = mysql_query( "SELECT ID FROM itu_h_skoly WHERE email = '$email'" );
					$skola = mysql_fetch_assoc( $skola );
					$skola = $skola['ID'];
					$ok = mysql_query( "SELECT 1 FROM itu_s_prace_skoly WHERE skola = $skola AND prace = $prace" );
					$content = "";
					if ( mysql_num_rows( $ok ) ) {
						$disabled = $pocet_studentu_skola ? 'disabled' : '';
						$content  = '<p class="warning">Tato práce je již schválena na vaší škole.</p>';
						if ( $disabled ) {
							$content  .= '<p class="warning">Tuto práci nelze zrušit pro tuto školu, protože jsou k ní přihlášení studenti.</p>';
						}
						$content .= '<input type="submit" name="odschvalit_praci" value="Zrušit práci na naší škole" '.$disabled.'>';
					}
					else {
						$content  = '<textarea name="komentar" cols="80" rows="8" placeholder="Koméntář ke schválení..."></textarea><br>';
						$content .= '<input type="submit" name="schvalit_praci" value="Schválit práci na naší škole" >';
					}
					echo '
								<tr>
									<td>
										Počet zájemců na škole '.$nazev_skoly.':
									</td>
									<td>
										'.$pocet_studentu_skola.'
									</td>
								</tr>
								<tr>
									<td>
										Vyjádření školy '.$nazev_skoly.':
									</td>
									<td>
										'.$vyjadreni_sloly.'
									</td>
								</tr>
								<tr>
									<td colspan="2">
										'.$content.'
									</td>
								</tr>
							</tbody>
						</table>
						</form>
					';
				}
				else {
					echo '
							</tbody>
						</table>
						</form>
						<p class="warning">
							Tato práce nenáleží vaší firmě, nelze ji tedy editovat ani odstranit.
						</p>
					';
				}
			}
			else {
				echo '
						</tbody>
					</table>
					</form>
					<p class="warning">
						Pro registraci práce se musíte prvně <a href="registrace.php">registrovat</a> nebo <a href="prihlaseni.php">přihlásit</a>.
					</p>
				';
			}
			echo '

			';
		}
		else {
			echo '<p class="error">Zvolená práce neexistuje.</p>';
		}
	}
?>