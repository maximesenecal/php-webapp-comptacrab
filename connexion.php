<?php
	/* 
	 * Modifier selon la BDD
	 */
	
	/*
	$serveur = 'mysql5-22.perso';
	$user = 'dsucrabmod1';
	$pass = 'dbwHZ42N';
	$bdd = 'dsucrabmod1';
	$port = '3306';
	*/
	
	$serveur = '127.0.0.1';
	$user = 'root';
	$pass = 'root';
	$bdd = 'dsucrabmod1';
	$port = '8889';
	
	try{
		$cnx = new PDO('mysql:host='.$serveur.';port='.$port.';dbname='.$bdd, $user, $pass, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	catch(PDOException $e){
		echo "<div class=\"alert alert-message-danger\" style=\"margin-bottom: 0;\">";
		echo "Erreur de connexion à la base de donnée. ";
		echo $e->getMessage();
		echo "</div>";
	}
?>
