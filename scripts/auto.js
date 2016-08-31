/*

Autokosten v0.1
September 2014

*/


/// Procedurele elementen
// tonen en verbergen van pagina-elementen

function showDiv(divId) {
	$("#forms").children().hide();
/* 	$("#buttons").slideUp( "slow" );  */
	$("#" + divId).slideDown( 750 );
}

function showForm(form) {
	$('#buttons').hide();
	$('#forms').load('/views/' + form + '.php');
}