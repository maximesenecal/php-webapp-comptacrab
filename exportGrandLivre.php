<?php
	session_start();
	require_once 'auth.php';
	if(!Auth::islog()){
		echo "Vous n'êtes pas connecté.";
		exit;
	}
	/*
	 * Recuperation par méthode POST des variables
	 */ 	
	$idCompte = $_POST['idCompte'];
	$dateDebut = $_POST['dateDebut'];
	$dateFin = $_POST['dateFin'];
		/*
		 * Chargement du template du Grand Livre
		 */
		$objet = PHPExcel_IOFactory::createReader('Excel2007');
		$excel = $objet->load('examples/grand-livre/grand_livre.xlsx');
	
		/*
		 * Chargement de la premiere feuille de calcul dans le fichier
		 */
		$sheet = $excel->getSheet(0); 
		
		/*
		 * Requète SQL permettant d'obtenir les écritures du compte et les informations du compte selectionné
		 */ 
		$q = array(
			'id_compte' => $idCompte,
			'dateDebut' => $dateDebut,
			'dateFin' => $dateFin	
		);

		$sql = 'SELECT e.id AS idEcriture, e.debit AS debit, e.credit AS credit, e.intitule AS intituleEcriture, e.date_creation AS dateEcriture, c.numero AS numeroCompte, c.description AS descriptionCompte
				FROM ecritures e
				INNER JOIN comptes c ON e.compte_id = c.id_compte
				WHERE (e.date_creation BETWEEN :dateDebut AND :dateFin) 
					AND e.compte_id IN (:id_compte) 
				ORDER BY e.date_creation'; 
		$req = $cnx->prepare($sql);
		if($req->execute($q)){
			/*
			 * Définition de la variable i
			 */
			$i ='6';
			/*
			 * Boucle ajoutant dans le tableur toutes les écritures concernant le compte
			 */
			while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
				/*
			 	 * Définition du titre du Grand Livre
				 */
				$sheet->setCellValue('B2','Grand livre du compte : '.$row['descriptionCompte'].' (Numéro de compte :'.$row['numeroCompte'].')');
				/*
			 	 * Ajout des écritures 
				 */
				$sheet->setCellValue('B'.$i.'',$row['idEcriture']);
				$sheet->setCellValue('C'.$i.'',$row['dateEcriture']);
				$sheet->setCellValue('D'.$i.'',$row['intituleEcriture']);
				$sheet->setCellValue('E'.$i.'',$row['numeroCompte']);
				if($row['debit']!= NULL && $row['debit']!= '0'){
					$sheet->setCellValue('F'.$i.'',$row['debit']);
				}
				else if($row['credit']!= NULL && $row['credit']!= '0'){
					$sheet->setCellValue('G'.$i.'',$row['credit']);
				}
				$i++;
			}
			//echo "Recherche des écritures ok";
		}
		else{
			echo "Problème recherche des écritures";
			$req->closeCursor();
		}
		/*
		 * Ajout de propriétés pour le document Excel
		 */
		$excel->getProperties()->setCreator("");
		$excel->getProperties()->setLastModifiedBy("");
		$excel->getProperties()->setTitle("");
		$excel->getProperties()->setSubject("");
		$excel->getProperties()->setDescription("");
	
		/*
		 * Sauvegarde du fichier
		 */ 
		$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$writer->setOffice2003Compatibility(true);
		$file = 'tmp/exportGrandLivre'.date("Y-m-d-H-i-s").'.xlsx';
		$writer->save($file);
		/*
		 * Lien de téléchargement du fichier
		 */ 
        echo '
        	<div div class="alert alert-success" style="margin-top:70px;">
				<h4><span class="glyphicon glyphicon-ok"></span>L\'exportation s\'est déroulée avec succés. Vous pouvez télécharger votre fichier en cliquant sur le bouton ci-dessous.</h4>
				<a href='.$file.' class="btn btn-primary btn-sm" style="text-decoration:none;">Télécharger <span class="glyphicon glyphicon-save"></a>
			</div>
		';
?>