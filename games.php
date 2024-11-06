<?php require_once SERVER_ROOT . '/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php include "./components/head.php" ?>

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
    <?php include "./components/scripts.php" ?>

</body>

</html>
