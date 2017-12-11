<?php
	if ( $_SESSION['user'] == '' ) {
		$registrace = ( isset( $_POST['registrace'] ) ? trim( $_POST['registrace'] ) : '' );
		echo '
			<form method="post">
				<table class="neohranicena_tabulka">
					<tbody>
						<tr>
							<td>
								Registrovat se jako:
							</td>
							<td>
								<select name="registrace">
									<option value="student" '.($registrace=='student'?'selected':'').'>Student</option>
									<option value="skola" '.($registrace=='skola'?'selected':'').'>Škola</option>
									<option value="firma" '.($registrace=='firma'?'selected':'').'>Firma</option>
								</select>
								<input type="submit" name="zvolit" value="Zvolit">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			<form method="post">
		';
		if( $registrace == 'skola' ) {
			$email = ( isset( $_POST['email'] ) ? trim( $_POST['email'] ) : '' );
			$nazev = ( isset( $_POST['nazev'] ) ? trim( $_POST['nazev'] ) : '-- neuvedeno --' );

			echo '
				<p class="info">
					Pokud chcete registrovat školu do naší aplikace, dejte nám vědet na email
					<a href="mailto:xmatej52@stud.fit.vutbr.cz">xmatej52@stud.fit.vutbr.cz</a>
					nebo vyplně níže uvedený formulář a my se vám ozveme. Přímou registraci
					škol nepodporujeme, abychom zabránili vzniku falešných subjektů.
				</p>
			';

			if ( $email ) {
				mail(
					"xmatej52@stud.fit.vutbr.cz",
					"Registrace nove skoly",
					"Kontaktni email: $email, Nazev skoly: $nazev"
				);
				echo '
					<p class="ok">
						Vaše žádost o registraci bude brzy zpracována, ozveme
						se vám na vámi zadaný email.
					</p>
				';
			}

			echo '
					<table class="neohranicena_tabulka">
						<tbody>
							<tr>
								<td>
									Název školy:
								</td>
								<td>
									<input type="text" name="nazev">
								</td>
							</tr>
							<tr>
								<td>
									E-mail:
								</td>
								<td>
									<input type="email" name="email" class="required" required>
								</td>
							</tr>
							<tr>
								<td>
									<input type="hidden" name="registrace" value="'.$registrace.'">
									<input type="submit" name="potvrdit" value="Zažádat o registraci">
								</td>
							</tr>
						</tbody>
					</table>
			';
		}
		if( $registrace == 'firma' ) {
			$email = ( isset( $_POST['email'] ) ? trim( $_POST['email'] ) : '' );
			$nazev = ( isset( $_POST['nazev'] ) ? trim( $_POST['nazev'] ) : '-- neuvedeno --' );

			echo '
				<p class="info">
					Pokud chcete registrovat firmu do naší aplikace, dejte nám vědet na email
					<a href="mailto:xmatej52@stud.fit.vutbr.cz">xmatej52@stud.fit.vutbr.cz</a>
					nebo vyplně níže uvedený formulář a my se vám ozveme. Přímou registraci
					firem nepodporujeme, abychom zabránili vzniku falešných subjektů.
					<table class="neohranicena_tabulka">
				</p>
			';

			if ( $email ) {
				mail(
					"xmatej52@stud.fit.vutbr.cz",
					"Registrace nove firmy",
					"Kontaktni email: $email, Nazev skoly: $nazev"
				);
				echo '
					<p class="ok">
						Vaše žádost o registraci bude brzy zpracována, ozveme
						se vám na vámi zadaný email.
					</p>
				';
			}

			echo '
						<tbody>
							<tr>
								<td>
									Název firmy:
								</td>
								<td>
									<input type="text" name="nazev">
								</td>
							</tr>
							<tr>
								<td>
									E-mail:
								</td>
								<td>
									<input type="email" name="email" class="required" required>
								</td>
							</tr>
							<tr>
								<td>
									<input type="hidden" name="registrace" value="'.$registrace.'">
									<input type="submit" name="potvrdit" value="Zažádat o registraci">
								</td>
							</tr>
						</tbody>
					</table>
				</p>
			';
		}
		if ( $registrace == 'student' ) {
			$email      = ( isset( $_POST['email'] ) ? trim( $_POST['email'] ) : '' );
			$skola      = ( isset( $_POST['skola'] ) ? trim( $_POST['skola'] ) : '' );
			$heslo      = ( isset( $_POST['heslo'] ) ? trim( $_POST['heslo'] ) : '' );
			$jmeno      = ( isset( $_POST['heslo'] ) ? trim( $_POST['heslo'] ) : '' );
			$telefon    = ( isset( $_POST['telefon'] ) ? trim( $_POST['telefon'] ) : '' );
			$prijmeni   = ( isset( $_POST['prijmeni'] ) ? trim( $_POST['prijmeni'] ) : '' );

			if ( $email && $skola && $jmeno && $prijmeni && $heslo ) {
				$ucet_exists = mysql_query( "SELECT 1 FROM itu_h_ucty WHERE login = '$email'" );
				if ( mysql_num_rows( $ucet_exists ) > 0 ) {
					echo '<p class="error"> Zadaný email je již používán. </p>';
				}
				else {
					mysql_query( "BEGIN TRANSACTION" );
					$ok = mysql_query( "INSERT INTO itu_h_ucty( login, heslo ) values( '$email', '$heslo' )" );
					if ( $ok ) {
						$ok = mysql_query(
							"INSERT INTO
							 itu_h_studenti( email, jmeno, prijmeni, skola, telefon )
							 values( '$email', '$jmeno', '$prijmeni', $skola, '$telefon' )
							"
						);
					}
					if ( $ok ) {
						mysql_query("COMMIT");
						$_SESSION['user'] = array( 'email' => $email, 'kdo' => 'student' );
						header("Refresh:0");
					}
					else {
						echo '<p class="error">Některé ze zadaných údajů jsou neplatné.</p>';
						mysql_query("ROLLBACK");
					}
				}
			}
			echo '
				<table class="neohranicena_tabulka">
					<tbody>
						<tr>
							<td>
								E-mail:
							</td>
							<td>
								<input type="text" name="email" class="required" required>
							</td>
						</tr>
						<tr>
							<td>
								Heslo:
							</td>
							<td>
								<input class="required" type="password" name="heslo" required>
							</td>
						</tr>
						<tr>
							<td>
								Jméno:
							</td>
							<td>
								<input class="required" type="text" name="jmeno" required>
							</td>
						</tr>
						<tr>
							<td>
								Příjmení:
							</td>
							<td>
								<input class="required" type="text" name="prijmeni" required>
							</td>
						</tr>
						<tr>
							<td>
								Telefon:
							</td>
							<td>
								<input type="text" name="telefon">
							</td>
						</tr>
						<tr>
							<td>
								Škola:
							</td>
							<td>
								<select class="required" name="skola" required>
			';
			$skola        = ( isset( $_POST[ 'skola' ] ) ? trim( $_POST[ 'skola' ] ) : '' );
			$skoly_select = mysql_query( "SELECT ID, jmeno FROM itu_h_skoly" );
			if ( $skoly_select ) {
				while ( $row = mysql_fetch_assoc( $skoly_select) ) {
					if ( $podobor == $row['ID'] ) {
						echo '<option value="'.$row['ID'].'" selected>'.$row['jmeno'].'</option>';
					}
					else {
						echo '<option value="'.$row['ID'].'">'.$row['jmeno'].'</option>';
					}
				}
			}
			echo '
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<input type="hidden" name="registrace" value="'.$registrace.'">
								<input type="submit" name="registrovat" value="Registrovat se">
							</td>
						</tr>
					</tbody>
				</table>
				</form>
			';
		}

	}
	elseif ( $_SESSION['refresh'] ) {
		echo '<p class="ok">Registrace proběhla úspěšně</p>';
	}
	else {
		header( 'Location: index.php' );
	}
?>