<?php

session_start();
if (isset($_POST["chgpwd-submit"])) {
    require 'dbconnection.inc.php';
    $oldpwd = sanitize_input($_POST['oldpwd']);
    $newpwd = sanitize_input($_POST['newpwd']);
    $connewpwd = sanitize_input($_POST['connewpwd']);
    $url = $_SERVER['HTTP_REFERER'];
    $url = strtok($url, '?');
    $email = $_SESSION["useremail"];

    $state = mysqli_stmt_init($con);
    $sqlemail = "SELECT * FROM userinfo WHERE email=?";

    if (empty($oldpwd) || empty($newpwd) || empty($connewpwd)) {
        header("Location:" . $url . "?msg=emptyfield");
        exit();
    } elseif ($newpwd != $connewpwd) {
        header("Location:" . $url . "?msg=passwdnotsame");
        exit();
    } elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/", $newpwd)) {
        header("Location:" . $url . "?msg=passwdreq");
        exit();
    } elseif ($newpwd == $oldpwd) {
        header("Location:" . $url . "?msg=pwdcntsame");
        exit();
    } elseif (!mysqli_stmt_prepare($state, $sqlemail)) {
        header("Location:" . $url . "?msg=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($state, "s", $email);
        mysqli_stmt_execute($state);
        $result = mysqli_stmt_get_result($state);
        if ($row = mysqli_fetch_assoc($result)) {
            $checkpwd = password_verify($oldpwd, $row["password"]);
            if ($checkpwd == false) {
                header("Location:" . $url . "?msg=pwdwrong");
                exit();
            } else {
                $sqlinsert = "UPDATE userinfo SET password=? WHERE email = '$email'";
                if (!mysqli_stmt_prepare($state, $sqlinsert)) {
                    header("Location:" . $url . "?msg=sqlerror");
                    exit();
                } else {
                    $hash = password_hash($newpwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($state, "s", $hash);
                    mysqli_stmt_execute($state);
                    header("Location:" . $url . "?msg=chgpwdsuccess");
                    exit();
                }
            }
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
