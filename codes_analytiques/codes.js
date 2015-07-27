$(document).ready(function($){

	$("select#selectCode").change( function() {
	    i = this.selectedIndex;
		var id = this.options[i].value;
		
		$.post("codes_analytiques/postShowDescriptionCodeAnalt.php", {
			idCode : id
		},
		function(output){
			$('#affDescriptionCode').html(output).fadeIn();
		});
	});
	
	$("button#btnModifDescriptionCode").click( function() {
	    d1 = document.getElementById("selectCode");
		i = d1.selectedIndex;
		var idCode = d1.options[i].value;
		d2 = document.getElementById("newDescriptionCode"); 
		var update = d2.value;

		$.post("codes_analytiques/postUpdateDescriptionCodeAnalt.php", {
			idCode : idCode,
			newDescription : update
		},
		function(output){
			$('#pushUpdateDescriptionCode').html(output).fadeIn();
		});
	});
	
	$("button#btnAddNewCode.btn.btn-success").click( function() {
		var name = document.getElementById("nomNewCode").value;
		var details = document.getElementById("detailsNewCode").value;
		
		$.post("codes_analytiques/postAddNewCodeAnalt.php", {
			nomCode : name,
			detailsCode : details
		},
		function(output){
			$('#pushAddNewCode').html(output).fadeIn();
		});
	});
	
	$("button#btnDeleteCode").click( function() {
		var idCode = document.getElementById("listeCodes").value;

		$.post("codes_analytiques/postDeleteCodeAnalt.php", {
			idCode : idCode
		},
		function(output){
			$('#pushDeleteCode').html(output).fadeIn();
		});
	});
});