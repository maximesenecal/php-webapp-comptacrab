<div class="modal fade" name="modalCompte" id="modalComptes" tabindex="-1" role="dialog" aria-labelledby="advancedSort" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
    		<div class="modal-header modal-header-success">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h2><i class="glyphicon glyphicon-edit"></i> Gestion des comptes</h2>
    			<ul class="nav nav-pills pull-center">
    	  			<li class="active"><a href="#infosCompte" data-toggle="pill"><span class="glyphicon glyphicon-heart"></span> Mes comptes favoris</a></li>
    	  			<li><a href="#addCompte" data-toggle="pill"><span class="glyphicon glyphicon-search"></span> Rechercher/ajouter un favori</a></li>
    	  			<li><a href="#deleteCompte" data-toggle="pill"><span class="glyphicon glyphicon-remove"></span>  Supprimer un favori</a></li>
    			</ul>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<!--
						Affichage des comptes favoris de l'utilisateur
					-->
					<div class="tab-pane fade in active" id="infosCompte">
			        	<div class="alert-message alert-message-success">
			            	<h4>Choix d'un compte favori</h4>
			                <p>
								<select class="form-control selectpicker" data-live-search="true" id="selectComptesFavoris">
								<?php
									if(Auth::islog()){
										Affichage::favoris_comptes();
									}
								?>
								</select>
							</p>
							<h4>Description du compte sélectionné :</h4>
							<div id="pushShowDescriptionComptesFavoris"></div>
						</div>
					</div>
					<!--
						Affichage de tous les comptes
					-->
		  			<div class="tab-pane fade" id="addCompte">
						<div id="pushAddCompteFavori"></div>
			        	<div class="alert-message alert-message-primary">
			            	<h4>Choix d'un compte</h4>
			                <p>
								<select class="form-control selectpicker" data-live-search="true" id="selectComptes">
								<?php 
									if(Auth::islog()){
										Affichage::comptes();
									}
								?>
								</select>
							</p>
							<h4>Description du compte sélectionné :</h4>
							<div id="pushShowDescription"></div></small>
						</div>
                        <button id="btnAddNewFavoriCompte" type="submit" class="btn btn-success btn-sm">
                			<span class="glyphicon glyphicon-heart"></span> Sauvegarder ce favori</button>
					</div>
								
					<!--
						Suppression d'un favori
					-->
					<div class="tab-pane fade" id="deleteCompte">
						<div id="pushDeleteCompte"></div>
                    	<div class="alert-message alert-message-danger">
							<h4>Choix d'un compte favori à supprimer</h4>
			                <p>
								<select class="form-control selectpicker" data-live-search="true"  id="listeComptes">
								<?php 
									if(Auth::islog()){
										Affichage::favoris_comptes();
									}
								?>
								</select>
							</p>
						</div>
						<div class="alert-message alert-message-warning">
							<h4>Attention</h4>
							<p>Sachez que vous pouvez bien évidemment ajouter une nouvelle fois un compte en favori précédemment supprimé.</p>
						</div>
	                    <button id="btnDeleteCompteFavoris" type="submit" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove"></span> Supprimer ce favori</button>
					</div>
				  
     			</div>
			</div>
			<div class="modal-footer" style="margin-top:10px;">
    			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
  			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
        $(window).on('load', function () {
            $('.selectpicker').selectpicker({
            });
        });
</script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>
<script type="text/javascript" src="comptes/comptes.js"></script><!-- javascript file for modal -->