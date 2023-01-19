<?php

session_start();
require 'dbconnection.inc.php';
if (isset($_POST['update-submit'])) {
    $userid = $_SESSION["userid"];
    $quantity =sanitize_input($_POST['userquan']);
    $prodid = $_POST['prodID'];
    if (preg_match('/^[0-9]+$/', $quantity)) {
        $sqlcheck = "SELECT * FROM p5_10.inventory WHERE product_id='$prodid'";
        $sqlrt = mysqli_query($con, $sqlcheck);
        $row = mysqli_fetch_assoc($sqlrt);

        $stockquan = $row['pquantity'];
      
        if ( $quantity>$stockquan ) {
              //echo $stockquan; 
            header("Location: ../cart.php?msg=stocklow");
        } else {

            $state = mysqli_stmt_init($con);
            $sqlupdate = "UPDATE p5_10.shoppingcart SET userquantity='$quantity' WHERE product_id_fk='$prodid' && uid_fk='$userid'";
            if (!mysqli_stmt_prepare($state, $sqlupdate)) {
                header("Location: ../cart.php");
                exit();
            } else {
                mysqli_stmt_execute($state);
                header("Location: ../cart.php");
                exit();
            }
        }
    } else {
        header("Location: ../cart.php?msg=onlynumber");
        exit();
    }
} elseif (isset($_POST['delete-submit'])) {
    $userid = $_SESSION["userid"];
    $quantity = $_POST['userquan'];
    $prodid = $_POST['prodID'];

    $state = mysqli_stmt_init($con);
    $sqldelete = "DELETE FROM p5_10.shoppingcart WHERE product_id_fk='$prodid' && uid_fk='$userid'";
    if (!mysqli_stmt_prepare($state, $sqldelete)) {
        header("Location: ../cart.php");
        exit();
    } else {
        mysqli_stmt_execute($state);
        header("Location: ../cart.php");
        exit();
    }
} elseif (isset($_POST['payment-submit'])) {
    $ticket = $_POST['ticcount'];
    if ($ticket < 1) {
        header("Location: ../cart.php");
    } else {
        header("Location: ../payment.php");
    }
}
else{
        header("Location: ../index.php");
}

    
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
