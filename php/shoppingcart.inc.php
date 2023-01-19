<?php

if (!isset($_POST['addtocart'])) {
    header("Location:../index.php");
    exit();
} else {
    require 'dbconnection.inc.php';
    session_start();
    if ($_SESSION["admin"] == 1) {
        header("Location: ../index.php?msg=normaluser");
        exit();
    }
    else{
    $user_id = $_SESSION['userid'];
    $pid = $_POST['productid'];
    $quantity = sanitize_input($_POST['userquantity']);
    if (!preg_match('/^[0-9]+$/', $quantity)) {
        header("Location: ../cart.php?msg=onlynumber");
        exit();
    } else {
        $sql = "SELECT * FROM p5_10.inventory WHERE product_id='$pid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $title = $row['ptitle'];
            $price = $row['pprice'];
            $pquantity = $row['pquantity'];
            $imagepath = $row['pimagepath'];

            $check = "SELECT * FROM shoppingcart WHERE product_id_fk='$pid' AND uid_fk='$user_id'";
            $dup = mysqli_query($con, $check);
            $dupcheck = mysqli_num_rows($dup);
            $eq = mysqli_fetch_assoc($dup);
            // echo $dupcheck;
            if ($dupcheck > 0) {
                $aquantity = $eq['userquantity'];
                $bquantity = $aquantity + $quantity;
                $updatecartquantity = "UPDATE shoppingcart SET userquantity='$bquantity' WHERE product_id_fk='$pid' && uid_fk='$user_id'";
                if ($con->query($updatecartquantity) == TRUE) {
                    header("Location: ../cart.php?success");
                } else {
                    header("Location: ../cart.php?failure");
                }
            } else {
                $insert = "INSERT INTO shoppingcart (uid_fk, product_id_fk, userquantity, ptitle, pprice, pquantity, imagepath) "
                        . "VALUES ('$user_id', '$pid', '$quantity', '$title', '$price', '$pquantity', '$imagepath')";
                if ($con->query($insert) == TRUE) {
                    header("Location: ../cart.php?success");
                } else {
                    header("Location: ../cart.php?failure");
                }
            }
        }
    }
}}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
