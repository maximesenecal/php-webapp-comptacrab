<?php
    session_start();
    include '../auth.php';
?>

<?php
    if(!Auth::islog()){
		echo "Vous n'êtes pas connecté";
		exit;
	}
    if(!empty($_POST))
    {
			$reponse = "<strong>Champs manquant</strong><br>";

            /*
			 * Affectation des variables du formulaire
			 */ 
			if(empty($_POST['date'])){
    			$reponse .= "- Sélectionner une date<br />";
			}else{
				$date     = $_POST['date'];
			}
			if(empty($_POST['intitule'])){
    			$reponse .= "- Entrer un intitulé d'écriture<br />";
			}else{
				$intitule = $_POST['intitule'];
			}
			if(empty($_POST['journal'])){
    			$reponse .= "- Sélectionner un journal<br />";
			}else{
				$id_journal  = $_POST['journal'];
			}
			if(empty($_POST['mode_paiement'])){
    			$reponse .= "- Sélectionner un mode de paiement<br />";
			}else{
				$mode_paiement  = $_POST['mode_paiement'];
			}
			if(empty($_POST['compte'])){
    			$reponse .= "- Sélectionner le compte associé<br />";
			}else{
				$id_compte = $_POST['compte'];
			}
			if(empty($_POST['montant'])){
    			$reponse .= "- Entrer un montant<br />";
			}else{
				$montant = $_POST['montant'];
			}
			if(empty($_POST['type_montant'])){
            	$reponse .= "- Séléctionner la nature du montant<br />";
			}else{
				$type_montant   = $_POST['type_montant'];
			}
			if($id_code_analt == "0"){
				$id_code_analt = 0;
			}
			else{
				$id_code_analt = $_POST['code_analytique'];
			}

			/*
			 * Requète SQL pour l'ajout de l'écriture
			 */
            $q = array(
                'user_id' => $user_id,
                'intitule' => $intitule,
                'date' => $date,
                'id_journal' => $id_journal,
                'montant' => $montant,
                'id_compte' => $id_compte,
                'mode' => $mode_paiement,
                'code_analt_id' => $id_code_analt
            );

            if($type_montant == "credit"){
                $sql = 'INSERT INTO ecritures (user_id, intitule, date_creation, journal_id, credit, compte_id, mode, code_analt_id) VALUES (:user_id, :intitule, :date, :id_journal, :montant, :id_compte, :mode, :code_analt_id)';
			}else if($type_montant == "debit"){
                $sql = 'INSERT INTO ecritures (user_id, intitule, date_creation, journal_id, debit, compte_id, mode, code_analt_id) VALUES (:user_id, :intitule, :date, :id_journal, :montant, :id_compte, :mode, :code_analt_id)';
            }
            $req = $cnx->prepare($sql);
			
            /*
			 * Affichage des erreurs ou de la reussite de l'ajout
			 */
			if ($reponse == "<strong>Champs manquant</strong><br>"){
			  $req->execute($q);
                 echo"
	            	<div div class=\"alert-message alert-message-success\">
	               		<h4><span class=\"glyphicon glyphicon-ok\"></span> Votre nouvelle écriture a été ajouté avec succés. Vous pouvez consulter votre tableau.</h4>
					</div>
				";
	            	
			    $req->closeCursor();
			}else{
			  echo "
				  <div class=\"alert-message alert-message-danger\">
						<h4><span class=\"glyphicon glyphicon-remove\"></span> $reponse</h4>
	              </div>
				";
			}
			$cnx = null;
        }
?>