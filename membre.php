<?php
	include 'header.php';
	if (!Auth::islog()) {
		include 'no-login.php';
		include 'footer.php';
		exit;
		
	}
	
	/*
	 * Requète SQL pour mise en variable des informations existantes de l'association
	 */
	$q   = array(
		'user_id'       => $user_id
	);
	$sql = 'SELECT adresse_postale, commune, code_postal, site_web, mail, telephone, nom, suite_nom, ape, registre, siret, interet_gen, but FROM infos WHERE id_user = :user_id';
	$req = $cnx->prepare($sql);
	if (!$req->execute($q)){
         echo"
        	<div div class=\"alert-message alert-message-danger\">
           		<h4><span class=\"glyphicon glyphicon-remove\"></span> Erreur recherche informations base de donnée.</h4>
			</div>
		";
	}

	while ($row = $req->fetch(PDO::FETCH_ASSOC)){
		$adresse_postale = $row['adresse_postale'];
		$commune = $row['commune'];
		$codepostal = $row['code_postal'];
		$site_web = $row['site_web'];
		$mail = $row['mail'];
		$telephone = $row['telephone'];
		$nom = $row['nom'];
		$suite_nom = $row['suite_nom'];
		$ape = $row['ape'];
		$registre = $row['registre'];
		$siret = $row['siret'];
		$interet_gen = $row['interet_gen'];
		$but = $row['but'];
	}
?>

<div class="container">
    <div class="row">
		<div class="col-md-4 col-xs-12">
			<div id="pushInfos"></div>
			<div class="user-details">
	            <div class="user-image">
	                <img src="<?php echo $urlLogoThumb ?>" alt="Logo Membre" title="Logo Membre" class="img-circle">
	            </div>
	            <div class="user-info-block">
	                <div class="user-heading">
	                    <h4><?php echo $nom; ?></h4>
	                    <h5><?php echo $suite_nom; ?></h5>
	                </div>
	                <ul class="navigation">
	                    <li class="active">
	                        <a data-toggle="tab" href="#information">
	                            <span class="glyphicon glyphicon-user"></span>
	                        </a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#adresse">
	                            <span class="glyphicon glyphicon-home"></span>
	                        </a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#administratif">
	                            <span class="glyphicon glyphicon-eye-open"></span>
	                        </a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#contact">
	                            <span class="glyphicon glyphicon glyphicon-envelope"></span>
	                        </a>
	                    </li>
	                </ul>
	                <div class="user-body">
	                    <div class="tab-content">
	                        <div id="information" class="tab-pane active">
								<div class="panel panel-default">
								  <div class="panel-heading"><h5>Nom de l'association</h5></div>
								  <div class="panel-body">
								    <?php echo $nom; ?>
									<span class="help-block"><?php echo $suite_nom; ?></span>
								  </div>
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading"><h5>But de l'association</h5></div>
								  <div class="panel-body">
								    <?php echo $but; ?>
								  </div>
								</div>
	                        </div>
	                        <div id="adresse" class="tab-pane">
								<div class="panel panel-default">
								  <div class="panel-heading"><h5>Adresse Postale</h5></div>
								  <div class="panel-body">
								    <?php echo ''.$adresse_postale.'<br>'.$commune.'<br>'.$codepostal.'';  ?>
								  </div>
								</div>
	                        </div>
	                        <div id="administratif" class="tab-pane">
								<div class="panel panel-default">
								  <div class="panel-heading">Numéro SIRET/SIREN</div>
								  <div class="panel-body">
								    <?php echo $siret; ?>
								  </div>
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">Numéro Waldec</div>
								  <div class="panel-body">
								    <?php echo $registre; ?>
								  </div>
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">Numéro APE</div>
								  <div class="panel-body">
								    <?php echo $ape; ?>
								  </div>
								</div>
	                        </div>
							<div id="contact" class="tab-pane">
								<div class="panel panel-default">
								  <div class="panel-heading">Adresse mail</div>
								  <div class="panel-body">
								  	<?php echo $mail; ?>
								  </div>
								</div>
								<div class="panel panel-default">
								  <div class="panel-heading">Site Internet</div>
								  <div class="panel-body">
									<a href="http://<?php echo $site_web; ?>" target="_blank"><?php echo $site_web; ?></a>
								  </div>
								</div>
							</div>
	                    </div>
	                </div>
	            </div>
	        </div>
		</div>
        <div class="col-md-8 col-xs-12">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-file">
                            </span>Fiche renseignement de l'association</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Nom de l'association</span>
                                            <input id="nom_asso" type="text" class="form-control" value="<?php echo $nom; ?>" placeholder="Nom de l'association" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Suite du nom</span>
                                            <input id="suite_nom" type="text" class="form-control" value="<?php echo $suite_nom; ?>" placeholder="" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tags">
                                            Description</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">But de l'association</span>
                                            <textarea class="form-control" cols="50" rows="5" id="but"><?php echo $but; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
                                    	<label for="tags">
                                        	Logo de l'association
										</label>
										<div class="input-group">
											<span class="btn btn-default btn-sm fileinput-button">
									        	<i class="glyphicon glyphicon-plus"></i>
									        	<span>Choisir logo </span>
									     	    <!-- The file input field used as target for the file upload widget -->
									    		<input id="fileupload" type="file" name="files[]" data-url="server/php/" multiple>
											</span>
											<h5><span class="glyphicon glyphicon-info-sign"></span> Image .jpg seulement !</h5>
											<div id="progress" class="progress">
												<div class="progress-bar progress-bar-success"></div>
											</div>
											<div id="files" class="files"></div>
								   	 		<br>
										</div>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
									<div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Site Web</span>
                                            <input id="site_web" type="text" class="form-control" placeholder="url : http://" value="<?php echo $site_web; ?>" />
                                        </div>
									</div>
									<div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Mail</span>
                                            <input id="mail" type="text" class="form-control" placeholder="Ex : asso.1901@boulogne.fr" value="<?php echo $mail; ?>"/>
                                        </div>
									</div>
                                </div>
                                <div class="col-md-6">
                                    <button id="btnMajInfos" type="submit" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-floppy-disk"></span> Sauvegarder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-home">
                            </span>Adresse</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                           <span class="input-group-addon">Adresse Postale</span>
                                           <input type="text" id="adressepostale" class="form-control" placeholder="Ex : 19 Rue Wicardenne" value="<?php echo $adresse_postale; ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                        	<span class="input-group-addon">Code Postal</span>
                                        	<input type="text" id="codepostal" class="form-control" placeholder="Ex : 62200" value="<?php echo $codepostal; ?>" required />
										</div>
                                    </div>
                                    <div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Commune</span>
                                        	<input type="text" id="commune" class="form-control" placeholder="Ex : Boulogne-sur-Mer" value="<?php echo $commune; ?>" required />
										</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="btnMajInfosAdresse" type="submit" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-floppy-disk"></span>Sauvegarder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-eye-open">
                            </span>Administratif</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                           <span class="input-group-addon">Numéro SIRET / SIREN</span>
                                           <input type="text" id="num_siret" class="form-control" placeholder="" value="<?php echo $siret; ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                           <span class="input-group-addon">Numéro RNA (Waldec)</span>
                                           <input type="text" id="num_registre" class="form-control" placeholder="Composé d'un W suivi de 9 chiffres" value="<?php echo $registre; ?>" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                           <span class="input-group-addon">Numéro APE</span>
                                           <input type="text" id="num_ape" class="form-control" placeholder="" value="<?php echo $ape; ?>" required />
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
											<h4>Association d'intérêt général ?</h4>
					     		   			<div id="optionRadioButtonInteretGeneral" class="ui-group-buttons" data-toggle="buttons-radio">
					       			 			<button type="button" class="btn btn-primary btn-sm" data-value="yes" active>Oui</button>
					        					<div class="or or-sm"></div>
					        					<button type="button" class="btn btn-default btn-sm" data-value="no">Non</button>
											</div>
                                    </div>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="btnMajInfosAdmin" type="submit" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-floppy-disk"></span>Sauvegarder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-th-list">
                            </span>Liste des membres de l'association</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
								<div class="row">
                               		<div class="col-md-12">
										<table class="table table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>Nom</th>
												<th>E-mail</th>
												<th>Inscription</th>
												<th>Fonction</th>
												<th>Cotisation</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$q = array(
													'user_id'=>$user_id
												);
												$sql = 'SELECT id, prenom, nom, email, inscription, cotisation, fonction FROM membres WHERE users_on = :user_id';
												$req = $cnx->prepare($sql);
												$req->execute($q);
												while ($row = $req->fetch(PDO::FETCH_ASSOC)){
													echo"
														<tr>
															<td>".$row['id']."</td>
															<td>".$row['nom']."</td>
										  		      		<td>".$row['email']."</td>
												  		  	<td>".$row['inscription']."</td>
															<td>".$row['fonction']."</td>
														";
													if($row['cotisation'] == 1){
														echo"
															<td>
																<span class=\"label label-success\">Payée</span>
															</td>";
													}else{
														echo"
															<td>
																<span class=\"label label-danger\">Non payée</span>
															</td>";	
														}
													echo"
														</tr>";	
												}
											?>
										</tbody>
										</table>
										<?php include 'membres/modalMembres.php'; ?>
                                    	<button href="#infosMembres" type="submit" class="btn btn-default btn-sm" data-toggle="modal">
                                    	<span class="glyphicon glyphicon-book"></span> Informations sur vos membres</button>
									</div>
								</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<!-- 
  Fonction Javascript permettant l'upload de fichier : https://github.com/blueimp/jQuery-File-Upload  
-->
<script type="text/javascript" src="infos/updateInfos.js"></script>
<script>
$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });
});
</script>