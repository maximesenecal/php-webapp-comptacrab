<?php
include 'header.php';
date_default_timezone_set('Etc/UTC');
?>

<?php
/*
 * Fonction REGEX de vérification de l'adresse mail pour navigateur sans vérification HTML 5
 */
function isValidEmail($email){
	return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
}
?>

<?php
	/*
 	 * envoi de la requete securisee seulement lorsque le formulaire a été soumi
 	 */
	if(!empty($_POST)){
		//affectation des variables du formulaire
		$email = addslashes($_POST['newEmail']);
		$email2 = addslashes($_POST['validEmail']);

		if ($_POST['newEmail'] == "" || !isValidEmail($_POST['newEmail'])){
			echo "
			<div class=\"container\">
				<div class=\"row\">
					<div class=\"col-md-12\">
						<div class=\"alert alert-danger\">
							<span class=\"glyphicon glyphicon-exclamation-sign\"></span> Veuillez renseigner une adresse mail valide. 
						</div>
					</div>
				</div>
			</div>
			";
			exit;
		}	
		if($email != $email2){
			echo "
			<div class=\"container\">
				<div class=\"row\">
					<div class=\"col-md-12\">
						<div class=\"alert alert-danger\">
							<span class=\"glyphicon glyphicon-exclamation-sign\"></span> Mmm c'est embétant, les deux adresses mails ne concordent pas. 
						</div>
					</div>
				</div>
			</div>
			";
			exit;
		}
		/*
		 * Vérification de l'existence de l'adresse mail dans la base de donnée
		 */
		$sql = 'SELECT email FROM users WHERE email = :email';
  		$req = $cnx->prepare($sql);
  		$req->bindParam(':email', $email, PDO::PARAM_STR, 100);
  		$req->execute($q);
  		$already_exist_user = $req->rowCount($sql);
		if($already_exist_user == 1){
			echo "
			<div class=\"container\">
				<div class=\"row\">
					<div class=\"col-md-12\">
						<div class=\"alert alert-warning\">
							<span class=\"glyphicon glyphicon-exclamation-sign\"></span> Cette adresse mail est déjà utilisée... 
						</div>
					</div>
				</div>
			</div>
			";
			exit;
		}

		else{
			$password = sha1($_POST['newPassword']);
			$token = sha1(uniqid(rand())); //generation d'un token aleatoire et securisee

			//envoi de la requete preparee
			$q = array(
				'email'=>$email,
				'pass'=>$password,
				'token'=>$token,
				'activer'=> 0
				);

			$sql = 'INSERT INTO users (email, pass, token, activer) VALUES (:email, :pass, :token, :activer)';
			try{
				$req = $cnx->prepare($sql);
			}
			catch(Exception $e){
				echo 'Erreur : '.$e->getMessage().'<br />';
				echo 'N° : '.$e->getCode();
			}
			$req->execute($q);

			//envoi d'un mail pour la confirmation du compte
			$to = $email;

			$sujet = 'Activation de votre compte sur Gestion de Comptabilite CRAB';

			$body = '
			Bonjour veuillez activer votre compte en cliquant sur le lien ci dessous 
			http://compta.dsu-crab.fr/activate.php?token='.$token.'&email='.$to.'
			';

			//version MIME 
			$headers = "MIME-Version: 1.0\r\n"; 

			//on détermine le mail en format texte 
			$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n"; 

			//on détermine l'expediteur et l'adresse de réponse 
			$headers .= "From: DSU CRAB Gestion Comptabilite <asso.dsu@gmail.com>\r\nReply-to : DSU-CRAB <asso.dsu@gmail.com>\nX-Mailer:PHP"; 

			if(mail ($to , $subject , $message , $header)){ 
				echo "
				<div class=\"container\">
					<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"alert alert-success\">
								<span class=\"glyphicon glyphicon-send\"></span> Youhou! Votre mail vient d'être envoy&eacute, veuillez confirmer votre compte en cliquant sur le lien qui vous a été envoyé.
							</div>
						</div>
					</div>
				</div>
				";
				exit;
			}else{ 
				echo '
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-warning">
								<span class="glyphicon glyphicon-exclamation-sign"></span> Erreur interne... Le message d\'inscription n\'a pu être envoyé.
							</div>
						</div>
					</div>
				</div>
				';
				exit;
			}
			$cnx = null;
		}
	}
?>

<!-- 
Ecran de connexion avec vérification longueur nom et email en HTML5
Verification des champs du formulaire avec l'attribut required (sur Chrome Firefox)
-->
<div class="container">
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-12">
				<h2>Formulaire d'inscription</h2>
				<!--<p>Pour vous inscrire sur notre plateforme, vous devez obligatoirement <strong>accepter</strong> nos conditions d'utilisations.*</p>-->
				<p>Veuillez remplir toutes les champs pour vous inscrire, vous recevrez un mail de confirmation une fois l'inscription terminée.</p>
				<form role="form" action="register.php" method="post">
					<div class="row">
						<div class="col-md-10">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Nom de l'association</span>
									<input id="newName" name="newName" type="text" class="form-control" placeholder="Notre association" />
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Adresse mail</span>
									<input id="newEmail" name="newEmail" type="email" class="form-control" placeholder="Ex : association@benevole.fr" />
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Vérification mail</span>
									<input id="validEmail" name="validEmail" type="email" class="form-control" placeholder="Saisir à nouveau la même adresse mail" />
								</div>
							</div>
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon">Créer un mot de passe de connexion</span>
									<input id="newPassword" name="newPassword" type="password" class="form-control" placeholder="Choisissez un mot de passe fort" />
								</div>
							</div>
							<!--<div class="checkbox">
								<label>
									<input type="checkbox"> J'ai lu et accepté les <a href="#">conditions d'utilisations</a> de la plateforme.
								</label>
							</div>-->
							<h5><span class="glyphicon glyphicon-info-sign"></span> Aucune donnée confidentiel ne sera visible en clair par le Centre de Ressources des Associations Boulonnaises et aucun "Cookies" n'est utilisé à des fins de profilage.</h5>
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Créer un compte gratuit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>