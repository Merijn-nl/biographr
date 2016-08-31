<?php
include '../connect.php';

// escape variables for security
$auto_id = mysqli_real_escape_string($con, $_POST['auto_id']);
$datum = mysqli_real_escape_string($con, $_POST['datum']);
$vergoeder = mysqli_real_escape_string($con, $_POST['vergoeder']);
$gereden_kms = mysqli_real_escape_string($con, $_POST['gereden_kms']);
$opbrengst = mysqli_real_escape_string($con, $_POST['opbrengst']);
$bijz = mysqli_real_escape_string($con, $_POST['bijz']);

// Get first known Kmstand
$orig = mysqli_query( $con, 
	"SELECT buy_kms
		FROM auto 
		WHERE id = $auto_id") 
	or die(mysql_error()); 
	
$kmArray = mysqli_fetch_array( $orig );
$kmOrig = $kmArray[0];

// Get last known Kmstand and old revenue data	
$latest = mysqli_query( $con, 
	"SELECT kmstand 
		FROM verbruik" ) 
	or die(mysql_error()); 

while ( $row = mysqli_fetch_array( $latest )) {
	$kmstand[] = $row["kmstand"];
}

$kmMax = max( $kmstand );
$kmTotal = $kmMax - $kmOrig;
/* echo $kmTotal . "<br />"; */

$opbr = mysqli_query( $con,
	"SELECT
		gereden_kms, opbrengst
		FROM opbrengst")
	or die(mysql_error()); 

while ( $row = mysqli_fetch_array( $opbr )) {	
	$gereden_kmsOud[] = $row["gereden_kms"];
	$opbrengstOud[] = $row["opbrengst"];
}

$gereden_kmsTotal = array_sum ( $gereden_kmsOud ) + $gereden_kms;
/* echo $gereden_kmsTotal . "<br />"; */

$opbrengstTotal = array_sum ( $opbrengstOud ) + $opbrengst ;
/* echo $opbrengstTotal . "<br />"; */

$opbrengstVergoedeKm = round ( $opbrengstTotal / $gereden_kmsTotal , 3 );
$gemOpbrengstKm = round ( $opbrengstTotal / $kmTotal, 3 );

// insert values into db
mysqli_query($con,"
	INSERT INTO opbrengst 
		(auto_id, datum, vergoeder, gereden_kms, opbrengst, bijz, opbrengst_vergoede_km, gem_opbrengst_km)
		VALUES ('$auto_id', '$datum', '$vergoeder', '$gereden_kms', '$opbrengst', '$bijz', '$opbrengstVergoedeKm', '$gemOpbrengstKm')")
	or die (mysql_error());	

mysqli_query($con,"
	UPDATE kosten
		SET gem_opbrengst = $gemOpbrengstKm
		WHERE auto_id = $auto_id;")
	or die (mysql_error());	
	
include 'success.php';
mysqli_close($con);
?>