<?php

// security check for admin input with regex and preg_match

$submit = true;
$pcode=$_POST["pcode"];

function check_id ($pcode, &$submit)
{
	if (empty($pcode))
	{
		echo "<script type='text/javascript'>alert('Please enter a product ID.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	if (!preg_match("/[0-9]/", $pcode))
	{
		echo "<script type='text/javascript'>alert('Invalid product ID.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	return;
}

check_id($pcode, $submit);

if ($submit == true)
{
	  $dbservername= "161.117.122.252:3306";
$dbusername="p5_10";
$dbpassord="PDbg9Q0g67";
$dbname="p5_10";

$con = mysqli_connect($dbservername, $dbusername, $dbpassord, $dbname); 

if (!$con) {
    die("Connection faled: ".mysqli_connect_error());
}
	
	$pcode=$_POST["pcode"];
	$query= $con->prepare("DELETE FROM inventory WHERE product_id= '$pcode'"); // delete item from products database
	
	if ($query->execute()){
		
                echo "<script type='text/javascript'>alert('Product successfully deleted!');window.location.href = 'listview.php';</script>";
	}else{
                 echo "<script type='text/javascript'>alert('Error occurred. Check your input again.');window.location.href = 'listview.php';</script>";
	}
}
?>




