<?php
	session_start();
	require_once 'auth.php';
	if(!Auth::islog()){
		echo "Vous n'êtes pas connecté.";
		exit;
	}
		//chargement du grand livre par defaut
		$objet = PHPExcel_IOFactory::createReader('Excel2007');
		// a modifier si chemin different
		$excel = $objet->load('Classes/examples/grand-livre/grand_livre.xlsx');
	
		//on charge la premiere feuille de calcul dans le fichier
		$sheet = $excel->getSheet(0); 
	
		//recuperation par methode post du numero de compte choisi
		$nomJournal = $_POST['nomJournal'];
		$dateDebut = $_POST['dateDebut'];
		$dateFin = $_POST['dateFin'];
		
        //requete pour recherche id_compte a partir du nomCompte
        $q = array(
                'name' => $nomJournal
                );
        $sql = 'SELECT id_journal as idJournal from journaux WHERE description = :name';
        $req = $cnx->prepare($sql);
        //affiche erreur si la requete s'est mal deroule
        if(!$req->execute($q)){
            echo $error;
            print_r("".$cnx->errorInfo()."</div>");
            $req->closeCursor();
        }else{
            while($row = $req->fetch(PDO::FETCH_ASSOC)) {
                $idJournal = $row["idJournal"];
            }
            $req->closeCursor();
        }
	
		//requete sql permettant d'obtenir les operations concernant l'ecriture
		$q = array(
			'numero' => $idJournal,
			'dateDebut' => $dateDebut,
			'dateFin' => $dateFin	
		);
		
		$sql = 'SELECT debit, credit, intitule, date_creation FROM ecritures WHERE (date_creation BETWEEN :dateDebut AND :dateFin) AND journal_id IN (:numero)'; 
		$req = $cnx->prepare($sql);
		$req->execute($q);
	
		//titre du grand livre
		$sheet->setCellValue('B2','Journal : '.$nomJournal.' ('.$idJournal.')');
	
		//initialisation des variables
		$i ='6';
	
		//boucle permettant d'ajouter toutes les operations concernant l'ecriture en fonction de sa nature
		while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
			$sheet->setCellValue('D'.$i.'',$row['intitule']);
			$sheet->setCellValue('C'.$i.'',$row['date_creation']);
			if($row['debit']!= NULL && $row['debit']!= '0'){
				$sheet->setCellValue('F'.$i.'',$row['debit']);
			}
			else if($row['credit']!= NULL && $row['credit']!= '0'){
				$sheet->setCellValue('G'.$i.'',$row['credit']);
			}
			else{
				// a verifier car ne fonctionne pas...
				echo "
					<div class=\"alert alert-success\" style=\"background-color: rgba(192, 57, 43, 0.8)\">
				    	<i class=\"icon-download icon-white\"></i> Aucune donnée exportée...
					</div>
				";
			}
			$i++;
		}
	
		//ajout de proprietes pour le document genere
		$excel->getProperties()->setCreator("");
		$excel->getProperties()->setLastModifiedBy("");
		$excel->getProperties()->setTitle("");
		$excel->getProperties()->setSubject("");
		$excel->getProperties()->setDescription("");
	
		//sauvegarde du fichier
		$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$writer->setOffice2003Compatibility(true);
		$writer->save('tmp/exportReader'.time().'.xlsx');

		echo"
		<div class=\"alert alert-success\" style=\"background-color:rgba(39, 174, 96, 0.8)\">
		    <i class=\"icon-download icon-white\"></i> Récupération et exportation réussie.
		</div>
		";	
	}
	else{
		echo"
		<div class=\"alert span12 alert-error\">
		    <strong><i class=\"icon-ban icon-white\"></i> Erreur vous n'êtes plus connecté.</strong> Veuillez recommencer après une nouvelle connexion.
		</div></div>
		";
	}
?>