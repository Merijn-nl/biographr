<?php
include '../connect.php';

// escape variables for security
$auto_id = mysqli_real_escape_string($con, $_POST['auto_id']);
$datum = mysqli_real_escape_string($con, $_POST['datum']);
$kmstand = mysqli_real_escape_string($con, $_POST['kmstand']);
$kosten = mysqli_real_escape_string($con, $_POST['kosten']);
$garage = mysqli_real_escape_string($con, $_POST['garage']);
$bijz = mysqli_real_escape_string($con, $_POST['bijz']);

$orig = mysqli_query( $con, 
	"SELECT buy_kms
		FROM auto 
		WHERE id = $auto_id") 
	or die(mysql_error()); 
	
$kmArray = mysqli_fetch_array( $orig );
$kmOrig = $kmArray[0];

$kmDiff = $kmstand - $kmOrig;

$result = mysqli_query ( $con , 
	"SELECT kosten
		FROM onderhoud
		WHERE auto_id = $auto_id") 
	or die(mysql_error());
	
while ( $row = mysqli_fetch_array ( $result ) ) {
	$pastCost += $row["kosten"];
}

$totalCost = $pastCost + $kosten;
$averageCost = round ( ($totalCost / $kmDiff) , 3 );

echo $kmDiff . " " . $pastCost . " " . $kosten . " " . $totalCost . " " . $averageCost;

// insert values into db

mysqli_query ( $con,
	"INSERT INTO onderhoud 
		(auto_id, datum, kmstand, kosten, garage, bijz, gem_onderhoud)
	VALUES 
		('$auto_id', '$datum', '$kmstand', '$kosten', '$garage', '$bijz', '$averageCost')")
	or die (mysql_error());

mysqli_query ( $con,
	"UPDATE kosten 
		SET gem_onderhoud = $averageCost
	WHERE auto_id = $auto_id") 
	or die (mysql_error());

	include 'success.php';

mysqli_close($con);
?>