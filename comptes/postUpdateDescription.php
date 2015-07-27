<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$newDescription = $_POST['newDescription'];
		$nomCompte = $_POST['nomCompte'];
		
        $q = array(
                'description' => $newDescription,
				'name' => $nomCompte
                );
		$sql = 'UPDATE comptes SET details = :description WHERE description = :name';
		$req = $cnx->prepare($sql);
        if(!$req->execute($q)){
			echo "
            	<div class=\"alert alert-success\">
               		<i class=\"icon-ban-circle icon-white\"></i> Erreur : ".$cnx->errorInfo()."
                </div>
			";
            $req->closeCursor();
        }else{
			echo "
            	<div class=\"alert alert-success\">
               		<i class=\"glyphicon glyphicon-ok\"></i> La mise à jour de la description du compte s'est effectuée avec succès.
                </div>
			";
			$req->closeCursor();
        }
	}
?>