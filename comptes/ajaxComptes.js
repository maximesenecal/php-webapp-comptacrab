$(document).ready(function($){
	/*
	 * Affichage en AJAX des descriptions des comptes/comptes favoris
	 */
	$("select#selectComptesFavoris").change( function() {
	    i = this.selectedIndex;
		var idCompte = this.options[i].value;
		
		$.post("comptes/postShowDescription.php", {
			idCompte : idCompte
		},
		function(output){
			$('#pushShowDescriptionComptesFavoris').html(output).fadeIn();
		});
	});

	$("select#selectComptes").change( function() {
	    i = this.selectedIndex;
		var idCompte = this.options[i].value;
		
		$.post("comptes/postShowDescription.php", {
			idCompte : idCompte
		},
		function(output){
			$('#pushShowDescription').html(output).fadeIn();
		});
	});
	
	/*
	 * Bouton d'ajout/suppression d'un nouveau compte favori
	 */
	$("button#btnAddNewFavoriCompte").click( function() {
		var idCompte = document.getElementById("selectComptes").value;

		$.post("comptes/postUpdateFavorisComptes.php", {
			idCompte : idCompte
		},
		function(output){
			$('#pushAddCompteFavori').html(output).fadeIn();
		});
		location.reload();
	});
	
	$("button#btnDeleteCompteFavoris").click( function() {
		var idCompte = document.getElementById("listeComptes").value;

		$.post("comptes/postDeleteFavorisComptes.php", {
			idCompte : idCompte
		},
		function(output){
			$('#pushDeleteCompte').html(output).fadeIn();
		});
		location.reload();	
	});
});