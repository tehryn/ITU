<?php
	if ( $_SESSION[ 'user' ] == '' ) {
		$email      = ( isset( $_POST['email'] ) ? trim( $_POST['email'] ) : '' );
		$heslo      = ( isset( $_POST['heslo'] ) ? trim( $_POST['heslo'] ) : '' );
		$prihlasit  = ( isset( $_POST['prihlasit'] ) ? trim( $_POST['prihlasit'] ) : false );
		if ( $email && $heslo && $prihlasit) {
			$student = mysql_query(
				"SELECT 1
				 FROM itu_h_studenti, itu_h_ucty
				 WHERE
				  itu_h_studenti.email = itu_h_ucty.login AND
				  itu_h_ucty.login     = '$email' AND
				  itu_h_ucty.heslo    = '$heslo'
				"
			);
			if ( $student && mysql_num_rows( $student ) > 0 ) {
				$_SESSION[ 'user' ] = array( 'email' => $email, 'kdo' => 'student' );
				header("Refresh:0");
			}
			else {
				$skola = mysql_query(
					"SELECT 1
					 FROM itu_h_skoly, itu_h_ucty
					 WHERE
					  itu_h_skoly.email = itu_h_ucty.login AND
					  itu_h_ucty.login  = '$email' AND
					  itu_h_ucty.heslo  = '$heslo'
					"
				);
				if ( $skola && mysql_num_rows( $skola ) > 0 ) {
					$_SESSION[ 'user' ] = array( 'email' => $email, 'kdo' => 'skola' );
					header("Refresh:0");
				}
				else {
					$firma = mysql_query(
						"SELECT 1
						 FROM itu_h_firmy, itu_h_ucty
						 WHERE
						  itu_h_firmy.email = itu_h_ucty.login AND
						  itu_h_ucty.login = '$email' AND
						  itu_h_ucty.heslo = '$heslo'
						"
					);
					if ( $firma && mysql_num_rows( $firma ) > 0 ) {
						$_SESSION[ 'user' ] = array( 'email' => $email, 'kdo' => 'firma' );
						header("Refresh:0");
					}
					else {
						echo '<p class="error"> Chybně zadaný E-mail nebo heslo </p>';
					}
				}
			}
		}
		elseif ( $prihlasit ) {
			echo '<p class="error"> Pro přihlášení musíte vyplnit E-mail a heslo </p>';
		}
		echo '
			<form method="post">
				<table class="neohranicena_tabulka prihlaseni">
					<tbody>
						<tr>
							<td>
								E-mail:
							</td>
							<td>
								<input name="email" type="email" value="'.$email.'">
							</td>
						</tr>
						<tr>
							<td>
								Heslo:
							</td>
							<td>
								<input name="heslo" type="password">
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" name="prihlasit" value="Přihlásit">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		';
	}
	else {
		echo '<p class="ok"> Přihlášení proběhlo úspěšně. </p>';
	}
?>









