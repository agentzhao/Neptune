<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include("php/session.inc.php");
if (!isset($_SESSION['userid'])) {
    header("Location:index.php?msg=cartlogin");
    exit();
}
include("php/dbconnection.inc.php");
include("php/header.inc.php");
?>

<html lang="en-US">
    
    <body>
        <br>
        <br>

        <!-- Inventory Table-->               
        <?php
        if (isset($_GET['search'])) {
             $search=   filter_var($_GET['search'], FILTER_SANITIZE_STRING);
            $sql = "SELECT * FROM p5_10.inventory WHERE (ptitle LIKE '%$search%') or (pdescription LIKE '%$search%');";
            $result = mysqli_query($con, $sql);
        } else {
            $sql = "Select * from p5_10.inventory  WHERE pdates >= CURDATE();";
            $result = mysqli_query($con, $sql);
        }

        $isempty = 0;
       
        ?>

        <!-- Inventory Table-->               
        <div  class="container containerListView">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Inventory <b>Details</b></h2></div>
                        <div class="col-sm-4 addnew">

                            <a href="#addinventory"  data-toggle="modal">
                                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i>Add New</button></a>

                        </div>
                    </div>
                </div>
                <form class="example" action='<?php $_SERVER['PHP_SELF'] ?>' style="margin:auto;max-width:300px">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form><br>
                <?php
                $numrow = mysqli_num_rows($result);
                if ($numrow > 0) {

                    $query = $con->prepare("select * from p5_10.inventory  WHERE pdates >= CURDATE();");
                    $query->execute();
                    $query->bind_result($product_id, $pname, $pprice, $pquatity, $pdescription, $pdates, $pimagepath, $pduration, $planguage, $pvenue);

                    echo" <div style='overflow-x:auto'><table class='table table-bordered listitem'>";

                    echo"<thead>";
                    echo"<tr>";
                    echo"<!-- First Column Checkbox -->";

                    echo"<th>image</th>";
                    echo"<th>Product Code</th>";
                    echo"<th>Product Title</th>";
                    echo"<th>Product Price</th>";
                    echo"<th>Quantity</th>";
                    echo"<th>Description</th>";
                    echo"<th>Dates</th>";
                    echo"<th >Duration</th>";
                    echo"<th>language</th>";
                    echo"<th>venue</th>";

                    echo"<th>Actions</th>";
                    echo"</tr>";
                    echo"</thead>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr height='50%'>";

                        echo "<td width='70%' height='50%'>  <img class='card-img-top' src='$row[pimagepath]' alt='$pname'></td>";

                        echo "<td>" . $row['product_id'] . "</td>";
                        echo "<td>" . $row['ptitle'] . "</td>";
                        echo "<td>" . $row['pprice'] . "</td>";
                        echo "<td>" . $row['pquantity'] . "</td>";
                        echo "<td width='70%'>" . $row['pdescription'] . "</td>";
                        echo "<td>" . $row['pdates'] . "</td>";
                        echo "<td>" . $row['pduration'] . "</td>";
                        echo "<td>" . $row['planguage'] . "</td>";
                        echo "<td>" . $row['pvenue'] . "</td>";
                        ?>

                        <td>

                            <a  href=#updateinventory"  data-toggle="modal" class='edit' title='Edit' data-toggle='tooltip'><i class='fa fa-pencil'></i></a>

                            <a  href='#deleteinventory' data-toggle='modal' class='delete' title='Delete' data-toggle='tooltip'><i class='fa fa-times fa-lg'></i></a>

                        </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <tbody>

                </tbody>
                </table></div> 

            <form action="listview_insert_check.php" method="post">
        </div>
        <!-- Edit Modal HTML -->
        <div id="addinventory" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">						
                            <h4 class="modal-title">Add tickets</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>


                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="pic" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label>Product Code</label>
                                <input class="form-control" type="text" name="pcode" required>
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input class="form-control" type="text" name="pname"  required >
                            </div>

                            <div class="form-group">
                                <label>Product Price</label>
                                <input class="form-control" type="text" name="pprice" required >
                            </div>	
                            <div class="form-group">
                                <label>Quantity</label>
                                <input class="form-control" type="text" name="pquantity" required>
                            </div>	

                            <div class="form-group">
                                <label>Product Description</label>
                                <input class="form-control" type="text" name="pdescription" >
                            </div>

                            <div class="form-group">
                                <label>Date</label>
                                <input class="form-control" type="date" name="pdate" required >
                            </div>

                            <div class="form-group">
                                <label>Duration </label>
                                <input class="form-control" type="text" name="pduration" required >
                            </div>

                            <div class="form-group">
                                <label>Language</label>
                                <input class="form-control" type="text" name="planguage" required >
                            </div>

                            <div class="form-group">
                                <label>Venue</label>
                                <input class="form-control" type="text" name="pvenue" required >
                            </div>

                        </div>   
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="cancel">
                            <input type="submit" class="btn btn-success" value="Add" name="add">
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div id="updateinventory" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form action="listview_update.php" method="post">

                        <div class="modal-header">						
                            <h4 class="modal-title">Update Inventory</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>

                        <?php
                        include ("php/dbconnection.inc.php");



                        $sql = "SELECT * FROM p5_10.inventory";
                        $result = mysqli_query($con, $sql);
                        ?>
                        <?php
//Fetch Data form database
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <div class="modal-body">					
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="pic" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label>Product Code</label>
                                        <input class="form-control" type="text" name="pcode" value="<?php echo $row['product_id'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input class="form-control" type="text" name="pname" value="<?php echo $row['ptitle'] ?>" required >
                                    </div>

                                    <div class="form-group">
                                        <label>Product Price</label>
                                        <input class="form-control" type="text" name="pprice" value="<?php echo $row['pprice'] ?>"required >
                                    </div>	
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input class="form-control" type="text" name="pquantity" value="<?php echo $row['pquantity'] ?>" required>
                                    </div>	

                                    <div class="form-group">
                                        <label>Product Description</label>
                                        <input class="form-control" type="text" value="<?php echo $row['pdescription'] ?>" name="pdescription" >
                                    </div>

                                    <div class="form-group">
                                        <label>Date</label>
                                        <input class="form-control" type="text" value="<?php echo $row['pdates'] ?>" name="pdate" required >
                                    </div>

                                    <div class="form-group">
                                        <label>Duration </label>
                                        <input class="form-control" type="text" name="pduration" value="<?php echo $row['pduration'] ?>" required >
                                    </div>

                                    <div class="form-group">
                                        <label>language</label>
                                        <input class="form-control" type="text" name="planguage" value="<?php echo $row['planguage'] ?>"required >
                                    </div>

                                    <div class="form-group">
                                        <label>Venue</label>
                                        <input class="form-control" type="text" name="pvenue" value="<?php echo $row['pvenue'] ?>" required >
                                    </div>

                                </div> 


                                <?php
                            }
                        }
                        ?>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="cancel">
                            <input type="submit" class="btn btn-success" value="Update" >
                        </div>
                    </form>
                </div>
            </div>
        </div>     

        <div id="deleteinventory" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="listview_delete.php" method="post">
                        <div class="modal-header">						
                            <h4 class="modal-title">Delete Item</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                            <p>Please enter the product code to confirm the delete </p>
                            <input class="form-control" type="text" name="pcode" required>

                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include("php/footer.inc.php");
?>
</body>
</html>