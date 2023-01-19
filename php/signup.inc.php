<?php

if (isset($_POST["signup-submit"])) {
    require 'dbconnection.inc.php';
    $firstname = sanitize_input($_POST['fname']);
    $lastname = sanitize_input($_POST['lname']);
    $email = sanitize_input($_POST['signemail']);
    $password = sanitize_input($_POST['signpassword']);
    $conpassword = sanitize_input($_POST['signconpassword']);
    $url = $_SERVER['HTTP_REFERER'];
    $url = strtok($url, '?');

    $state = mysqli_stmt_init($con);
    $sqlemail = "SELECT email FROM userinfo WHERE email=?";

    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($conpassword)) {
        header("Location:" . $url . "?msg=emptyfield");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:" . $url . "?msg=invalidemail");
        exit();
    } elseif ($password != $conpassword) {
        header("Location:" . $url . "?msg=passwdnotsame");
        exit();
    } elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/", $password)) {
        header("Location:" . $url . "?msg=passwdreq");
        exit();
    }  elseif (!mysqli_stmt_prepare($state, $sqlemail)) {
        header("Location:" . $url . "?msg=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($state, "s", $email);
        mysqli_stmt_execute($state);
        mysqli_stmt_store_result($state);
        $checkemail = mysqli_stmt_num_rows($state);
        if ($checkemail > 0) {
            header("Location:" . $url . "?msg=emailtaken");
            exit();
        } else {
            $sqlinsert = "INSERT INTO userinfo (fname, lname, email, password, adminlevel) VALUES(?,?,?,?,?)";
            if (!mysqli_stmt_prepare($state, $sqlinsert)) {
                header("Location:" . $url . "?msg=sqlerror");
                exit();
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $level = 0;
                mysqli_stmt_bind_param($state, "sssss", $firstname, $lastname, $email, $hash, $level);
                mysqli_stmt_execute($state);
                header("Location:" . $url . "?msg=signupsuccess");
                exit();
            }
        }
    }
    mysqli_stmt_close($state);
    mysqli_close($con);
} else {
    header("Location:../index.php");
    exit();
}

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
