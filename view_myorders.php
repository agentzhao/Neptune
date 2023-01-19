<?php
$errorMsg = $userid = "";
$success = $loggedin = true;
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
        $sql = "SELECT uid FROM userinfo where fname='";
        $sql .= $_SESSION["userfname"];
        $sql .= "' AND lname='";
        $sql .= $_SESSION["userlname"];
        $sql .= "'";

        if (!mysqli_query($con, $sql)){
            $errorMsg = "Cannot connect to database.<br>";
            $success = false;
        }else{
            $admin = false;
            $result = mysqli_query($con, $sql);
            //$row = mysql_fetch_array($result);
            while ($row = $result->fetch_assoc()) {
                $userid = $row['uid'];
            }
        }
    }
}
include "php/header.inc.php";

if ($loggedin){
    if ($success == false){
        
        echo '<body><div class="container"><br><br><br><h1>Oops!</h1><h4>Failed to fetch data, please try again.</h4>';
        echo "<p>" . $errorMsg . "</p>";
        echo '<br><a href="index.php"><button type="button" class="btn btn-dark">Return to Home</button></a><br><br>';
        echo "</div></body>";
        include "php/footer.inc.php";
    }else{
                $data = array();
    
                $sql = "SELECT orderid, product_id_fk, ptitle, pprice, pquantity FROM orderdetails WHERE orderid IN (SELECT orderid from p5_10.order WHERE uid=";
                $sql .= $userid;
                $sql .= ')';
                $sql2 = "SELECT datetime FROM p5_10.order WHERE uid =";
                $sql2 .= $userid;

                $result = mysqli_query($con, $sql);
                $result2 = mysqli_query($con, $sql2);


                while($row = mysqli_fetch_assoc($result)) {$data['row'][] = $row;}
                while($row = mysqli_fetch_assoc($result2))  {$data['row2'][] = $row;}
                

                    echo '<br><br><br><br>
                    <h3 class="text-center"><u>My Orders</u></h3>
                    <div style="overflow-x: auto">
                    <table class="table table-bordered table-striped table-hover">  
                            <div class="table-responsive">
                                <thead class="thead-dark">
                                    <tr>
                                      <th scope="col">Order ID</th>
                                      <th scope="col">Product ID</th>
                                      <th scope="col">Product Name</th>
                                      <th scope="col">Price</th>
                                      <th scope="col">Quantiry</th>
                                      <th scope="col">Date/Time</th>>
                                    </tr>
                                </thead>
                                <tbody>';
                    $count = count($data['row']);

                    for($i=0;$i<$count;$i++){
                        echo '<tr>';
                                echo "<td>" . $data['row'][$i]['orderid'] . "</td>";
                                echo "<td>" . $data['row'][$i]['product_id_fk'] . "</td>";
                                echo "<td>" . $data['row'][$i]['ptitle'] . "</td>";
                                echo "<td>" . $data['row'][$i]['pprice'] . "</td>";
                                echo "<td>" . $data['row'][$i]['pquantity'] . "</td>";
                                echo "<td>" . $data['row2'][$i]['datetime'] . "</td>";
                        echo '</tr>';
                    }
                     
        echo'    </tbody>
             </div>
         </table>
         </div>';
        include "php/footer.inc.php";
    }
}else{
    echo '<body><div class="container"><br><br><br><h1>Oops!</h1><h4>Please be logged in to your account to view your orders.</h4>';
    echo '<br><a href="index.php"><button type="button" class="btn btn-dark">Return to Home Page</button></a><br><br>';
    echo "</div></body>";
    include "php/footer.inc.php";
}

$con -> close();
