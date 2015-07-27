<?php
	session_start();
	require_once '../auth.php';
		
	if(!Auth::islog()){
		echo "Vous n'êtes pas connecté...";
		exit;
	}
	if(isset($_POST['majInfos'])){
		$nom_asso = $_POST['nom_asso'];
		$suite_nom = $_POST['suite_nom'];
		$but = $_POST['but'];
		$site_web = $_POST['site_web'];
		$mail = $_POST['mail'];
	
		$q   = array(
		'nom_asso' => $nom_asso,
		'suite_nom' => $suite_nom,
		'but' => $but,
		'site_web' => $site_web,
		'mail' => $mail,
		'user_id' => $user_id
		);

		$sql = 'UPDATE infos SET nom = :nom_asso, suite_nom = :suite_nom, but = :but, site_web = :site_web, mail = :mail WHERE id_user = :user_id';
		$req = $cnx->prepare($sql);
	
		try{
			$req->execute($q);
			echo"
				<div class=\"alert alert-success\">
					<h4><span class=\"glyphicon glyphicon-ok\"</span> La mise à jour de vos informations s'est effectuée avec succés.</h4>
				</div>
			";
		}catch(Exception $e){
			echo"
				<h3>Un problème est survenu pendant la suppresion. ".Securite::html($e->getMessage())."</h3>";
		}
	}
	elseif(isset($_POST['majInfosAdresse'])){
		$adresse_postale = $_POST['adresse'];
		$code_postal = $_POST['codepostal'];
		$commune = $_POST['commune'];
	
		$q   = array(
		'adresse_postale' => $adresse_postale,
		'code_postal' => $code_postal,
		'commune' => $commune,
		'user_id' => $user_id
		);

		$sql = 'UPDATE infos SET adresse_postale = :adresse_postale, code_postal = :code_postal, commune = :commune WHERE id_user = :user_id';
		$req = $cnx->prepare($sql);
	
		try{
			$req->execute($q);
			echo"
				<div class=\"alert alert-success\">
					<h4><span class=\"glyphicon glyphicon-ok\"</span> La mise à jour de votre adresse s'est déroulée avec succés.</h4>
				</div>
			";
		}catch(Exception $e){
			echo"
				<h3>Un problème est survenu pendant la suppresion. ".Securite::html($e->getMessage())."</h3>";
		}
	}
	elseif(isset($_POST['majInfosAdmin'])){
		$num_siret = $_POST['num_siret'];
		$num_registre = $_POST['num_registre'];
		$interet_gen = $_POST['interet_gen'];
		$num_ape = $_POST['num_ape'];
	
		$q   = array(
		'num_siret' => $num_siret,
		'num_registre' => $num_registre,
		'interet_gen' => $interet_gen,
		'num_ape' => $num_ape,
		'user_id' => $user_id
		);

		$sql = 'UPDATE infos SET ape = :num_ape, registre = :num_registre, siret = :num_siret, interet_gen = :interet_gen WHERE id_user = :user_id';
		$req = $cnx->prepare($sql);
	
		try{
			$req->execute($q);
			echo"
				<div class=\"alert alert-success\">
					<h4><span class=\"glyphicon glyphicon-ok\"</span> La mise à jour de vos renseignements administratifs s'est déroulée avec succés.</h4>
				</div>
			";
		}catch(Exception $e){
			echo"
				<h3>Un problème est survenu pendant la suppresion. ".Securite::html($e->getMessage())."</h3>";
		}
	}
?>