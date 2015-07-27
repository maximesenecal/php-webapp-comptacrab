$(document).ready(function($){
		
	$("button#btnMajInfos").click( function() {
		nom_asso = document.getElementById("nom_asso").value;
		suite_nom = document.getElementById("suite_nom").value;
		but = document.getElementById("but").value;
		site_web = document.getElementById("site_web").value;
		mail = document.getElementById("mail").value;

		$.post('infos/postMajInfos.php', {
			nom_asso : nom_asso,
			suite_nom : suite_nom,
			but : but,
			site_web : site_web,
			mail : mail,
			majInfos : 1
		},
		function(output){
			$('#pushInfos').html(output).fadeIn();
		});
	});
	
	$("button#btnMajInfosAdresse").click( function() {
		adresse = document.getElementById("adressepostale").value;
		codepostal = document.getElementById("codepostal").value;
		commune = document.getElementById("commune").value;

		$.post('infos/postMajInfos.php', {
			adresse : adresse,
			codepostal : codepostal,
			commune : commune,
			majInfosAdresse : 1
		},
		function(output){
			$('#pushInfos').html(output).fadeIn();
		});
	});
	
	$("button#btnMajInfosAdmin").click( function() {
		num_siret = document.getElementById("num_siret").value;
		num_registre = document.getElementById("num_registre").value;
		num_ape = document.getElementById("num_ape").value;
		interet_gen = $("#optionRadioButtonInteretGeneral .active").data("value");

		$.post('infos/postMajInfos.php', {
			num_siret : num_siret,
			num_registre : num_registre,
			interet_gen : interet_gen,
			num_ape : num_ape,
			majInfosAdmin : 1
		},
		function(output){
			$('#pushInfos').html(output).fadeIn();
		});
	});
});