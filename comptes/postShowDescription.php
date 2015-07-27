<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$idCompte = $_POST['idCompte'];
        $q = array(
                'id_compte' => $idCompte
                );
        $sql = 'SELECT details as detailsCompte from comptes WHERE id_compte = :id_compte';
        $req = $cnx->prepare($sql);
        if(!$req->execute($q)){
            print_r("".$cnx->errorInfo()."");
            $req->closeCursor();
        }else{
            while($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $details = $row["detailsCompte"];
            }
            $req->closeCursor();
        }
		echo $details;
	}
?>