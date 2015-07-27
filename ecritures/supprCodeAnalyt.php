<?php
	session_start();
	include 'header.php';
?>

<?php
if(Auth::islog()) {
	if(!empty($_POST)) {
		
		$description		 = Securite::bdd($_POST['choix_code']);
		
		$q   = array(
			'description'	=> $description,
			'user_id'		=> $user_id
		);
		$sql = 'DELETE FROM codes_analytiques WHERE user_id = :user_id AND description = :description';
		$req = $cnx->prepare($sql);
		
		try{
			$req->execute($q);
			echo"	<div class=\"alert span12 alert-success\">
    				<strong><i class=\"glyphicon glyphicon-ok\"></i> La suppression s'est déroulé correctement.</strong>
					</div>";
		}catch(Exception $e){
			echo"
					<div class=\"alert span12 alert-error\">
					<strong><i class=\"icon-ban-circle icon-white\"></i> Un problème est survenu pendant la suppresion. ".Securite::html($e->getMessage())."</strong>
					</div>";
		}
	}else{
			echo"
					<div class=\"alert span12 alert-error\">
					<strong><i class=\"icon-ban-circle icon-white\"></i> Erreur, aucun formulaire de suppression de code analytique n'a été reçu...</strong>
					</div>";
	}
}else{
			echo"
					<div class=\"container\">
						<div class=\"alert span9 alert-error\">
    						<strong><i class=\"icon-ban-circle icon-white\"></i> Vous devez vous connecter pour afficher cette page.</strong>
						</div>
					</div>";
}
?>

<?php
	include 'footer.php';
?>