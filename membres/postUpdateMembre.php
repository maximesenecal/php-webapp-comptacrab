<?php
	session_start();
	require_once '../auth.php';
		
	if(!Auth::islog()){
		echo "Vous n'êtes pas connecté.";
		exit;
	}
	
	if(!empty($_POST)){
		/*
		 * Chargement des variables obligatoires
		 */	
		$cotisation = $_POST['cotisation'];
		$name = $_POST['name'];
		/*
		 * Modification de la cotisation du membre sélectionné
		 */
        $q = array(
				'name' => $name,
				'cotisation' => $cotisation,
				'user_id' => $user_id
                );
		$sql = 'UPDATE membres SET cotisation = :cotisation WHERE prenom = :name AND users_on = :user_id';
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
               		<h4><span class=\"glyphicon glyphicon-ok\"></span> Mise à jour de la cotisation du membre effectuée avec succés. Vous devez <strong>actualiser</strong> la page pour voir apparaître vos modifications.</h4>
				</div>
			";
        }
		/*
		 * Vérification si nécéssité d'ajout de la cotisation comme écriture
		 */
		if(isset($_POST['addEcriture'])){
			if($_POST['addEcriture'] == "yes"){
				$reponse = "<strong>Champs manquant pour l'ajout en écriture</strong><br>";
	            /*
				 * Affectation des variables du formulaire
				 */ 
				if(empty($_POST['montant'])){
	    			$reponse .= "- Indiquer un montant<br />";
				}else{
					$montant = $_POST['montant'];
				}
				if(empty($_POST['compte'])){
	    			$reponse .= "- Sélectionner un compte<br />";
				}else{
					$id_compte = $_POST['compte'];
				}
				if(empty($_POST['journal'])){
	    			$reponse .= "- Sélectionner un journal<br />";
				}else{
					$id_journal = $_POST['journal'];
				}
				$id_code_analt = $_POST['code_analytique'];
				
				$q   = array(
					'user_id'       => $user_id,
					'intitule'      => "Cotisation membre : ".$name."",
					'id_journal'    => $id_journal,
					'montant'       => $montant,
					'id_compte'     => $id_compte,
					'mode'          => "Espèce",
					'code_analt_id' => $id_code_analt
				);

				$sql = 'INSERT INTO ecritures (user_id, intitule, date_creation, journal_id, credit, compte_id, mode, code_analt_id) VALUES (:user_id, :intitule, now(), :id_journal, :montant, :id_compte, :mode, :code_analt_id)';
				$req = $cnx->prepare($sql);
		
				if ($reponse == "<strong>Champs manquant pour l'ajout en écriture</strong><br>"){
				  $req->execute($q);
				  		echo"	
						<div class=\"alert alert-success\">
						<h4><span class=\"glyphicon glyphicon-ok\"></span> La cotisation a bien été ajouté en tant qu'écriture.</h4>
						</div>
						";
				}else
				{
	  			  echo "
	  				  <div class=\"alert-message alert-message-danger\">
	  						<h4><span class=\"glyphicon glyphicon-remove\"></span> $reponse</h4>
	  	              </div>
	  				";
				}
			}
		}
	}
?>	