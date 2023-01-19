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
    $sql = "SELECT * FROM p5_10.inventory limit 6";
    $result = mysqli_query($con, $sql);
    ?>


    <!-- Carousel -->
    <div id="carouselMain" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselMain" data-slide-to="0" class="active"></li>
            <li data-target="#carouselMain" data-slide-to="1"></li>
            <li data-target="#carouselMain" data-slide-to="2"></li>
        </ol>   
        <div class="carousel-inner" role="listbox">

            <div class="carousel-item active" style="background-image: url(images/img1.jpg)">
                <div class="carousel-caption d-md-block">
                    <h3 class="display-4">Love and Longing</h3>
                    <p class="lead">Love, the strange gracefulness of everything you say</p>
                </div>
            </div>

            <div class="carousel-item" style="background-image: url(images/img2.jpg)">
                <div class="carousel-caption d-md-block">
                    <h3 class="display-4">Chorus of the Planets</h3>
                    <p class="lead">Ascend beyond the firmaments in Holst’s universally loved classic, The Planets, an awe-inspiring orchestral extravaganza that’s a guaranteed eye-opening experience for any listener</p>
                </div>
            </div>

            <div class="carousel-item" style="background-image: url(images/img3.jpg)">
                <div class="carousel-caption d-md-block">
                    <h3 class="display-4 backDropText">French Connections</h3>
                    <p class="lead">Lynnette and Gulnara, two familiar faces of the SSO, come together in this enchanting evening of French musical poetry</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselMain" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselMain" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading -->
        <h1 class="my-4">Top Viewed Events
        </h1>
        <div class="row">


            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-lg-4 col-sm-6 mb-4">
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

        </div>

    </div>
    <?php
    include("php/footer.inc.php");
    ?>
</body>
</html>
