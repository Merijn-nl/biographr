<?php
include '../connect.php';

// escape variables for security
$auto_id = mysqli_real_escape_string($con, $_POST['auto_id']);
$afschr1 = mysqli_real_escape_string($con, $_POST['afschr1']);
$afschr2 = mysqli_real_escape_string($con, $_POST['afschr2']);
$afschr3 = mysqli_real_escape_string($con, $_POST['afschr3']);
$bel = mysqli_real_escape_string($con, $_POST['bel']);
$verz = mysqli_real_escape_string($con, $_POST['verz']);
$kmjaar = mysqli_real_escape_string($con, $_POST['kmjaar']);

$afschr = ($afschr1 + $afschr2 + $afschr3)/3;
$k = $afschr + $bel + $verz;
$kostenKm = round ( $k / $kmjaar , 3 );

// Check whether the car is not in the database already

$check1 = mysqli_query ( $con, "
	SELECT auto_id 
		FROM kosten" ) or die (mysqli_error());

$check2 = mysqli_query ( $con, "
	SELECT id, isactive
		FROM auto" ) or die (mysqli_error());

while ( $row = mysqli_fetch_array ( $check1 ) ) {
	$checkId[] = $row['auto_id'];
}

while ( $row = mysqli_fetch_array ( $check2 ) ) {
	$checkActive[$row['id']] = $row['isactive'];
}

$checkIdBool = in_array($auto_id, $checkId);

if ( $checkIdBool == FALSE || $checkActive[$auto_id] != "1" ) {
	
	// insert values into db
	mysqli_query ( $con , "
		INSERT INTO kosten 
			(auto_id, afschr1, afschr2, afschr3, bel, verz, gem_vast)
			VALUES ('$auto_id', '$afschr1', '$afschr2', '$afschr3', '$bel', '$verz', '$kostenKm')")
		or die (mysqli_error());
}

else {
	mysqli_query ( $con , "
		UPDATE kosten 
			SET afschr1 = '$afschr1',
				afschr2 = '$afschr2', 
				afschr3 = '$afschr3', 
				bel = '$bel',
				verz = '$verz', 
				gem_vast = '$kostenKm'
			WHERE auto_id = $auto_id")
		or die (mysqli_error());
}

mysqli_query ( $con , "
	UPDATE auto 
		SET isactive = 1
		WHERE id = $auto_id")
	or die (mysqli_error());

include 'success.php';

mysqli_close($con);
?>