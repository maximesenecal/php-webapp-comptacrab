<div class="modal fade" name="modalCompte" id="modalCodes" tabindex="-1" role="dialog" aria-labelledby="advancedSort" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header modal-header-info">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h2><i class="glyphicon glyphicon-user"></i> Gestion des codes analytiques</h2>
	    		<ul class="nav nav-pills pull-center">
	   	 			<li class="active"><a href="#infosCode" data-toggle="pill"><span class="glyphicon glyphicon-info-sign"></span> Informations</a></li>
	      			<li><a href="#addCode" data-toggle="pill"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></li>
	      			<li><a href="#deleteCode" data-toggle="pill"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></li>
	    		</ul>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					
					<!-- begin tab infos comptes -->
					<div class="tab-pane fade in active" id="infosCode">
						<div id="pushUpdateDescriptionCode"></div>
			        	<div class="alert-message alert-message-success">
			            	<h4>Choix du code analytique</h4>
			                <p>
								<select class="form-control" id="selectCode">
								<?php 
									if(Auth::islog()){
										Affichage::code_analt();
									}
								?>
								</select>
							</p>
							<h4>Description du code analytique sélectionné :</h4>
							<div id="affDescriptionCode"></div></small>
						</div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Modifier<br>description</span>
                                        <textarea class="form-control" cols="50" rows="3" id="newDescriptionCode"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button id="btnModifDescriptionCode" type="submit" class="btn btn-default btn-sm">
                        			<span class="glyphicon glyphicon-refresh"></span> Modifier</button>
                            </div>
						</div>
					</div>
					<!-- end tab infos comptes -->
			
					<!-- begin tab add -->
		  			<div class="tab-pane fade" id="addCode">
						<div id="pushAddNewCode"></div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Nom du code analytique</span>
								<input id="nomNewCode" type="text" class="form-control" placeholder="ACHATS SUPERMARCHE" required></input>
                            </div>
                        </div>
						<div class="form-group">
              				<div class="input-group">
                         	   <span class="input-group-addon">Description</span>
                               <textarea id="detailsNewCode" class="form-control" cols="50" rows="2"></textarea>
                       	 	</div>
						</div>
						<div class="alert-message alert-message-warning">
							<h4>Attention</h4>
							<sp>Veillez à renseigner correctement le <b>nom</b> du code analytique, une fois le <b>nom</b> donné <b>il ne peut plus être modifié</b>.</p>
						</div>
                        <button id="btnAddNewCode" type="submit" class="btn btn-success btn-sm">
                			<span class="glyphicon glyphicon-floppy-disk"></span> Sauvegarder</button>
					</div>
					<!-- end tab add -->
			
					<!-- begin tab delete compte -->
					<div class="tab-pane fade" id="deleteCode">
						<div id="pushDeleteCode"></div>
                    	<div class="alert-message alert-message-danger">
							<h4>Choix du code analytique à supprimer</h4>
			                <p>
								<select id="listeCodes" class="form-control">
								<?php 
									if(Auth::islog()){
										Affichage::code_analt();
									}
								?>
								</select>
							</p>
						</div>
						<div class="alert-message alert-message-warning">
							<h4>Attention</h4>
							<p>Toute suppression d'un code analytique est définitive, veillez à <b>supprimer préalablement vos écritures associés à ce code</b> avant toute suppression.</p>
						</div>
	                    <button id="btnDeleteCode" type="submit" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove"></span> Supprimer ce code</button>
					</div>
					<!-- end tab delete compte -->
				  
     			</div>
			</div>
			<div class="modal-footer" style="margin-top:10px;">
    			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
  			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="codes_analytiques/codes.js"></script>