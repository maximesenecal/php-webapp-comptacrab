$(document).ready(function($){
	
	$("button#btnAjoutEcriture").click( function() {
	NProgress.start();
	date = document.getElementById("datetimepicker-ecriture").value;
	NProgress.inc();
	intitule = document.getElementById("intituleEcriture").value;
	NProgress.inc();
	journal = document.getElementById("journalEcriture").value;
	NProgress.inc();
	mode_paiement = document.getElementById("modePaiementEcriture").value;
	NProgress.inc();
	compte = document.getElementById("compteEcriture").value;
	NProgress.inc();
	code_analytique = document.getElementById("codeAnalytiqueEcriture").value;
	NProgress.inc();
	montant = document.getElementById("montantEcriture").value;
	NProgress.inc();
	type_montant = $("#optionRadioOperation .active").data("value");

	$.post('ecritures/postAjoutEcriture.php', {
		date : date,
		intitule : intitule,
		journal : journal,
		mode_paiement : mode_paiement,
		compte : compte,
		code_analytique : code_analytique,
		montant : montant,
		type_montant : type_montant
	},
	function(output){
		NProgress.inc();
		$('#affNotif').html(output).fadeIn();
		NProgress.done();
	});
});

});