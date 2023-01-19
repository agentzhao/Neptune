<head>
    <?php


    $filename = basename($_SERVER["SCRIPT_FILENAME"], '.php');

    switch ($filename) {
        case "index":
            echo '<title>Neptune</title>';
            break;
        case "events":
            echo '<title>Neptune - All Events</title>';
            break;
        case "cart":
            echo '<title>Neptune - Cart</title>';
            break;
        case "faq":
            echo '<title>Neptune - FAQ</title>';
            break;
        case "aboutus":
            echo '<title>Neptune - About Us</title>';
            break;
        case "accountpage":
            echo '<title>Neptune - Account Management</title>';
            break;
        case "view_allorders":
            echo '<title>Neptune - All Orders</title>';
            break;
        case "view_feedback":
            echo '<title>Neptune - All Feedback</title>';
            break;
        case "listview":
            echo '<title>Neptune - Inventory</title>';
            break;
        case "view_myorders":
            echo '<title>Neptune - My Orders</title>';
            break;
    }
    ?>
    <link rel="icon" href="images/neptune.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta name="description" content="Neptune - No.1 Ticket Seller in Singapore">
    <meta name="author" content="Pak Shao Kai, Wesley Sim Qian Dong, Lee Khai Liang Eugene, Tan Hong Zhao">
    <meta name="keyword" content="Neptune, ticket seller, concert, top ticket seller, top ticket seller in Singapore, concert, concert hall, Neptune Company, band, live show, kpop concert, chinese concert, national stadium, national sports stadium, jpop concert, english musician">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet" type="text/css"/>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oxygen:700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js" type="text/javascript"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <!-- NavBar -->
    <?php
    echo ($filename == 'index') ? '<nav class="navbar navbar-expand-lg navbar-light fixed-top navbartrans">' : '<nav class="navbar navbar-expand-lg fixed-top navbar-light">';
    echo '
        <div class="container">
            <a class="navbar-brand" href="index.php" onclick="topFunction();"><img src="images/neptune.png" alt="neptune icon" class="icon_img">Neptune</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span>
                    <i class="fa fa-navicon navbar-toggler-icon-style"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">';
    echo ($filename == 'index') ? '<li class="nav-item active">' : '<li class="nav-item">';
    echo '
                    <a class="nav-link" href="index.php">Home</a>
                    </li>';
    echo ($filename == 'events') ? '<li class="nav-item active">' : '<li class="nav-item">';
    echo '
                    <a class="nav-link" href="events.php">Events</a>
                    </li>';

    echo ($filename == 'faq') ? '<li class="nav-item active">' : '<li class="nav-item">';
    echo '
                    <a class="nav-link" href="faq.php">FAQ</a>
                    </li>';
    echo ($filename == 'aboutus') ? '<li class="nav-item active">' : '<li class="nav-item">';
    echo '
                    <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>';

    if (isset($_SESSION["userfname"])) {
        if (($_SESSION["admin"] != 1)) {
            echo ($filename == 'cart') ? '<li class="nav-item active">' : '<li class="nav-item">';
            echo '
                    <a class="nav-link" href="cart.php">Cart</a>
</li>';
            echo ($filename == 'view_myorders') ? '<li class="nav-item active">' : '<li class="nav-item">';
            echo '
                    <a class="nav-link" href="view_myorders.php">My Orders</a>
                    </li>';
        }

        echo ($filename == 'accountpage') ? '<li class="nav-item active">' : '<li class="nav-item">';

        echo '
             <a class="nav-link" href="accountpage.php">', $_SESSION["userfname"], ' ', $_SESSION["userlname"], '</a> ';
        if (($_SESSION["admin"] == 1)) {
            echo '<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbarDropdown">
         Admin
        </a>  <div class="dropdown-menu" aria-labelledby="navbarDropdown" >';
            echo ($filename == 'listview') ? '<a class="dropdown-item active" href="listview.php">' : '<a class="dropdown-item" href="listview.php">';
            echo' Inventory</a>';
            echo ($filename == 'view_allorders') ? '<a class="dropdown-item active" href="view_allorders.php">' : '<a class="dropdown-item" href="view_allorders.php">';
            echo' All Orders</a>';
            echo ($filename == 'view_feedback') ? '<a class="dropdown-item active" href="view_feedback.php">' : '<a class="dropdown-item" href="view_feedback.php">';
            echo'All Feedback</a></div> </li>';
        }

        echo'                   <li>
                                    <a class="nav-link" href="php/logout.inc.php">Logout</a>
                            </li>';
    } else {
        echo
        '<li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#loginModal">Login/Sign up</a>
                        </li>';
    }
    echo '
                </ul>
            </div>
        </div>
    </nav> ';
    ?> 
    <!--login popout modal -->
    <section class="modal fade" id="loginModal" role="dialog" >
        <div class="modal-dialog" role="document"> 
            <div class="modal-content">
                <div  class="modal-header">
                    <i class="fa fa-user-circle fa-2x"></i>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times fa-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="nav nav-tabs nav-justified">
                        <a class="nav-item nav-link active" data-toggle="tab" href="#login">Login In</a>
                        <a class="nav-item nav-link" data-toggle="tab" href="#signup">Sign up</a>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane fade show active"  id="login">
                            <form class="form" role="form"   name="loginForm" action="php/login.inc.php"   method="post">
                                <div class="text-center">
                                    <p class="hint-text">Welcome Back!</p>
                                </div>
                                <span class="form-group">   
                                    <input  class ="form-control inputfield" placeholder="Email" type="email" name="email" required>
                                </span>
                                <span class="form-group">
                                    <input class ="form-control inputfield" type="password"  placeholder="Password" name="password"  required >
                                </span>


                                <div class="g-recaptcha" data-theme ="dark" data-sitekey="6LcRB8IUAAAAAKOGQ4V36RZR5nTq73gEH9NFSNWg"  data-callback="callback"></div>
                                <button class="btn btn-success"  type="submit" id="loginbtn" name ="login-submit">
                                    <span ><i class="fa fa-sign-in"></i> </span>Login</button>

                            </form>
                        </div>
                        <div class="tab-pane fade"  id="signup">
                            <form  name="signupForm"  onsubmit="return signup();" action="php/signup.inc.php"  method="post" >
                                <div class="text-center">
                                    <p class="hint-text">Create your account. It's free and only takes a minute.</p>
                                </div>
                                <span class="form-group">
                                    <input class ="form-control inputfield"  placeholder = "First Name" type="text" required name="fname">
                                </span>
                                <span class="form-group">
                                    <input class ="form-control inputfield"  placeholder = "Last Name" type="text" required name="lname">
                                </span>
                                <span class="form-group ">
                                    <input class ="form-control inputfield"  placeholder = "Email"  type="email"  required name="signemail"/>
                                </span>
                                <span class="form-group">  
                                    <input class ="form-control inputfield"  placeholder = "Password"  type="password" required autocomplete="off"   name="signpassword" />
                                </span>
                                <span class="form-group">
                                    <input class ="form-control inputfield"  placeholder = "Confirm Password"  type="password" required autocomplete="off" name="signconpassword"  onchange="check()"/>
                                </span>
                                <span id='mismatchpassword'></span> 

                                <button  type="submit" class="btn btn-success" name="signup-submit" id="signbtn"> <i class="fa  fa-id-card-o"></i> Sign Up</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--warning modal-->
    <section class="modal fade" id="warningModal" role="dialog" >
        <div class="modal-dialog" role="document"> 
            <div class="modal-content">
                <div  class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times fa-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    include("php/warningmsg.inc.php");
                    ?>                        
                </div>
            </div>
        </div>
    </section>