<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$newDescription = $_POST['newDescription'];
		$idCode = $_POST['idCode'];
		
        $q = array(
                'description' => $newDescription,
				'id' => $idCode
                );
		$sql = 'UPDATE codes_analytiques SET details = :description WHERE id_code_analt = :id';
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
               		<span class=\"glyphicon glyphicon-ok\"><span> La mise à jour de la description du code s'est effectuée avec succès.
                </div>
			";
			$req->closeCursor();
        }
	}
?>