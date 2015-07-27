<div class="modal fade" name="modalCompte" id="infosMembres" tabindex="-1" role="dialog" aria-labelledby="advancedSort" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header modal-header-warning">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h1><i class="glyphicon glyphicon-user"></i> Gestion des membres</h1>
	    		<ul class="nav nav-pills pull-center">
	   	 			<li class="active"><a href="#infos" data-toggle="pill"><span class="glyphicon glyphicon-check"></span> Cotisations</a></li>
	      			<li><a href="#add" data-toggle="pill"><span class="glyphicon glyphicon-plus"></span> Ajouter un membre</a></li>
	      			<li><a href="#delete" data-toggle="pill"><span class="glyphicon glyphicon-remove"></span> Supprimer un membre</a></li>
	    		</ul>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<!-- begin tab infos -->
					<div class="tab-pane fade in active" id="infos">
						<div id="pushUpdateMembre"></div>
			        	<div class="alert-message alert-message-default">
			            	<h4>Veuillez choisir un membre</h4>
			                <p>
								<select class="form-control" id="selectMembre">
								<option>Veuillez choisir un membre</option>
								<?php 
									if(Auth::islog()){
										Affichage::membres();
									}
								?>
								</select>
							</p>
				            <h4>État actuel de sa cotisation au <?php echo date("d-m-Y G:i:s"); ?></h4>
				            <p><div id="affDescription"></div></p>
				        </div>
			        	<div class="alert-message alert-message-primary">
							<h4>Modifier l'état de la cotisation du membre</h4>
				   			<div id="optionRadioButton" class="ui-group-buttons" data-toggle="buttons-radio">
					 			<button id="waitCotisation" type="radio" class="btn btn-default btn-sm" data-value="0">En attente</button>
								<div class="or or-sm"></div>
								<button id="recuCotisation" type="radio" class="btn btn-success btn-sm" data-value="1">Reçu</button>
							</div>
				        </div>
						<div class="alert-message alert-message-info">
							<h4>Options</h4>
							<div class="row" id="infosCotisations" style="display:none;">
							<div class="col-md-6">
								<div class="form-group">
									<h4>Ajouter en tant qu'écriture ?</h4>
			 		   				<div id="optionRadioAjoutEcriture" class="ui-group-buttons" data-toggle="buttons-radio">
			   			 				<button type="button" class="btn btn-default btn-sm" data-value="no">Non</button>
			    						<div class="or or-sm"></div>
			    						<button type="button" class="btn btn-default btn-sm" data-value="yes">Oui</button>
									</div>
								</div>
								<div class="form-group">
           							<span>Compte associé</span>
										<select class="form-control selectpicker" data-live-search="true" id="compteEcritureCotisation">
										<?php 
											if(Auth::islog()){
												Affichage::favoris_comptes();
											}
										?>
										</select>
								</div>
								<div class="form-group">
               							<span>Journal associé</span>
										<select class="form-control" id="journalEcritureCotisation">
										<?php 
											if(Auth::islog()){
												Affichage::journaux();
											}
										?>
										</select>
								</div>
								<div class="form-group">
               							<span >Votre code analytique</span>
										<select class="form-control" id="codeAnaltEcritureCotisation">
										<?php 
											if(Auth::islog()){
												Affichage::code_analt();
											}
										?>
										</select>
								</div>
							</div>
							<div class="col-md-6">
								<h4>Montant de sa cotisation</h4>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon">Indiquez le montant</span>
			                        	<input type="text" class="form-control" id="montantCotisation" placeholder="Ex : 15.00" required></input>
									</div>
								</div>
							</div>
							</div>
						</div>
						<button id="btnModifMembre" type="submit" class="btn btn-success btn-sm">
            			<span class="glyphicon glyphicon-floppy-disk"></span> Sauvegarder</button>
					</div>
			
					<!-- begin tab add -->
		  			<div class="tab-pane fade" id="add">
						<div id="pushAddMembre"></div>	
							<h4>Ajouter un nouveau membre</h4>
                            <div class="row">
                                <div class="col-md-6">
									<div class="form-group">
               							<div class="input-group">
                   							<span class="input-group-addon">Nom</span>
                               			 	<input id="nomNewMembre" type="text" class="form-control" placeholder="Ex : Parent" required />
                  						</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
		                  				<div class="input-group">
		                             	   <span class="input-group-addon">Prénom</span>
		                           			<input id="prenomNewMembre" type="text" class="form-control" placeholder="Ex : Didier" required />
		                           	 	</div>
									</div>
								</div>
							</div>
							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Adresse mail</span>	
								<input id="emailNewMembre" type="email" class="form-control" placeholder="membre.association@crab.fr" required/>
							</div>
							</div>
							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Date d'inscription à l'association</span>	
								<input id="dateInscriptionNewMembre" name="text" class="form-control" placeholder="Cliquez pour sélectionner une date" required/>
							</div>
							</div>
							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Fonction</span>	
								<input id="FonctionNewMembre" type="text" class="form-control" placeholder="Bénévole ou Animateur ou autre..." required/>
							</div>
							</div>
							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Adresse</span>	
								<textarea id="AdresseNewMembre" class="form-control" cols="50" rows="3"></textarea>
							</div>
							</div>
							<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">Téléphone</span>	
								<input id="TelNewMembre" type="text" class="form-control" placeholder="" required/>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
	                        	<div class="col-md-6">
	                          	  	<button id="btnAddNewMembre" type="submit" class="btn btn-success btn-sm">
	                                <span class="glyphicon glyphicon-plus"></span> Ajouter ce nouveau membre</button>
	                       	 	</div>
							</div>
						</div>
					</div>
					<!-- end tab add -->
			
					<!-- begin tab delete -->
		  			<div class="tab-pane fade" id="delete">
						<div id="pushDeleteMembre"></div>
                    	<div class="alert-message alert-message-danger">
							<h4>Choix du membre à supprimer</h4>
			                <p>
								<select class="form-control" id="listeMembres">
								<option>Veuillez choisir un membre</option>
								<?php 
									if(Auth::islog()){
										Affichage::membres();
									}
								?>
								</select>
							</p>
						</div>
						<div class="form-group">
						<div class="row">
                        	<div class="col-md-6">
                          	  	<button id="btnDeleteMembre" type="submit" class="btn btn-danger btn-sm">
                                <span class="glyphicon glyphicon-remove"></span> Supprimer ce membre</button>
                       	 	</div>
						</div>
						</div>
					</div>
					<!-- end tab delete -->
     			</div>
			</div>
			<div class="modal-footer" style="margin-top:10px;">
    			<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Fermer <span class="icon-remove"></span></button>
  			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="membres/membres.js"></script>