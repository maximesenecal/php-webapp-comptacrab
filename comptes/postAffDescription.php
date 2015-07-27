<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$nomCompte = $_POST['nomCompte'];
        $q = array(
                'name' => $nomCompte
                );
        $sql = 'SELECT details as detailsCompte from comptes WHERE description = :name';
        $req = $cnx->prepare($sql);
        //affiche erreur si la requete s'est mal deroule
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