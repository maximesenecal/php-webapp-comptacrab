<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$membre = $_POST['membre'];
		
        $q = array(
				'membre' => $membre
                );
		$sql = 'DELETE FROM membres WHERE prenom = :membre';
		$req = $cnx->prepare($sql);
        if(!$req->execute($q)){
			echo "
            	<div class=\"alert alert-danger\">
               		<i class=\"glyphicon glyphicon-remove\"></i> Erreur : ".$cnx->errorInfo()."
                </div>
			";
            $req->closeCursor();
        }else{
			echo "
            	<div div class=\"alert alert-success\">
               		<h4><span class=\"glyphicon glyphicon-ok\"></span> Membre supprimé avec succès. Vous devez actualiser la page pour voir apparaître vos modifications.</h4>
				</div>
			";
			$req->closeCursor();
        }
	}
?>