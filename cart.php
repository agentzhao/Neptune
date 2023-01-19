<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html  lang="en-US">
    <?php
    include("php/session.inc.php");

    if (!isset($_SESSION['userid'])) {
        header("Location:index.php?msg=cartlogin");
        exit();
    } else if ($_SESSION["admin"] == 1) {
        header("Location:index.php?msg=normaluser");
        exit();
    } else {
        $user_id = $_SESSION['userid'];
        include ("php/dbconnection.inc.php");
        $sql = "SELECT * FROM p5_10.shoppingcart WHERE uid_fk = '$user_id'";
        $result = mysqli_query($con, $sql);
    }
     include("php/header.inc.php");
    ?>
    <section class="topsection">
        <div class="container mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Tickets Left</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-right">Price</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $numrow = mysqli_num_rows($result);
                                $isempty = 0;
                                $totalprice = 0;
                                $totaltickets = 0;
                                if ($numrow > 0) {

                                    while ($shoprow = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                    <form role="form" name="editcart" action="php/editcart.inc.php" method="POST"> 

                                        <td><?php echo "<a href='eventdetails.php?productID=$shoprow[product_id_fk]'><img src='$shoprow[imagepath]' class='cart-img' alt='$shoprow[ptitle]'></a>"; ?></td>
                                        <td><?php echo "<a href='eventdetails.php?productID=$shoprow[product_id_fk]'>$shoprow[ptitle]</a>"; ?></td>
                                          <?php echo "<td class='text-center'>$shoprow[pquantity]</td>"; ?>                                     
                                        <td><input class="form-control" type="number" min="1" required name="userquan"<?php echo 'value="' . $shoprow['userquantity'] . '"' ?> > <button class="btn btn-lg btn-block btn-success" name="update-submit">Update</button> </td>
                                        <?php echo "<td class='text-right'>$shoprow[pprice]</td>"; ?>
                                        <?php
                                        $totalprice += $shoprow['userquantity'] * $shoprow['pprice'];
                                        $totaltickets += $shoprow['userquantity'];
                                        echo "<input type='hidden' name='prodID' value='" . $shoprow['product_id_fk'] . "'>";
                                        ?>
                                    </form>

                                    <form role="form" name="delete" action="php/editcart.inc.php" method="POST">
                                        <?php
                                        echo "<input type='hidden' name='userquan' value='" . $shoprow['userquantity'] . "'>";
                                        echo "<input type='hidden' name='prodID' value='" . $shoprow['product_id_fk'] . "'>";
                                        ?>
                                        <td class="text-right"><button class="btn btn-sm btn-danger" name="delete-submit"><i class="fa fa-window-close" aria-hidden="true"></i></button></td>
                                    </form>
                                    </tr>

                                    <?php
                                }
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total tickets</td>
                                    <?php echo "<td class='text-right'>$totaltickets</td>"; ?>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Sub-Total</td>
                                    <?php echo "<td class='text-right'>$$totalprice</td>"; ?>
                                </tr>

                                <?php
                            } else {
                                $isempty = 1;
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        if ($isempty == 1) {
                            echo "<h1 class='cartempty'>Cart is empty... </h1>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="row">
                        <div class="col-sm-12  col-md-6"></div>
                        <div class="col-sm-12 col-md-6">
                            <form role="form" name="pay" action="php/editcart.inc.php" method="POST">
                                <?php
                                echo '<input type="hidden" name="ticcount" value ="', $totaltickets, '"/>';
                                ?>
                                <?php
                                if ($isempty == 0) {
                                    echo "<button class='btn btn-lg btn-block btn-success' name='payment-submit'>Check Out</button>";
                                }
                                ?>

                            </form>
                        </div>
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
