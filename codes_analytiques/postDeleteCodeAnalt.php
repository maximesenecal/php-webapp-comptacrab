<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$idCode = $_POST['idCode'];
		
        $q = array(
				'id' => $idCode
        );
		$sql = 'DELETE FROM codes_analytiques WHERE id_code_analt = :id';
		$req = $cnx->prepare($sql);
        if(!$req->execute($q)){
			echo "
            	<div class=\"alert alert-danger\">
               		<i class=\"icon-ban-circle icon-white\"></i> Erreur de suppression, peut-être avez vous encore des écritures sur ce code analytique ?
                </div>
			";
			//print_r($cnx->errorInfo());
            $req->closeCursor();
        }else{
			echo "
            	<div class=\"alert alert-success\">
               		<i class=\"glyphicon glyphicon-ok\"></i> Code Analytique supprimé avec succès. Vous devez actualiser la page pour voir apparaître vos modifications.
                </div>
			";
			$req->closeCursor();
        }
	}
?>