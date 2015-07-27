<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$idCompte = $_POST['idCompte'];

		/*  
		 * Vérification si le compte est déjà en favori
		 */
		$q = array(
                'id_compte' => $idCompte,
				'user_id' => $user_id
                );
		/*
		 * Préparation d'une requète SQL count(*)
		 */ 
		$sql = 'SELECT count(*) FROM favoris_comptes WHERE user_id = :user_id AND compte_id = :id_compte';
		$req = $cnx->prepare($sql);
		$req->execute($q);
		$rows = $req->fetch(PDO::FETCH_NUM);
		if ($rows[0]){
			echo '
            	<div class="alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Attention,</strong> ce compte est déjà dans vos favoris...
                </div>
            ';
            $req->closeCursor();
  		}else{
  			/*  
			 * Ajout du favori
		 	 */
			$q = array(
	                'id_compte' => $idCompte,
					'user_id' => $user_id
	                );
			$sql = 'INSERT INTO favoris_comptes (compte_id, user_id) 
					VALUES (:id_compte, :user_id)';
			$req = $cnx->prepare($sql);
	        if(!$req->execute($q)){
				echo '
            	<div class="alert alert-error alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class=\"icon-ban-circle icon-white\"></i> Erreur ajout favori : '.$cnx->errorInfo().'
					<a href="#">Contacter l\'administrateur</a>
                </div>
            	';
	            $req->closeCursor();
	        }else{
				echo '
            	<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class=\"glyphicon glyphicon-ok\"></i> L\'ajout de votre nouveau favori s\'est déroulé avec succés.
                </div>
            	';
				$req->closeCursor();
	        }
    	}
	}
?>