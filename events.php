<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en-US">

    <?php
     include("php/session.inc.php");  
    include ("php/dbconnection.inc.php");
      include("php/header.inc.php");
    if (isset($_GET['search'])) {
      $search=   filter_var($_GET['search'], FILTER_SANITIZE_STRING);
        $sql = "SELECT * FROM p5_10.inventory WHERE (ptitle LIKE '%$search%') or (pdescription LIKE '%$search%');";
        $result = mysqli_query($con, $sql);
    } else {
        $sql = "SELECT * FROM p5_10.inventory";
        $result = mysqli_query($con, $sql);
    }

    $isempty = 0;

    ?>

    <section class="topsection">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <form class="card card-sm">
                        <div class="card-body row no-gutters align-items-center">
                            <!--end of col-->
                            <form action='<?php $_SERVER['PHP_SELF'] ?>' method='POST'>
                                <div class="col">
                                    <input class="form-control form-control-lg form-control-borderless" name="search" placeholder="Search All Events">
                                </div>
                                <!--end of col-->
                                <div class="col-auto">
                                    <button class="btn btn-lg btn-success" type="submit">Search</button>
                                </div>
                            </form>
                            <!--end of col-->
                        </div>
                    </form>
                </div>
                <!--end of col-->
            </div>
        </div>
    </section>
    <section>
        <div class="containerEvent">
            <!-- Page Heading -->
            <h1 class="my-4">All Upcoming Events</h1>
            <div class="row">
<?php
$numrow = mysqli_num_rows($result);
if ($numrow > 0) {
    ?>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-lg-3 col-sm-6 mb-4">
                            <div class="card h-100">
        <?php echo "<a href='eventdetails.php?productID=$row[product_id]'><img class='card-img-top' src='$row[pimagepath]' alt='$row[ptitle]'></a>"; ?>
                                <div class="card-body">
                                    <h4 class="card-title">
        <?php echo "<a href='eventdetails.php?productID=$row[product_id]'>$row[ptitle]</a>"; ?>
                                    </h4>
                                        <?php echo "<p class='card-text'>$row[pdescription]</p>"; ?>
                                </div>
                            </div>
                        </div>
    <?php } ?>
                    <?php
                } else {
                    $isempty = 1;
                }
                ?>
            </div>
                <?php
                if ($isempty == 1) {
                    echo "<h1 class='noresults'>No results found... </h1>";
                }
                ?>
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
