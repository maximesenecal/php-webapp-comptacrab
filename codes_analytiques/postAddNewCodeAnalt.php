<?php
session_start();
require_once '../auth.php';
	
if(!Auth::islog()){
	echo "Vous n'êtes pas connecté.";
	exit;
}
		global $user_id;
		
		$nomCode = $_POST['nomCode'];
		$detailsCode = $_POST['detailsCode'];
		
        $q = array(
                'name' => $nomCode,
				'details' => $detailsCode,
				'user_id' => $user_id
                );
		
		/*
		 * Si erreur "Array()" vérifier l'auto-increment !
		 */
		$sql = 'INSERT INTO codes_analytiques (description, details, users_on) VALUES (:name, :details, :user_id)';
        $req = $cnx->prepare($sql);
        
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
               		<span class=\"glyphicon glyphicon-ok\"></span> L'ajout du code analytique s'est déroulé avec succès.
                </div>
			";
			$req->closeCursor();
        }
?>