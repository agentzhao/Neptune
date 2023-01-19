<?php

// security check on all input with regex and preg_match

$submit = true;
$pcode=$_POST["pcode"];
$pimagepath=$_POST["pic"];
$pname=$_POST["pname"];
$pprice = $_POST["pprice"];
$pquantity = $_POST["pquantity"];
$pdescription = $_POST["pdescription"];
$pdates = $_POST["pdate"];
$pduration = $_POST["pduration"];
$planguage = $_POST["planguage"];
$pvenue = $_POST["pvenue"];



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


function check_name ($pname, &$submit)
{
	if (empty($pname))
	{
		echo "<script type='text/javascript'>alert('Please enter a name.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	if (!preg_match("/^([A-Za-z])+$/", $pname))
	{
		echo "<script type='text/javascript'>alert('Invalid name.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	return;
}

function check_price ($pprice, &$submit)
{
	if (empty($pprice))
	{
		echo "<script type='text/javascript'>alert('Please enter a price.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	if (!preg_match("/[0-9\.]/", $pprice))
	{
		echo "<script type='text/javascript'>alert('Invalid price.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	return;
}

function check_image ($pimagepath, &$submit)
{
	if (empty($pimagepath))
	{
		echo "<script type='text/javascript'>alert('Please enter a imagepath.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	if (!preg_match("/(.*)\.(jpg|gif|png)$/i", $pimagepath))
	{
		echo "<script type='text/javascript'>alert('Invalid imagepath.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	return;
}


function check_quantity ($pquality, &$submit)
{
	if (empty($pquality))
	{
		echo "<script type='text/javascript'>alert('Please enter a quantity.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	if (!preg_match("/[0-9]/", $pquality))
	{
		echo "<script type='text/javascript'>alert('Invalid quantity.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	return;
}

function check_description ($pdescription, &$submit)
{
	if (empty($pdescription))
	{
		echo "<script type='text/javascript'>alert('Please enter product features.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	if (!preg_match("/^([A-Za-z0-9\s\.\,\=\n])+$/", $pdescription))
	{
		echo "<script type='text/javascript'>alert('Invalid characters in features.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	return;
}



function check_duration ($pduration, &$submit)
{
    if (empty($pduration))
    {
        echo "<script type='text/javascript'>alert('Please enter a duration');window.location.href = 'listview.php';</script>";
        $submit = false;
    }

    if (!preg_match("/[0-9]/", $pduration))
    {
        echo "<script type='text/javascript'>alert('Invalid product duration');window.location.href = 'listview.php';</script>";
        $submit = false;
    }

        return;
}   


function check_language ($planguage, &$submit)
{
	if (empty($planguage))
	{
		echo "<script type='text/javascript'>alert('Please enter a language.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	if (!preg_match("/^([A-Za-z])+$/", $planguage))
	{
		echo "<script type='text/javascript'>alert('Invalid language.');window.location.href = 'listview.php';</script>";
		$submit = false;
	}

	return;
}



check_id($pcode, $submit);
check_name($pname, $submit);
check_price ($pprice, $submit);
check_quantity ($pquantity, $submit);
check_description ($pdescription, $submit);
check_image ($pimagepath, $submit);
check_language ($planguage, $submit);
check_duration ($pduration, $submit);

 
if ($submit == true)// if all inputs pass the security check:
{
$dbservername= "161.117.122.252:3306";
$dbusername="p5_10";
$dbpassord="PDbg9Q0g67";
$dbname="p5_10";

$con = mysqli_connect($dbservername, $dbusername, $dbpassord, $dbname); 

if (!$con) {
    die("Connection faled: ".mysqli_connect_error());
}

$query= $con->prepare("INSERT INTO `inventory` (`product_id`, `ptitle`, `pprice`, `pquantity`, `pdescription`,`pdates`,`pimagepath`,`pduration`,`planguage`,`pvenue`) VALUES
(?,?,?,?,?,?,?,?,?,?)"); // add the product into database

$pcode=$_POST["pcode"];
$pname=$_POST["pname"];
$pprice = $_POST["pprice"];
$pquantity = $_POST["pquantity"];
$pdescription = $_POST["pdescription"];
$pdates = $_POST["pdate"];
$pimagepath=$_POST["pic"];
$pduration = $_POST["pduration"];
$planguage = $_POST["planguage"];
$pvenue = $_POST["pvenue"];




$query->bind_param('isiissssss', $pcode, $pname, $pprice, $pquantity, $pdescription,$pdates,$pimagepath,$pduration,$planguage,$pvenue); //bind the parameters
if ($query->execute()){  //execute query

        echo "<script type='text/javascript'>alert('Product successfully added.');window.location.href = 'listview.php';</script>";
}

else{ 
    echo "<script type='text/javascript'>alert('Error occurred. Check your input again.');window.location.href = 'listview.php';</script>";
	
}
}
?> 