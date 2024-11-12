<?php
require 'vendor/autoload.php';

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Games</title>

    <!-- header logo -->
    <link rel="icon" href="<?= ROOT ?>/assets/images/logo-tp-orange.ico">

    <!-- Bootstrap core CSS -->
    <link href="<?= ROOT ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/owl.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!--

TemplateMo 589 lugx gaming

https://templatemo.com/tm-589-lugx-gaming

-->
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->

    <?php include('./components/header.php'); ?>

    <!-- ***** Header Area End ***** -->

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Games</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > Games</span>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-page section">
        <div class="container">

            <div class="sheet-container">
                <div class="sheet-header">Wave Techzone Game List</div>


            </div>


        </div>
    </div>


    <?php include('./components/footer.php'); ?>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="<?= ROOT ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= ROOT ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/isotope.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/owl-carousel.js"></script>
    <script src="<?= ROOT ?>/assets/js/counter.js"></script>
    <script src="<?= ROOT ?>/assets/js/custom.js"></script>

</body>

</html>
