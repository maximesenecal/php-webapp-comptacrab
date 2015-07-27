<?php
	include 'header.php';

	$token = $_GET['token'];
	$email = $_GET['email'];

	if(!empty($_GET)){
		$q = array(
			'email'=>$email,
			'token'=>$token
		);
		
		$sql = 'SELECT email, token FROM users WHERE email = :email AND token = :token';
		$req = $cnx->prepare($sql);
		$req->execute($q);
		$count = $req->rowCount($sql);
		
		if($count == 1){
			/*
			 * Vérification si utilisateur actif
			 */ 
			$v = array(
			'email'=>$email,
			'activer'=>'1'
			);
			$sql = 'SELECT user_id, email, activer FROM users WHERE email = :email AND activer = :activer';
			$req = $cnx->prepare($sql);
			$req->execute($v);
			$deja_actif = $req->rowCount($sql);
			if($deja_actif == 1){
				$error_actif = 'Utilisateur déjà activé.';
			}else{
				/*
				 * Activation du compte user
				 */
				$u = array(
					'email'=>$email,
					'activer'=>'1'
					);
					$sql = 'UPDATE users SET activer = :activer WHERE email = :email';
					$req = $cnx->prepare($sql);
					$req->execute($u);
					$activated  = 'Votre compte est desormais actif. Vous pouvez à présent vous connecter sur la page d\'accueil.';
				/*
				 * Ajout d'informations
				 */
				$w = array(
					'email' => $email
				);
				$sql = 'SELECT user_id FROM users WHERE email = :email';
				$req = $cnx->prepare($sql);
				if($req->execute($w)){
					while ($row = $req->fetch(PDO::FETCH_ASSOC)){
						$user_id = $row['user_id'];
					}
					$x = array(
						'user_id' => $user_id
					);
					$sql = 'INSERT INTO infos (id_user) VALUES (:user_id)';
					$req = $cnx->prepare($sql);
					if($req->execute($x)){
						$activated  .= "<br />Vos informations ont également bien été créé.";
					}
				}
			}
		}else{
			//utilisateur inconnu
			$pro_token = 'Mauvais token, veuillez rééssayer de cliquer sur le lien envoyé.';
		}
	}

	if(isset($error_actif)){
		echo "
			<div class=\"container\">
			<div class=\"row\">
			<div class=\"col-md-12\">
			<div class=\"alert alert-danger\">
			$error_actif
			</div></div></div></div>";
	}
	if(isset($activated)){
		echo "
			<div class=\"container\">
			<div class=\"row\">
			<div class=\"col-md-12\">
			<div class=\"alert alert-success\">
			$activated
			</div></div></div></div>";
	} 
	if(isset($pro_token)){
		echo "
			<div class=\"container\">
			<div class=\"row\">
			<div class=\"col-md-12\">
			<div class=\"alert alert-warning\">
			$pro_token
			</div></div></div></div>";
	}

?>