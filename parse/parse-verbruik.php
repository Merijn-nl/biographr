<?php
include '../connect.php';

// escape variables for security
$auto_id = mysqli_real_escape_string($con, $_POST['auto_id']);
$datum = mysqli_real_escape_string($con, $_POST['datum']);
$kmstandNieuw = mysqli_real_escape_string($con, $_POST['kmstand']);
$litersNieuw = mysqli_real_escape_string($con, $_POST['liters']);
$kostenNieuw = mysqli_real_escape_string($con, $_POST['kosten']);

// retrieve milage values from database
$verbruik = mysqli_query( $con , "
	SELECT 
		kmstand,
		liters,
		kosten 
		FROM verbruik
		WHERE auto_id = '$auto_id'" )
	or die (mysqli_error(errorMsg(4)));
	
$orig = mysqli_query( $con, 
	"SELECT
		buy_kms
		FROM auto 
		WHERE id = '$auto_id'")
	or die (mysqli_error(errorMsg(4)));
	
$kmArray = mysqli_fetch_array( $orig );
$kmOrig = $kmArray[0];

// Fill the Old Data arrays
$i = 0;
while ( $row = mysqli_fetch_array( $verbruik )) {
	$kmstandOud[$i] = $row["kmstand"];
	$litersOud[$i] = $row["liters"];
	$kostenOud[$i] = $row["kosten"];
	$i++;
}

$i--;

/// Kosten per kilometer
// Bereken de gemiddelde kosten per kilometer voor brandstof op drie decimalen
$kmTotal = $kmstandNieuw - $kmOrig;

if ( $kmTotal < 0 ) {
	$error = 1;
	errorMsg($error);
}

if (is_double($kostenOud)) {
	$kostenTotal = $kostenOud;
}
else {
	$kostenTotal = array_sum ( $kostenOud );	
}

$kostenTotal += $kostenNieuw;
$gemKosten = round( $kostenTotal / $kmTotal , 3 );

echo "gem kosten: " . $gemKosten . "<br/>";


/// Verbruik
// Bereken het gemiddeld verbruik in kilometers per liter

// The first entry for any car throws an error if the input is handled as an array, so we handle it as a string
if (is_double($litersOud)) {
	$litersTotal = $litersOud;
}
else {
	$litersTotal = array_sum ( $litersOud );	
}

$litersTotal += $litersNieuw;
$gemVerbruik = round( $kmTotal / $litersTotal , 3 );

echo "gem verbruik: 1 op " . $gemVerbruik . "<br/>";

// Bereken het gemiddeld verbruik (in km/l) over de afgelopen drie tankbeurten
if ($i == 0) {
	$gemVerbruikD = 0; 
	$error = 2;
	errorMsg($error);
}
else {
	if ($i == 1) {
		$kmD = $kmstandNieuw - $kmOrig;
	}
	else {
		$kmD = $kmstandNieuw - $kmstandOud[$i - 2];
	}
	$litersD = $litersNieuw + $litersOud[$i] + $litersOud[$i - 1];
	$gemVerbruikD = round( $kmD / $litersD , 3 );
	
	echo $kmD ."<br/>";
	echo $litersD ."<br/>";
		
	echo "gem verbruik laatste drie tankbeurten: 1 op " . $gemVerbruikD . "<br/>" . "<br/>" . "<br/>";
}

// Bereken het gemiddeld verbruik (in km/l) over de afgelopen 5000 kilometer
// Deze functie vindt de nabijgelegen waarde 5000 kilometer geleden
function getClosest( $search , $arr ) {
   $closest = null;
   foreach( $arr as $item ) {
   	if( $search - $closest < 0 ) {
	   	$closest = null;
   	}
   	if( $closest == null || abs( $search - $closest ) > abs( $item - $search ) ) {
	 	$closest = $item;
      }
   }
   return $closest;
}

// Als nog geen 5000km gereden dan blijft deze categorie leeg
if ( $kmTotal < 5000 ) {
	$gemVerbruikV = 0;
	$error = 3;
	errorMsg($error);
}
else {
	// Sort the db descending to more easily find the right value in getClosest();
	rsort($kmstandOud);
	$kmTemp = $kmstandNieuw - 5000;
	$kmClosest = getClosest( $kmTemp , $kmstandOud );
	$kmV = $kmstandNieuw - $kmClosest;
	
/* debug
	echo $kmTemp . "<br/>";
	echo $kmstandNieuw . "<br/>";
	echo $kmClosest . "<br/>";
*/
	
	// Vind de positie van de kilometerstand 5000 km geleden
	sort($kmstandOud);
	$j = array_search( $kmClosest , $kmstandOud );
	// Omdat we liters van de kilometerstand 5000 geleden niet meenemen, moeten we hier j++ doen
	$j++;
	
/* debug
	echo $i . "<br/>";
	echo $j . "<br/>";
*/
	
	// Pas deze nieuwe positie toe op de liters array en tel alle volgende waarden op
	$litersV = $litersNieuw;
	for ( $s = $j ; $s <= $i ; $s++ ) {
		$litersV += $litersOud[$s];
	}
	
/* 	echo $litersV . "<br />";  debug */
	
	$gemVerbruikV = round ( $kmV / $litersV , 3 );

	echo "gem verbruik laatste " . $kmV . " km: 1 op " . $gemVerbruikV . "<br />";
}

// insert values into db only if there's been no error
if ($success =! 0) {
	mysqli_query( $con,
		"INSERT INTO verbruik 
			(auto_id, datum, kmstand, liters, kosten, gemkosten, gemverbruik, gemverbruik3, gemverbruik5000)
			VALUES ('$auto_id', '$datum', '$kmstandNieuw', '$litersNieuw', '$kostenNieuw', $gemKosten, $gemVerbruik, $gemVerbruikD, $gemVerbruikV)")
		or die (mysqli_error(errorMsg(4)));
	
	mysqli_query ( $con,
		"UPDATE kosten 
			SET gem_brandstof = $gemKosten
			WHERE auto_id = $auto_id") 
		or die (mysqli_error(errorMsg(4)));
	
	include 'success.php';
}

function errorMsg($code) {
	switch($code) {
		case 1 :
			echo"Er is iets misgegaan bij het invullen; de ingevulde kilometerstand ligt lager dan de opgegeven kilometerstand bij aanschaf. <a href='" 
				. $_SERVER['HTTP_REFERER'] 
				. "'>Ga terug</a> om de juiste kilometerstand in te vullen.<br />";
			break;
		case 2 : 
			echo "Nog geen drie tankbeurten. Er is onvoldoende data om deze categorie te berekenen. <br />";
			break;		
		case 3 :
			echo "Nog geen 5000km gereden; onvoldoende data om het verbruik over de laatste 5k km te berekenen. <br />";
			break;
		case 4 :
			echo "Fout bij het verbinden met de database. Probeert u het nog eens door op F5 te drukken. <br />";
			break;
	}
}
	
mysqli_close($con);
?>