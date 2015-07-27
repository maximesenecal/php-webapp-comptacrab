<div class="modal fade" id="modalDeleteEcriture-<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="advancedSort" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header modal-header-danger">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h2><i class="glyphicon glyphicon-remove"></i> Supprimer cette écriture ?</h2>
			</div>
			<div class="modal-body">
				<h4>Identifiant concernant l'écriture : <strong><?php echo $id; ?></strong></h4>
				<h4>Êtes-vous sûr ? Une fois cette écriture effacée, il sera impossible de la récupérer !</h4>
			</div>
			<div class="modal-footer" style="margin-top:10px;">
			    <div class="btn-group">
					<a href="?supprimer=<?php echo $id; ?>" id="btnConfirmSupprEcriture" class="btn btn-danger">Supprimer</a>
			    	<button class="btn btn-default" data-dismiss="modal">Annuler</button>
				</div>
  			</div>
		</div>
	</div>
</div>