<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html lang="en-US">
    <?php
     include("php/session.inc.php");
    include("php/header.inc.php");
    include ("php/dbconnection.inc.php");
    $pid = $_GET['productID'];
    $sql = "SELECT * FROM p5_10.inventory WHERE product_id = '$pid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <br>
    <section>
        <div class="container">
            <?php echo "<h2>$row[ptitle]</h2>"; ?>
            <div class="row">
                <div class="col"> <?php echo "<img src='$row[pimagepath]' alt='$row[ptitle]' class='eventsdetailsimage'>"; ?></div>
                <div class="col"> <?php echo "<p class='eventsdetailstext'>$row[pdescription]</p>"; ?></div>
            </div>

            <div id="eventdetail">
                <table>
                    <div class="row">
                        <div class="col">
                            <h4>Sales Date</h4>
                            <?php echo "<h5>10 March 2019</h5>"; ?>

                            <h4>Language</h4>
                            <?php echo "<h5>$row[planguage]</h5>"; ?>q

                            <h4>Duration</h4>
                            <?php echo "<h5>$row[pduration]</h5>"; ?>
                            
                            <h4>Tickets Left</h4>
                            <?php echo "<h5>$row[pquantity]</h5>"; ?>


                        </div>
                        
                        <div class="col">
                            <h4>Event Date</h4>
                            <?php echo "<h5>$row[pdates]</h5>"; ?>

                            <h4>Venue</h4>
                            <?php echo "<h5>$row[pvenue]</h5>"; ?>

                            <h4>Ticket Pricing(Excludes Booking Fee)</h4>
                            <?php echo "<h5>$$row[pprice]</h5>"; ?>
                            
                            <h4>Select number of tickets</h4>
                            <form action='php/shoppingcart.inc.php' method='POST'>  
                        <select name="userquantity">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                        </div>

                    </div>
                    
                </table>
            </div>

            <div class="main">

                <?php
                echo "<input type='hidden' value='" . $row['product_id'] . "' name='productid'>";
                ?>
                <button name='addtocart' type='submit' id="buybutton" type="button" class="btn btn-info add-new">Buy NOW!</button>
                </form>
            </div>      
        </div>
    </section>
    <?php
    $con->close();
    ?>
    <?php
    include("php/footer.inc.php");
    ?>
</body>
</html>

