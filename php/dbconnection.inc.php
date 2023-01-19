<?php

$dbservername= "161.117.122.252:3306";
$dbusername="p5_10";
$dbpassord="PDbg9Q0g67";
$dbname="p5_10";

$con = mysqli_connect($dbservername, $dbusername, $dbpassord, $dbname); 

if (!$con) {

   die("Connection failed: ".mysqli_connect_error());
}

        