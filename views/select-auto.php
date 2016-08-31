<?php
include 'connect.php';

// get all cars and write each to an option element
$result = mysqli_query( $con , "SELECT * FROM auto WHERE auto.user_id = $user_id" );

while( $row = mysqli_fetch_array ( $result ) ) {
	echo"<option value=" . $row['0'] . ">" . $row['2'] . " " . $row['3'] . " uit " . $row['4'] . "</option>";
}
		
//close connection
mysqli_close($con);
?>