<?php
	session_start();
	require_once 'auth.php';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="" />
    	<meta name="author" content="Centre de Ressources des Associations Boulonnaises" />
    	<meta property="og:title" content="Application web de gestion de comptabilité pour associations." />
		<meta property="og:description" content="" />
		<meta property="og:image" content="" />
    	<link rel="shortcut icon" href="favicon.png" />
		<title>Gestion Compta CRAB</title>

		

		<!-- Bootstrap & JQuery -->
		<link rel="stylesheet" href="css/lumen-bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

		<!-- NProgress -->
		<link rel="stylesheet" href="css/nprogress.css" />
		<script type="text/javascript" src="js/nprogress.js"></script>

		<!-- JQuery File Upload -->
		<link rel="stylesheet" href="vendor/blueimp/jquery-file-upload/css/jquery.fileupload.css" />
		
		<!-- Footable -->
		<link href="css/footable.core.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/bootstrap-select.js"></script>
		<script src="js/footable.js" type="text/javascript"></script>
		<script src="js/footable.filter.js" type="text/javascript"></script>
		<script src="js/footable.paginate.js" type="text/javascript"></script>
		<script src="js/footable.sort.js" type="text/javascript"></script>

		<!-- Timepicker -->
		<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/ >
		<script src="js/jquery.datetimepicker.js"></script>

		<link rel="stylesheet" href="css/style.css" />
	</head>

	<body>

	<header class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="index.php"><img src="img/comptaCrab.png" class="img-responsive hidden-xs hidden-sm" alt="Responsive image Logo"></p></a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="divider-vertical"></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Mon Compte
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li>
							<div class="navbar-content">
								<div class="row">
									<div class="col-lg-5">
										<?php 
										if(Auth::islog()){
											/*
											 * Chargement du chemin vers le logo user
											 */
											$urlLogo = "img/assos/users/".$_SESSION['Auth']['email'];
											$urlLogo .= '.jpg';
											if(!is_file($urlLogo)){
												$urlLogo = "img/assos/users/user_default.png";
											}
											/*
											 * Chargement de la classe Imagine pour redimensionner les images
											 */ 
											$imagine = new Imagine\Gd\Imagine();
											$size = new Imagine\Image\Box(100,100);
											/*
											 * Sauvegarde de l'image redimesionnée
											 */ 
											$imagine->open(''.$urlLogo.'')->thumbnail($size, 'inset')->save('img/assos/users/'.$user_id.'_100x100.png');

											/*
											 * Chemin vers l'image redimensionnée
											 */ 
											$urlLogoThumb = "img/assos/users/".$user_id."_100x100.png";
											echo "
											<img src=\"".$urlLogoThumb."\"
											alt=\"Logo User Thumb\" class=\"img-responsive img-circle\"/>";         
										}
										?>
									</div>
									<div class="col-lg-7">
										<span>
											<?php
											if(Auth::islog()){
												$val = $_SESSION['Auth']['email'];
												echo"".Securite::html($val)."";
											}else{
												echo"Non connecté.";
											}
											?>
										</span>
										<p class="text-muted small">
											© <a href="http://dsu-crab.fr/" target="_blank">dsu-crab.fr</a> - <a href="infos.txt" target="_blank">À propos (Version Bêta 2)</a>
										</p>
										<div class="divider">
										</div>
										<?php
										if(Auth::islog()){
											echo "<a href=\"#\" class=\"btn btn-default btn-sm\" disabled=\"disabled\"><span class=\"glyphicon glyphicon-cog\"></span> Paramètres</a><small>Prochainement</small><br />";
										}
										?>
									</div>
								</div>
							</div>
							<div class="clear"></div>
							<div class="navbar-footer">
								<div class="navbar-footer-content">
									<div class="row">
										<div class="col-md-6">
											<a href="#" class="btn btn-default btn-sm" disabled="disabled"><span class="glyphicon glyphicon-play"></span> Vidéos d'utilisation</a>
										</div>
										<div class="col-md-6">
											<?php
											if(Auth::islog()){
												echo "<a href=\"logout.php\" class=\"btn btn-danger btn-sm pull-right\"><span class=\"glyphicon glyphicon-log-out\"></span> Déconnexion</a>";
											}else{
												echo "<a href=\"index.php\" class=\"btn btn-success btn-sm pull-right\"><span class=\"glyphicon glyphicon-log-in\"></span> Connexion</a>";
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</li>
				<li>
					<a href="membre.php"><span class="glyphicon glyphicon-file"></span> Fiche Association</a>
				</li>
				<li>
					<a href="ecritures.php"><span class=" glyphicon glyphicon-pencil"></span> Écritures</a>
				</li>
				<li>
					<a href="tableau.php"><span class="glyphicon glyphicon-list"></span> Tableau</a>
				</li>
				<li>
					<a href="export.php"><span class="glyphicon glyphicon-cloud-download"></span> Export</a>
				</li>
			</ul>
	    </div>
	</div>
	</header>
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
		include 'footer.php';
	}""
	?>