<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_POST['payment-submit'])) {
    require 'dbconnection.inc.php';
    date_default_timezone_set('Asia/Singapore');
    session_start();
    $state = mysqli_stmt_init($con);
    $sqlorder = "INSERT INTO p5_10.order (uid, datetime) VALUES (?,? )";
    $uid = $_SESSION["userid"];
    $date = date("M,d,Y h:i:s A");
    $insertsuccess = false;
    if (!mysqli_stmt_prepare($state, $sqlorder)) {
        header("Location:../cart.php");
        exit();
    } else {
        mysqli_stmt_bind_param($state, "ss", $uid, $date);
        mysqli_stmt_execute($state);

        $selectorderid = "SELECT * FROM p5_10.order WHERE uid='$uid' ORDER BY datetime DESC Limit 1";
        $selectorderidresults = mysqli_query($con, $selectorderid);
        $orderidrow = mysqli_fetch_assoc($selectorderidresults);
        $orderid = $orderidrow['orderid'];
        
        $sqlcart = "SELECT * FROM p5_10.shoppingcart WHERE uid_fk='$uid'";
        $result = mysqli_query($con, $sqlcart);
        while ($row = mysqli_fetch_assoc($result)) {
            $ptitle = $row['ptitle'];
            $price = $row['pprice'];
            $userquantity = $row['userquantity'];
            $imagepath = $row['imagepath'];
            $pproductid = $row['product_id_fk'];

            // sn, orderid, product_id_fk, ptitle, pprice, pquantity, imagepath
            $insert = "INSERT INTO orderdetails (orderid, product_id_fk, ptitle, pprice, pquantity, imagepath) 
                    VALUES ('$orderid', '$pproductid', '$ptitle', '$price', '$userquantity', '$imagepath')";
            $res = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($res, $insert)) {
                $insertsuccess = false;
            } else {
                mysqli_stmt_execute($res);
                $insertsuccess = true;


                $sqlgetstockbyid = "SELECT * FROM p5_10.inventory WHERE product_id='$pproductid'";
                $sqlgetstockbyidresults = mysqli_query($con, $sqlgetstockbyid);
                $sqlgetstockbyidrow = mysqli_fetch_assoc($sqlgetstockbyidresults);
                $pquantitycheck = $sqlgetstockbyidrow['pquantity'];

                $newquantity = $pquantitycheck - $userquantity;
              
                
                $sqlupdate = "UPDATE p5_10.inventory SET pquantity='$newquantity' WHERE product_id='$pproductid'";
                $stateupdate = mysqli_stmt_init($con);
                mysqli_stmt_prepare($stateupdate, $sqlupdate);
                mysqli_stmt_execute($stateupdate);
            }
        }

        if ($insertsuccess == true) {
            $sqlremove = "DELETE FROM p5_10.shoppingcart WHERE uid_fk='$uid'";
            $stateremove = mysqli_stmt_init($con);
            mysqli_stmt_prepare($stateremove, $sqlremove);  
            mysqli_stmt_execute($stateremove);
            header("Location: ../index.php?msg=paysuccess");
            
        }



        exit();
    }
} 

else {
    header("Location:../index.php");
}