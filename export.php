<?php
	include 'header.php';
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
?>
	
<div class="container">
    <div class="row">
		<div class="col-md-4">
			<div id="affNotif"></div>
		</div>
        <div class="col-md-8">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								Export d'un <strong>Grand Livre</strong></a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
                                			<div class="form-group" style="z-index:200; position:relative;">
                                        		<div class="input-group">
													<h4>Choix du/des compte(s) à exporter<small> - Tous les comptes sont affichés.</small></h4>
													<select class="form-control selectpicker" multiple title='Cochez un ou plusieurs comptes' data-size="5" data-live-search="true" data-selected-text-format="count>1" id="compte_select">
														<?php 
															if(Auth::islog()){
																Affichage::comptes();		
															}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<h4>Période de l'export</h4>
		                                	<div class="form-group" style="z-index:1; position:relative;">
		                                        <div class="input-group">
			                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> Début</span>
			                                            <input id="dateDebutExportGL" type="text" class="form-control" placeholder="Cliquez pour choisir une date" required />
												</div>
											</div>
											<div class="form-group" style="z-index:1; position:relative;">
			                                	<div class="input-group">
			                            			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span> Fin</span>
			                                    	<input id="dateFinExportGL" type="text" class="form-control" placeholder="Cliquez pour choisir une date" required />
			                                    </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<blockquote>
												<p>Bon à savoir :</p>
													<small style="color: rgba(41, 128, 185,1.0);">
													Registre reprenant et ventilant selon le plan comptable les écritures du livre-journal. Il classe, par nature de compte, les informations saisies dans l'ordre chronologique par le livre-journal.
													Il est obligatoire pour les entreprises commerciales ou artisanales soumises à un régime réel d'imposition.<small> Source APCE </small>
													</small>
											</blockquote>
										</div>
									</div>
                                    <div class="form-group">
										<h4>Choix du format d'exportation</h4>
					       			 	<button id="btnExportGrandLivre" type="button" class="btn btn-success" data-value="excel"><span class="glyphicon glyphicon-export"></span> Microsoft Excel (.XLSX)</button>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <!--<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
								Export d'un <strong>Journal</strong></a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
                                			<div class="form-group">
                                        		<div class="input-group">
													<h4>Choix du journal à exporter</h4>
													<select class="form-control selectpicker" data-live-search="true" id="">
														<option>Veuillez choisir un journal</option>
														<?php/* 
															if(Auth::islog()){
																Affichage::journaux();		
															}*/
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<h4>Période de l'export</h4>
		                                	<div class="form-group">
		                                        <div class="input-group">
			                                            <span class="input-group-addon">Début</span>
			                                            <input id="dateDebutExportJ" type="text" class="form-control" placeholder="Cliquez pour choisir" required />
												</div>
											</div>
											<div class="form-group">
			                                	<div class="input-group">
			                            			<span class="input-group-addon">Fin</span>
			                                    	<input id="dateFinExportJ" type="text" class="form-control" placeholder="Cliquez pour choisir" required />
			                                    </div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<blockquote>
												<p>Bon à savoir :</p>
													<small style="color: rgba(41, 128, 185,1.0);">
														Le journal en comptabilité est un document comptable obligatoire listant les opérations d'échanges de l'entreprise avec son environnement. 
														Les entreprises divisent le journal en plusieurs journaux en fonction de la nature des opérations à enregistrer (journal des achats et frais, journal des ventes etc...).
													</small>
											</blockquote>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
                                    		<div class="form-group">
												<h4>Choix du format d'exportation</h4>
					     		   				<div id="" class="ui-group-buttons" data-toggle="buttons-radio">
					       			 				<button id="btnExportJournal" type="button" class="btn btn-success" data-value="excel"><span class="glyphicon glyphicon-save"></span> Microsoft Excel (Compatible 2007)</button>
												</div>
											</div>
										</div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>-->
			</div>
		</div>
	</div>
</div>
<script>
	$("button").popover();
	
	$("#dateDebutExportGL").datetimepicker();
	$("#dateFinExportGL").datetimepicker();
	
	$("#dateDebutExportJ").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#dateFinExportJ").datepicker({ dateFormat: 'yy-mm-dd' });
</script>
<script>
	$("button#btnExportGrandLivre").click( function() {
		NProgress.start();
		var idCompte = document.getElementById("compte_select").value;
		var dateD = document.getElementById("dateDebutExportGL").value;
		var dateF = document.getElementById("dateFinExportGL").value;
				
		$.post('exportGrandLivre.php', {
			idCompte : idCompte,
			dateDebut : dateD,
			dateFin : dateF
		},
		function(output){
			$('#affNotif').html(output).fadeIn();
			NProgress.done();
		});
	});
	
	$("button#btnExportJournal").click( function() {
		var nomJournal = document.getElementById("select_code").value;
		var dateD = document.getElementById("dateDebutExportJ").value;
		var dateF = document.getElementById("dateFinExportJ").value;
				
		$.post('exportJournal.php', {
			nomCode : nom,
			dateDebut : dateD,
			dateFin : dateF
		},
		function(output){
			$('#affNotif').html(output).fadeIn();
		});
	});
</script>
<script type="text/javascript">
        $(window).on('load', function () {

            $('.selectpicker').selectpicker({
            });
            //$('.selectpicker').selectpicker('hide');
        });
</script>
<script type="text/javascript" src="js/bootstrap-select.js"></script>