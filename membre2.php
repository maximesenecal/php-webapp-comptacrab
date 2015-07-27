<?php
	include 'header.php';

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
		<div class="col-md-12 col-xs-12">
			<ul class="nav nav-tabs">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Presentation</a></li>
				<li role="adresse"><a href="#adresse" aria-controls="adresse" role="tab" data-toggle="tab">Adresse</a></li>
				<li role="adresse"><a href="#administratif" aria-controls="adresse" role="tab" data-toggle="tab">Administratif</a></li>
				<li role="adresse"><a href="#reseauxsociaux" aria-controls="adresse" role="tab" data-toggle="tab">Réseaux sociaux</a></li>
				<li role="membres"><a href="#membres" aria-controls="membres" role="tab" data-toggle="tab">Gestion membres</a></li>
			</ul>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="home">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">Nom de l'association</span>
							<input id="nom_asso" type="text" class="form-control" value="<?php echo $nom; ?>" placeholder="Nom de l'association" required />
						</div>
						<div class="input-group">
							<span class="input-group-addon">Suite du nom</span>
							<input id="suite_nom" type="text" class="form-control" value="<?php echo $suite_nom; ?>" placeholder="" required />
						</div>
					</div>
					<div class="col-md-12 col-xs-12">
						<div class="col-md-6">
							<div class="form-group">
								<label for="tags">Description</label>
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
										<input id="fileupload" type="file" name="files[]" multiple>
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
					<div class="col-md-12 col-xs-12">
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
			    <div role="tabpanel" class="tab-pane" id="adresse">
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
			    <div role="membres" class="tab-pane" id="membres">
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
			    				<span class="glyphicon glyphicon-book"></span> Informations sur vos membres
			    			</button>
			    		</div>
			    	</div>
  				</div>

<!--
 * 
 * Ancienne disposition
 *
-->

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
	                        <a data-toggle="tab" href="">
	                            <span class="glyphicon glyphicon-user"> </span>
	                        </a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#adresse">
	                            <span class="glyphicon glyphicon-home"> Adresse</span>
	                        </a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#administratif">
	                            <span class="glyphicon glyphicon-eye-open"> Administratif</span>
	                        </a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#contact">
	                            <span class="glyphicon glyphicon glyphicon-envelope"> Contact</span>
	                        </a>
	                    </li>
	                    <li>
	                        <a data-toggle="tab" href="#membres">
	                            <span class="glyphicon glyphicon glyphicon-user"> Membres</span>
	                        </a>
	                    </li>
	                </ul>
	                <div class="user-body">
	                    <div class="tab-content">
	                        <div id="information" class="tab-pane active">
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
											    		<input id="fileupload" type="file" name="files[]" multiple>
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
<script type="text/javascript" src="vendor/blueimp/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script type="text/javascript" src="vendor/blueimp/jquery-file-upload/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="vendor/blueimp/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script>

$('#TabsAsso a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

$(function () {
    'use strict';
	/*
	 * URL à modifier pour le nom de domaine (1) le chemin de UploadHandler.php (3)
	 */
    var url = window.location.hostname === '' ?
              '//jquery-file-upload.appspot.com/' : 'vendor/blueimp/jquery-file-upload/server/php/';

    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
				//file.name = "<?php echo $user_id; ?>.png";
                $('<h4/>').text("Chargement terminé.").appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
<!-- 
  Fonction Javascript permettant la mise à jour des nouvelles informations renseignées
-->