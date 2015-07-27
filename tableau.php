<?php
	include 'header.php';
	/*
	 * Vérification de connexion
	 */ 
	if(!Auth::islog()){
		echo "
			<div class=\"container\">
			<div class=\"row\">
			<div class=\"col-md-6 col-md-offset-3\">
	               <div class=\"alert-message alert-message-danger\">
	                   <h4><span class=\"glyphicon glyphicon-remove\"></span> Oops, vous n'êtes pas connecté.</h4>
					   <p></p>
	               </div>
	    	</div>
			</div>
			</div>
		";
		exit;
	}
	
	/*
	 * Formulaire de suppression d'une écriture
	 */
	if(isset($_GET['supprimer'])){
		
		$id = $_GET['supprimer'];
		
		$q   = array(
			'id' => $id,
			'user_id' => $user_id
		);

		$sql = 'DELETE FROM ecritures WHERE id = :id AND user_id = :user_id';
		$req = $cnx->prepare($sql);
		
		try{
			$req->execute($q);
			echo'
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p>La suppression de l\'écriture s\'est déroulé correctement. <span class="glyphicon glyphicon-ok"></span></p>
					</div>
				</div>
			</div>
			';
		}catch(Exception $e){
			echo'
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p>Un problème est survenu pendant la suppresion. '.Securite::html($e->getMessage()).' <span class="glyphicon glyphicon-remove"></span></p>
					</div>
				</div>
			</div>
			';
		}
	}
	
	$q = array(
		'user_id'=>$user_id
	);
	$sql = 'SELECT id, intitule, date_creation, journal_id, compte_id, mode, code_analt_id, credit, debit, c.description AS descriptionCompte, j.description AS descriptionJournal, ca.description AS descriptionCodeAnalt
			FROM ecritures e
			INNER JOIN comptes c ON c.id_compte = e.compte_id
			INNER JOIN journaux j ON j.id_journal = e.journal_id
			INNER JOIN codes_analytiques ca ON ca.id_code_analt = e.code_analt_id
			WHERE e.user_id = :user_id';
	$req = $cnx->prepare($sql);
	$req->execute($q);
?>
<div class="container jumbotron">
 	<h3>Tableau récapitulatif des écritures / Recherche instantanée</h3>
	<div class="row">
	<div class="col-md-4">
	<input class="form-control" id="filter" type="text" placeholder="Rechercher dans le tableau">
	</div>
	<div class="col-md-12">
            <table class="table footable" data-filter="#filter" data-page-size="10">
                <thead>
    				<tr>
						<th>ID</th>
      					<th>Libellé</th>
     					<th data-hide="phone,tablet" data-sort-initial="true">Date</th>
	  				    <th data-hide="phone,tablet">Journal</th>
	 			  	  	<th data-hide="phone,tablet">Compte</th>
	  					<th data-hide="phone,tablet">Mode de paiement</th>
	  					<th data-hide="phone,tablet">Montant crédit</th>
	  					<th data-hide="phone,tablet">Montant débit</th>
	  					<th data-hide="phone,tablet">Code analytique</th>
						<th>Actions</th>
    				</tr>
                </thead>
                <tbody>
					<?php
							while ($row = $req->fetch(PDO::FETCH_ASSOC)){
								$id = $row['id'];
								$intitule = $row['intitule'];
								$dateCreation = $row['date_creation'];
								$compteId = $row['descriptionCompte'];
								$journalId = $row['descriptionJournal'];
								$mode = $row['mode'];
								$codeAnaltId = $row['descriptionCodeAnalt'];
			
								if($row['credit']){
									$style = "success";
								}else if($row['debit']){
									$style = "danger";
								}else{
									$style = "";
								}
									
						  		    echo "
										<tr id=".$id." class=".$style.">
										<td>".$id."</td>
						  		      	<td>".$intitule."</td>
						  		      	<td>".$dateCreation."</td>
						  			  	<td>".$journalId."</td>
						  			  	<td>".$compteId."</td>
						  			  	<td>".$mode."</td>
						  			  	<td>+ ".$row['credit']." €</td>
									  	<td>- ".$row['debit']." €</td>
										<td>".$codeAnaltId."</td>
										<td class=\"text-center\">
											<a class=\"btn btn-danger btn-xs\" href=\"#modalDeleteEcriture-".$id."\" data-toggle=\"modal\"><span class=\"glyphicon glyphicon-remove\"></span></a> 
										</td>";
									include 'ecritures/infosEcriture.php';
									include 'ecritures/deleteEcriture.php';
									echo "
										</tr>
										";
							}
					?>
				</tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
    $('.footable').footable();
});
</script>