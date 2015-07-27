<?php
	session_start();
	require_once '../auth.php';
		
	if(Auth::islog()){
		$nomMembre = $_POST['nomMembre'];
		
        $q = array(
                'firstname' => $nomMembre,
                );
        $sql = 'SELECT cotisation as cotisationMembre from membres WHERE prenom = :firstname';
        $req = $cnx->prepare($sql);
        //affiche erreur si la requete s'est mal deroule
        if(!$req->execute($q)){
            print_r("".$cnx->errorInfo()."");
            $req->closeCursor();
        }else{
            while($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $resp = $row["cotisationMembre"];
            }
            $req->closeCursor();
        }
		
		if($resp == '1'){
			echo "
				<h4 style=\"color: #27ae60;\">Cotisation payée <span class=\"glyphicon glyphicon-ok\"></span></h4>
				<a href=\"#\" class=\"btn btn-default btn-sm\" disabled=\"disabled\">Imprimer fiche membre <span class=\"glyphicon glyphicon-print\"></a> <small>Prochainement disponible</small>";
		}else{
			echo "
				<h4 style=\"color: #c0392b;\">Cotisation non reçu <span class=\"glyphicon glyphicon-remove\"></span></h4>";
		}       
	}
?>