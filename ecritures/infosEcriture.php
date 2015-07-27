<div class="modal fade" id="modalInfoEcriture-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="advancedSort" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header modal-header-default">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h2><i class="glyphicon glyphicon-info-sign"></i> Informations</h2>
			</div>
			<div class="modal-body">
				<h4>Identifiant concernant l'écriture : <strong><?php echo $id; ?></strong></h4>
                <div class="form-group">
                    <h3>Nom de l'écriture</h3>
                    <small><?php echo $intitule; ?></small>
                </div>
                <div class="form-group">
                    <h3>Date de l'écriture</h3>
                    <small><?php echo $dateCreation; ?></small>
                </div>
                <div class="form-group">
                    <h3>Journal</h3>
                    <small><?php echo $journalId; ?></small>
                </div>
                <div class="form-group">
                    <h3>Compte associé</h3>
					<small><?php echo $compteId; ?></small>
                </div>
                <div class="form-group">
                    <h3>Mode de paiement</h3>
                    <small><?php echo $mode; ?></small>
                </div>
                <div class="form-group">
                    <h3>Code Analytique</h3>
                    <small><?php echo $codeAnaltId; ?></small>
                </div>
                <div class="form-group">
                    <h3>Montant</h3>
                    <small><?php if($row['credit']){ echo "+".$row['credit']; }else if($row['debit']){ echo "-".$row['debit']; } ?> €</small>
				</div>
			</div>
			<div class="modal-footer" style="margin-top:10px;">
			    <div class="btn-group">
			    	<button class="btn btn-default" data-dismiss="modal">Annuler</button>
				</div>
  			</div>
		</div>
	</div>
</div>