<?php
	include 'header.php';
	$name = $_POST['file_data'];
	$chemin = "img/assos/users";
	$upload = upload($name,$chemin,15360, array('png','gif','jpg','jpeg') );
	if ($upload) "Upload du logo réussi!<br />";
?>