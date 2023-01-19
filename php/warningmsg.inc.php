<?php

if (isset($_GET['msg'])) {
    echo '<script>
    $(document).ready(function(){
        $("#warningModal").modal("show");
    });
</script>';
    switch ($_GET["msg"]) {
        case "sqlerror":
            echo '<div class="alert alert-danger"> Try again later.</div>';
            break;
        case "emptyfield":
            echo '<div class="alert alert-danger"></button> Fill up all fields.</div>';
            break;
        case "invalidemail":
            echo '<div class="alert alert-danger"> Invalid email.</div>';
            break;
        case "passwdnotsame":
            echo '<div class="alert alert-danger"> Password and confirm password not same.</div>';
            break;
        case "passwdreq":
            echo '<div class="alert alert-danger">Password should have at least 6 character, a number, a uppercase and a lowercase.</div>';
            break;
//      For User Login Msg                
        case"cartlogin":
            echo '<div class="alert alert-danger"> Login First</div>';
            break;
//      For Sign up Page 
        case "emailtaken":
            echo '<div class="alert alert-danger">  Email is already been used. </div>';
            break;
        case "signupsuccess":
            echo '<div class="alert alert-success"> </button> Account has been created.</div>';
            break;
//      For Login Page
        case"incorrect":
            echo '<div class="alert alert-danger"> Incorrect Email or Password. </div>';
            break;
        case"recaptcha":
            echo '<div class="alert alert-danger"> Captcha not complete.</div>';
            break;
//      For change password page 
        case "chgpwdsuccess":
            echo '<div class="alert alert-success"> </button> Password has been updated.</div>';
            break;
        case"pwdcntsame":
            echo '<div class="alert alert-danger"> Old and New password cannot be the same. </div>';
            break;
        case"pwdwrong":
            echo '<div class="alert alert-danger">Old Password not valid. </div>';
            break;
//      For change email
        case"chgemailsuccess":
            echo '<div class="alert alert-success"> </button> Email has been updated.</div>';
            break;
        case"emailsame":
            echo '<div class="alert alert-danger"> Email the same. </div>';
            break;
// Session Time out
        case"timeout":
            echo '<div class="alert alert-danger"> You been logout due to inactivity.</div>';
            break;

// Cart 
        case"onlynumber":
            echo '<div class="alert alert-danger"> Update Failed</div>';
            break;

        case"stocklow":
            echo '<div class="alert alert-danger">Not enough stock.</div>';
            break;

        case"normaluser":
            echo '<div class="alert alert-danger">Use non-admin account to buy</div>';
            break;

        // Payment       
        case"paysuccess":
            echo '<div class="alert alert-success">Payment Success</div>';
            break;
    }
} else {
    header("Location: ../index.php");
}




