$(document).ready(function($){
	
	$("button").popover();

    $(window).on('load', function () {
    	$('.selectpicker').selectpicker({
       	});
    });
	
	$("#recuCotisation").click( function() {
		$('#infosCotisations').show(400);
	});
	$("#waitCotisation").click( function() {
		$('#infosCotisations').hide(400);
	});
	
	/*
	 * Fonction affichant l'état de la cotisation du membre sélectionné
	 */
	$("select#selectMembre").change( function() {
	    i = this.selectedIndex;
		var nom = this.options[i].value;
		
		$.post("membres/postAffCotisation.php", {
			nomMembre : nom
		},
		function(output){
			$('#affDescription').html(output).fadeIn();
		});
	});
	/*
	 * Fonction d'ajout d'un nouveau membre
	 */
	$("button#btnAddNewMembre").click( function() {
	    nom = document.getElementById("nomNewMembre").value;
		prenom = document.getElementById("prenomNewMembre").value;
		email = document.getElementById("emailNewMembre").value;
		dateInscription = document.getElementById("dateInscriptionNewMembre").value;
		fonction = document.getElementById("FonctionNewMembre").value;
		adresse = document.getElementById("AdresseNewMembre").value;
		telephone = document.getElementById("TelNewMembre").value;

		$.post("membres/postAddMembre.php", {
			nom : nom,
			prenom : prenom,
			email : email,
			dateInscription : dateInscription,
			fonction : fonction,
			adresse : adresse,
			telephone : telephone
		},
		function(output){
			$('#pushAddMembre').html(output).fadeIn();
		});
	});
	/*
	 * Fonction de modification de l'état d'une cotisation d'un membre
	 */
	$("button#btnModifMembre").click( function() {
		name = document.getElementById("selectMembre").value;
		cotisation = $("#optionRadioButton .active").data("value");
		montant = document.getElementById("montantCotisation").value;
		addEcriture = $("#optionRadioAjoutEcriture .active").data("value");
		journal = document.getElementById("journalEcritureCotisation").value;
		compte = document.getElementById("compteEcritureCotisation").value;
		code_analytique = document.getElementById("codeAnaltEcritureCotisation").value;

		$.post("membres/postUpdateMembre.php", {
			name : name,
			cotisation : cotisation,
			montant : montant,
			addEcriture : addEcriture,
			journal : journal,
			compte : compte,
			code_analytique : code_analytique
		},
		function(output){
			$('#pushUpdateMembre').html(output).fadeIn();
		});
	});
	/*
	 * Fonction de suppression d'un membre
	 */
	$("button#btnDeleteMembre").click( function() {
		var membre = document.getElementById("listeMembres").value;

		$.post("membres/postDeleteMembre.php", {
			membre : membre,
		},
		function(output){
			$('#pushDeleteMembre').html(output).fadeIn();
		});
	});
});