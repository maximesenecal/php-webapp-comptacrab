<?php
	include 'header.php';
?>

<?php
	if (!Auth::islog()) {
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
?>

<div class="container">
    <div class="row">
		<div class="col-md-4">
			<img src="img/placeit.png" alt="img_compta" class="img-responsive img-rounded" style="margin-top:60px;">
			<div class="clear"></div>
			<div class="btn-group btn-group-justified">
				<div class="btn-group">
   			 		<a href="#modalComptes" type="submit" class="btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-heart"></span> Vos comptes favoris</a>
				</div>
				<div class="btn-group">
    				<a href="#modalCodes" type="submit" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-tag"></span> Vos codes analytiques</a>
				</div>
			</div>

			<div id="affNotif"></div>
		</div>
		<div class="clear"></div>
		<div class="col-md-8">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-euro">
                            </span> Ajouter une nouvelle écriture</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
		                            <div class="row">
		                                <div class="col-md-6">
                                    		<div class="form-group">
                                        		<div class="input-group">
                                           			<label class="control-label"><h4>Journal</h4></label>
					                     			<select class="form-control" name="journal" id="journalEcriture" required>
					                       		 		<?php
															if(Auth::islog()){
																Affichage::journaux();
															}
					                            			?>
					                      			</select>
                                        		</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
		                                        <div class="input-group">
		                                            <label class="control-label"><h4>Date <small> - Cliquez pour choisir une date</small></h4></label>
													<input id="datetimepicker-ecriture" name="date" type="text" class="form-control" placeholder="" required/>
		                                        </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
										<div class="form-group">
                                        	<div class="input-group">
                                         	 	<span class="input-group-addon">Intitulé écriture</span>
												<input name="date" type="text" id="intituleEcriture" class="form-control" placeholder="" required/>
                                        	</div>
										</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" style="z-index:200; position:relative;">
		                                        <div class="input-group">
		                                            <label class="control-label"><h4>Compte<small> - Seuls les comptes favoris sont affichés.</small></h4></label>
									                <select class="form-control selectpicker" data-size="5" data-live-search="true" name="compte" id="compteEcriture" required>
									    				<?php
															if(Auth::islog()){
																Affichage::favoris_comptes();
															}
									                    ?>
													</select>
		                                        </div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" style="z-index:1; position:relative;">
		                                        <div class="input-group">
		                                            <label class="control-label"><h4>Code Analytique</h4></label>
							                        <select class="form-control" name="code_analytique" id="codeAnalytiqueEcriture" style="z-index:10000; position:relative;" required>
														<?php
															if(Auth::islog()){
																Affichage::code_analt();
															}
														?>
							                        </select>
		                                        </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
		                                        <div class="input-group">
		                                            <label class="control-label"><h4>Mode de paiement</h4></label>
							                      	<select class="form-control" name="mode_paiement" id="modePaiementEcriture" required>
							                      		<option>(CB) Carte Bleue</option>
							                      	  	<option>Espèce</option>
							                      	  	<option>Virement</option>
							                      	  	<option>Chèque</option>
							                      	</select>
		                                        </div>
											</div>
										</div>
										<div class="col-md-4">
												<div class="form-group">
													<div class="input-group">
														<label class="control-label"><h4>Montant</h4></label>
						                            	<input type="text" class="form-control" id="montantEcriture" placeholder="Ex : 15.00" required></input>
													</div>
												</div>
										</div>
										<div class="col-md-4">
											<h4>Nature de l'opération</h4>
											<div id="optionRadioOperation" class="btn-group btn-group-justified" data-toggle="buttons-radio">
												<div class="btn-group">
													<button type="button" class="btn btn-danger btn-sm" data-value="debit"><span class="glyphicon glyphicon-minus"></span> Débit</button>
												</div>
												<div class="btn-group">
													<button type="button" class="btn btn-success btn-sm" data-value="credit"><span class="glyphicon glyphicon-plus"></span> Crédit</button>
												</div>
											</div>
										</div>
									</div>
									<div class="alert-message alert-message-success">
										<h4><span class="glyphicon glyphicon-info-sign"></span> Attention, veillez à bien vérifier l'exactitude des champs, une fois votre écriture ajoutée elle ne peut plus être modifiée.</h4>
										<p>
				                          	<button id="btnAjoutEcriture" type="submit" class="btn btn-success">
				                      		<span class="glyphicon glyphicon-cloud"></span> Ajouter cette nouvelle écriture</button>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- begin Advanced Comptes Modal -->
<?php
	include 'comptes/modalComptes.php';
	include 'codes_analytiques/modalCodes.php';
?>
<!-- end Advanced Comptes Modal -->
<script type="text/javascript">
	$('#datetimepicker-ecriture').datetimepicker();
</script>
<script type="text/javascript" src="ecritures/ecritures.js"></script>