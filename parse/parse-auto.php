<?php
ob_start();

include '../connect.php';

// escape variables for security
$user_id = mysqli_real_escape_string($con, $_POST['user_id']);
$brand = mysqli_real_escape_string($con, $_POST['brand']);
$type = mysqli_real_escape_string($con, $_POST['type']);
$make = mysqli_real_escape_string($con, $_POST['make']);
$colour = mysqli_real_escape_string($con, $_POST['colour']);
$fuel = mysqli_real_escape_string($con, $_POST['fuel']);
$buy_kms = mysqli_real_escape_string($con, $_POST['buy_kms']);
$buy_date = mysqli_real_escape_string($con, $_POST['buy_date']);
$buy_price = mysqli_real_escape_string($con, $_POST['buy_price']);
?>
	<div id="selectpic">
		<?php
		//include class file
		include('../classes/googleimage.php');
		
		//create class instance
		$gimage = new GoogleImages();
		
		/*****************************
		call get_images method by providing 3 parameters
		1.) query - what should be searched for
		2.) cols - number of images per row
		3.) rows - number of rows
		*****************************/
		$car = $brand . " " . $type . " " . $colour . " " . $make;
		$gimage->get_images($car, 8, 1);						
		?>	
	</div>


<?php
// insert values into db
$sql="INSERT INTO auto (user_id, brand, type, make, fuel, buy_kms, buy_date, buy_price, colour)
VALUES ('$user_id', '$brand', '$type', '$make', '$fuel', '$buy_kms', '$buy_date', '$buy_price', '$colour')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

while (ob_get_status()) 
{
    ob_end_clean();
}

//header ( "Location: ../index.php" );
include '../header.php';
include '../vastekosten.php';
include '../footer.php';
?>