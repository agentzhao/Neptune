
<html  lang="en-US">
    <?php
    include("php/session.inc.php");
    if (!isset($_SESSION['userid'])) {
         header("Location:index.php?msg=cartlogin");
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
        <div class="container mb-4 paymenttitle">
            <h1>Please confirm your order!</h1>
        </div>
        <div class="container mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Available</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-center">Price</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalprice = 0;
                                $totaltickets = 0;
                                while ($shoprow = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                <form role="form" name="editcart" action="php/editcart.inc.php" method="POST"> 

                                    <td><?php echo "<a href='eventdetails.php?productID=$shoprow[product_id_fk]'><img src='$shoprow[imagepath]' class='cart-img' alt='$shoprow[ptitle]'></a>"; ?></td>
                                    <td><?php echo "<a href='eventdetails.php?productID=$shoprow[product_id_fk]'>$shoprow[ptitle]</a>"; ?></td>
                                    <td>In stock</td>
                                    <?php echo "<td class='text-center'>$shoprow[userquantity]</td>"; ?>
                                    <?php echo "<td class='text-center'>$$shoprow[pprice]</td>"; ?>
                                    <?php
                                    $totalprice += $shoprow['userquantity'] * $shoprow['pprice'];
                                    $totaltickets += $shoprow['userquantity'];
                                    echo "<input type='hidden' name='prodID' value='" . $shoprow['product_id_fk'] . "'>";
                                    ?>
                                </form>

                                <form role="form" name="pay" action="php/editcart.inc.php" method="POST">
                                    <?php
                                    echo "<input type='hidden' name='userquan' value='" . $shoprow['userquantity'] . "'>";
                                    echo "<input type='hidden' name='prodID' value='" . $shoprow['product_id_fk'] . "'>";
                                    ?>
                                    <td class="text-right"><button class="btn btn-sm btn-danger" name="delete-submit"><i class="fa fa-window-close" aria-hidden="true"></i></button></td>
                                </form>

                                </tr>

                            <?php } ?>
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

                            </tbody>
                        </table>
                    </div>

                    <div class="mb-md-1">
                        <form class="paymentform" action="php/payment.inc.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <h5>Full Name</h5>
                                        <input type="text" id="contact-name" placeholder="Full Name"  required class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <h5>Email</h5>
                                        <input type="email" class="form-control" id="newemail" name="curemail" value="<?php echo $_SESSION["useremail"] ?>" >
                                    </div>
                                </div>
                            </div>


<!--                      <a href ="https://www.paypal.com"><i class="fa lg fa-paypal">  </i></a>-->
                            <div class="col mb-2">
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <button class="btn btn-lg btn-block btn-success" name="payment-submit">Submit Payment</button>
                                    </div>
                                </div>
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
</html>