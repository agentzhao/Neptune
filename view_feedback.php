<?php
$errorMsg = "";
$success = true;
include("php/session.inc.php");


//Send feedback to db
include 'php/dbconnection.inc.php';
// Check connection
if (!$con){
    $errorMsg .= "Cannot connect to server.<br>";
    $success = false;
}else{
    if (!isset($_SESSION["userfname"])){
         header("Location:index.php?msg=cartlogin");
        exit();
    }else{
        $sql = 'SELECT adminlevel FROM userinfo where fname=\'';
        $sql .= $_SESSION["userfname"];
        $sql .= '\'';

        if (!mysqli_query($con, $sql)){
            $errorMsg = "Cannot connect to database.<br>";
            $success = false;
        }else{
            $admin = false;
            $result = mysqli_query($con, $sql);
            //$row = mysql_fetch_array($result);
            while ($row = $result->fetch_assoc()) {
                if ($row['adminlevel'] == 1){
                    $admin = true;
                }
            }
        }
    }
}
include "php/header.inc.php";
if ($admin){
    if ($success == false){
        
        echo '<body><div class="container"><br><br><br><h1>Oops!</h1><h4>Failed to fetch data, please try again.</h4>';
        echo "<p>" . $errorMsg . "</p>";
        echo '<br><a href="index.php"><button type="button" class="btn btn-dark">Return to Home</button></a><br><br>';
        echo "</div></body>";
        include "php/footer.inc.php";
    }
    $sql = "SELECT * FROM feedback";
    $result = mysqli_query($con, $sql);
    
  
    //display results in table
    echo '<br><br><br><br>
    <h3 class="text-center"><u>List of all the feedbacks</u></h3><br>
    <div style="overflow-x: auto">
    <table class="table table-bordered table-striped table-hover">  
            <div class="table-responsive">
                <thead class="thead-dark">
                    <tr>
                      <th scope="col">Feedback ID</th>
                      <th scope="col">Email</th>
                      <th scope="col">Name</th>
                      <th scope="col">Subject</th>
                      <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>';

    while ($row = mysqli_fetch_assoc($result)){
        echo '<tr>
                  <td scope="row">' . $row["feedback_id"]. '</td>
                  <td>' . $row["email"] .'</td>
                  <td> '.$row["name"] .'</td>
                  <td> '.$row["subject"] .'</td>
                  <td> '.$row["message"] .'</td>
                </tr>';
    }
        

    echo'    </tbody>
         </div>
     </table>
     </div>';
    include "php/footer.inc.php";
}else{
   
    echo '<body><div class="container"><br><br><br><h1>Oops!</h1><h4>How did you get here?</h4>';
    echo '<br><a href="index.php"><button type="button" class="btn btn-dark">Return to Home Page</button></a><br><br>';
    echo "</div></body>";
    include "php/footer.inc.php";
}

$con -> close();


