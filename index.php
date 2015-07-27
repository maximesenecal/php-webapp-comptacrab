<?php
include 'header.php';
?>
<div class="container">
<img src="img/comptaCrab-essayez-nous.png" class="img-responsive" alt="Responsive image Essayez nous">
</div>
<?php
if(!empty($_POST)) {
	$email    = Securite::bdd($_POST['identification_nom']);
	$password = sha1(Securite::bdd($_POST['identification_password']));					
	$q        = array(
		'email' => $email,
		'password' => $password
		);
	$sql      = 'SELECT email, pass FROM users WHERE email = :email AND pass = :password';
	try{
		$req = $cnx->prepare($sql);
	}catch(Exception $e){
		echo 'Erreur : '.$e->getMessage().'<br />';
		echo 'N° : '.$e->getCode();
	}
	$req->execute($q);

	$count = $req->rowCount($sql);
	if($count == 1) {
								    /*
						 			 * Verifie si le compte user est actif
						 			 */ 
								    $sql = 'SELECT email, pass FROM users WHERE email = :email AND pass = :password AND activer = 1';
								    $req = $cnx->prepare($sql);
								    $req->execute($q);
								    $actif = $req->rowCount($sql);
								    if($actif == 1) {
								    	$_SESSION['Auth'] = array(
								    		'email' => $email,
								    		'password' => $password,
								    		);
								    	echo '
								    	<div class="container">
								    	<div class="row">
								    	<div class="alert alert-success alert-dismissable">
								    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								    	<strong>Bienvenue !</strong> Vous vous êtes connecté avec succés !
								    	</div>
								    	</div>
								    	</div>
								    	';
								    } else {
								    	$error_actif = ' Votre compte n\'est pas actif, veuillez vérifier vos mails pour activer votre compte.';
								    	echo'
								    	<div class="container">
								    	<div class="row">
								    	<div class="alert alert-warning alert-dismissable">
								    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								    	<strong>'.Securite::html($error_actif).'</strong></p>
								    	</div>
								    	</div>
								    	</div>
								    	';
								    	include 'identification.php';
								    	include 'footer.php';
								    }
								} else {
						/*
						 * Si utilisateur est inconnu
						 */ 
						$error_unknown = ' Combinaison utilisateur/mot de passe incorrect. Veuillez rééssayer.';
						echo'
						<div class="container">
						<div class="row">
						<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>'.Securite::html($error_unknown).'</strong></p>
						</div>
						</div>
						</div>
						';
						include 'identification.php';
						include 'footer.php';
					}
				}else{
					if(!Auth::islog()) {
						include 'identification.php';
						include 'footer.php';
					}else{
						include 'footer.php';
					}	
				}
				?>