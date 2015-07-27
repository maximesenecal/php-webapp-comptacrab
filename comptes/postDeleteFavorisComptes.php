<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$idCompte = $_POST['idCompte'];
		
        $q = array(
				'compte_id' => $idCompte,
				'user_id' => $user_id
        );
		$sql = 'DELETE FROM favoris_comptes WHERE compte_id = :compte_id AND user_id = :user_id';
		$req = $cnx->prepare($sql);
        if(!$req->execute($q)){
			echo "
            	<div class=\"alert alert-danger\">
               		<i class=\"icon-ban-circle icon-white\"></i> Erreur de suppression, peut-être avez vous encore des écritures sur ce compte...
                </div>
			";
            $req->closeCursor();
        }else{
			echo '
            	<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class=\"glyphicon glyphicon-ok\"></i> Compte favori supprimé avec succès.
                </div>
            	';
			$req->closeCursor();
        }
	}
?>