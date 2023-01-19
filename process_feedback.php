<?php
$feedback_name = $feedback_email = $feedback_subject = $feedback_message = $errorMsg = "";
$success = true;

//Helper function that checks input for malicious or unwanted content.
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//email
if (empty($_POST["feedback_email"]))
{
    $errorMsg .= "Email is required.<br>";
    $success = false;
}
else
{
    $feedback_email = sanitize_input($_POST["feedback_email"]);
    // Additional check to make sure e-mail address is well-formed.
    if (!filter_var($feedback_email, FILTER_VALIDATE_EMAIL))
    {
        $errorMsg .= "Invalid email format.<br>";
        $success = false;
    }
}

//name
if (empty($_POST["feedback_name"]))
{
    $errorMsg .= "Name is required.<br>";
    $success = false;
}
else
{
    $feedback_name = sanitize_input($_POST["feedback_name"]);
}

//subject
if (empty($_POST["feedback_subject"]))
{
    $errorMsg .= "Subject is required.<br>";
    $success = false;
}
else
{
    $feedback_subject = sanitize_input($_POST["feedback_subject"]);
}

//message
if (empty($_POST["feedback_message"]))
{
    $errorMsg .= "Message is required.<br>";
    $success = false;
}
else
{
    $feedback_message = sanitize_input($_POST["feedback_message"]);
}

/* to send mail
//sending mail
set_error_handler(function($errno, $errstr, $errfile, $errline ){
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});

$from = 'From: user@example.com'; 
$to = 'bocob18666@mailnet.top'; 

$body = "From: $feedback_name\n E-Mail: $feedback_email\n Message:\n $feedback_message";

try {
   mail ($to, $feedback_subject, $body, $from);
   $success = true;
} catch(Exception $e) {
   $success = false;
   $errorMsg .= "Failed to connect to mail server.";
}
*/


if ($success){
    //Send feedback to db
    include 'php/dbconnection.inc.php';
    // Check connection
    if (!$con){
        $errorMsg .= "Cannot connect to server.<br>";
        $success = false;
    }else{
        $sql = "INSERT INTO feedback (name, email, subject, message)";
        $sql .= " VALUES ('$feedback_name', '$feedback_email', '$feedback_subject', '$feedback_message')";
        // Execute the query
        //$query = $con->prepare(sql);
        //$query -> execute();

        if (!mysqli_query($con, $sql)){
            $errorMsg = "Cannot connect to database.<br>";
            $success = false;
        }
    }
    $con -> close();
}


if ($success){
    include "php/header.inc.php";
    echo '<body><div class="container"><br><br><br><h1>Message successfully sent!</h1>';
    echo "<p>Thank you for your feedback, " . $feedback_name, '.';
    echo '<br><br><a href="index.php"><button type="button" class="btn btn-dark">Return to Home Page</button></a><br><br>';
    echo "</div></body>";
    include "php/footer.inc.php";
}else{
    include "php/header.inc.php";
    echo '<body><div class="container"><br><br><br><h1>Oops!</h1><h4>Message Sending Failed, please try again.</h4>';
    echo "<p>" . $errorMsg . "</p>";
    echo '<br><a href="faq.php"><button type="button" class="btn btn-dark">Return to Feedback</button></a><br><br>';
    echo "</div></body>";
    include "php/footer.inc.php";
}
