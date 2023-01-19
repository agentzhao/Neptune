<?php

if (isset($_POST["login-submit"])) {
    require 'dbconnection.inc.php';
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $url = $_SERVER['HTTP_REFERER'];
    $url = strtok($url, '?');

    $sqlname = "SELECT * FROM userinfo WHERE email=?";
    $state = mysqli_stmt_init($con);
    if ($_POST["g-recaptcha-response"] == '') {
        header("Location:" . $url . "?msg=recaptcha");
        exit();
    } elseif (!mysqli_stmt_prepare($state, $sqlname)) {
        header("Location:" . $url . "?msg=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($state, "s", $email);
        mysqli_stmt_execute($state);
        $result = mysqli_stmt_get_result($state);
        if ($row = mysqli_fetch_assoc($result)) {
            $checkpwd = password_verify($password, $row["password"]);
            if ($checkpwd == false) {
                header("Location:" . $url . "?msg=incorrect");
                exit();
            } else {
                session_start();
                $_SESSION["userid"] = $row["uid"];
                $_SESSION["userfname"] = $row["fname"];
                $_SESSION["userlname"] = $row["lname"];
                $_SESSION["useremail"] = $row["email"];
                $_SESSION["admin"] = $row["adminlevel"];
                header("Location:" . $url);
                exit();
            }
        } else {
            header("Location:" . $url . "?msg=incorrect");
            exit();
        }
    }

    mysqli_stmt_close($state);
    mysqli_close($con);
} else {
    header("Location:../index.php");
    exit();
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
