<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		global $user_id;
		
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$dateInscription = $_POST['dateInscription'];
		$fonction = $_POST['fonction'];
		$adresse = $_POST['adresse'];
		$telephone = $_POST['telephone'];
		
        $q = array(
                'nom' => $nom,
				'prenom' => $prenom,
				'email' => $email,
				'dateInscription' => $dateInscription,
				'fonction' => $fonction,
				'adresse' => $adresse,
				'telephone' => $telephone,
				'user_id'=> $user_id
                );
				
        $sql = 'INSERT INTO membres (nom, prenom, email, fonction, inscription, adresse, telephone, users_on) VALUES (:nom, :prenom, :email, :fonction,:dateInscription, :adresse, :telephone, :user_id)';
        $req = $cnx->prepare($sql);
        //affiche erreur si la requete s'est mal deroule
        if(!$req->execute($q)){
			echo "
            	<div class=\"alert alert-danger\">
               		<span class=\"glyphicon glyphicon-remove\"></span> Erreur : ".$cnx->errorInfo()."
                </div>
			";
			$req->closeCursor();
        }else{
			echo "
            	<div div class=\"alert alert-success\">
               		<h4><span class=\"glyphicon glyphicon-ok\"></span> Votre nouveau membre a été ajouté avec succés. Vous devez <strong>actualiser</strong> la page pour le voir apparaître.</h4>
				</div>
			";
            $req->closeCursor();
        }
	}
?>