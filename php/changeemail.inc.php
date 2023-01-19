<?php

if (isset($_POST["chgemail-submit"])) {
    require 'dbconnection.inc.php';
    $curpwd = sanitize_input($_POST['curpwd']);
    $email = sanitize_input($_POST['curemail']);
    $newemail = sanitize_input($_POST['newemail']);
    $url = $_SERVER['HTTP_REFERER'];
    $url = strtok($url, '?');

    $state = mysqli_stmt_init($con);
    $sqlemail = "SELECT * FROM userinfo WHERE email=?";

    if (empty($curpwd) || empty($newemail)) {
        header("Location:" . $url . "?msg=emptyfield");
        exit();
    } elseif (!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
        header("Location:" . $url . "?msg=invalidemail");
        exit();
    } elseif ($email == $newemail) {
        header("Location:" . $url . "?msg=emailsame");
        exit();
    } elseif (!mysqli_stmt_prepare($state, $sqlemail)) {
        header("Location:" . $url . "?msg=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($state, "s", $email);
        mysqli_stmt_execute($state);
        $result = mysqli_stmt_get_result($state);
        if ($row = mysqli_fetch_assoc($result)) {
            $checkpwd = password_verify($curpwd, $row["password"]);
            if ($checkpwd == false) {
                header("Location:" . $url . "?msg=pwdwrong");
                exit();
            } else {
                $sqlemailcheck = "SELECT email FROM userinfo WHERE email = '$newemail'";
                if (!mysqli_stmt_prepare($state, $sqlemailcheck)) {
                    header("Location:" . $url . "?msg=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_execute($state);
                    mysqli_stmt_store_result($state);
                    $checkemail = mysqli_stmt_num_rows($state);
                    if ($checkemail > 0) {
                        header("Location:" . $url . "?msg=emailtaken");
                        exit();
                    } else {
                        $sqlinsert = "UPDATE userinfo SET email=? WHERE email = '$email'";
                        if (!mysqli_stmt_prepare($state, $sqlinsert)) {
                            header("Location:" . $url . "?msg=sqlerror");
                            exit();
                        } else {

                            mysqli_stmt_bind_param($state, "s", $newemail);
                            mysqli_stmt_execute($state);
                            session_start();
                            $_SESSION["useremail"] = $newemail;
                            header("Location:" . $url . "?msg=chgemailsuccess");
                            exit();
                        }
                    }
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
