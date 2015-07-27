<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$idCode = $_POST['idCode'];
        $q = array(
                'id' => $idCode
                );
        $sql = 'SELECT details as detailsCode from codes_analytiques WHERE id_code_analt = :id';
        $req = $cnx->prepare($sql);
        //affiche erreur si la requete s'est mal deroule
        if(!$req->execute($q)){
            print_r("".$cnx->errorInfo()."");
            $req->closeCursor();
        }else{
            while($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $details = $row["detailsCode"];
            }
            $req->closeCursor();
        }
		
		echo $details;
	}
?>