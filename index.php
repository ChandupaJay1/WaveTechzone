<?php
$featured = require_once(__DIR__ . "/db_connections/get_featured_products.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "./components/head.php" ?>

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

    <div class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="caption header-text">
                        <h6>Welcome to <?= $_ENV['APP_NAME']; ?> </h6>
                        <h2>Best Online Services & Store.</h2>
                        <p>
                            Explore the best online services and unique products tailored for you. Enjoy quality, value, and
                            exceptional customer support in every purchase. Elevate your shopping experience today!</p>
                    </div>
                </div>

                <!-- Add Logo here -->
                <div class="col-lg-4 offset-lg-2">
                    <div class="right-image">
                        <img src="<?= $_ENV['APP_LOGO']; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <img src="<?= ROOT ?>/assets/images/services.png" alt="" style="max-width: 44px;">
                            </div>
                            <h4>Desktop/Servers Repairing</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <img src="<?= ROOT ?>/assets/images/services2.png"" alt="" style=" max-width: 44px;">
                            </div>
                            <h4>LCD/LED TV Monitor Repairing</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <img src="<?= ROOT ?>/assets/images/services3.png" alt="" style="max-width: 44px;">
                            </div>
                            <h4>Photocopy,Duplo & Scanner Repairing</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <img src="<?= ROOT ?>/assets/images/services4.png" alt="" style="max-width: 44px;">
                            </div>
                            <h4>Network/CCTV/Security Systems</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Trending</h6>
                        <h2>Trending Products</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- <div class="main-button">
            <a href="shop.html">View All</a>
          </div> -->
                </div>

                <?php foreach ($featured as $row): ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <a href="<?= ROOT ?>/product-details?id=<?= $row['id'] ?>">
                                    <img src="<?= ROOT ?>/assets/images/products/<?= $row['image'] ?>" alt="">
                                </a>
                                <span class="price"><?= $row['price'] ?></span>
                            </div>
                            <div class="down-content">
                                <span class="category"><?= $row['category'] ?></span>
                                <h4><?= $row["product"] ?></h4>
                                <a href="<?= ROOT ?>/product-details?id=<?= $row['id'] ?>"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="col-12 d-flex justify-content-center my-4 main-button"><a href="<?= ROOT ?>/featured">View all</a></div>
        </div>
    </div>

    <div id="customCarousel" class="carousel slide" data-ride="carousel" data-interval="3000"> <!-- Auto-slide interval set to 3 seconds -->
        <!-- Carousel indicators (optional) -->
        <ol class="carousel-indicators">
            <li data-target="#customCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#customCarousel" data-slide-to="1"></li>
            <li data-target="#customCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Carousel slides -->
        <div class="carousel-inner">
            <!-- First Slide with Lazy-Loading -->
            <div class="carousel-item active">
                <img data-src="<?= ROOT ?>/assets/images/Cover 1.png" class="d-block w-100 lazyload" alt="Slide 1 Image">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>

            <!-- Second Slide with Lazy-Loading -->
            <div class="carousel-item">
                <img data-src="<?= ROOT ?>/assets/images/Cover 2.png" class="d-block w-100 lazyload" alt="Slide 2 Image">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>

            <!-- Third Slide with Lazy-Loading -->
            <div class="carousel-item">
                <img data-src="<?= ROOT ?>/assets/images/Cover 6.png" class="d-block w-100 lazyload" alt="Slide 3 Image">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>

        <!-- Carousel controls -->
        <a class="carousel-control-prev" href="#customCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#customCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="section most-played">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>TOP GAMES</h6>
                        <h2>Most Played</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="shop.html">View All</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/top-game-01.jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <span class="category">Adventure</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/top-game-02.jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <span class="category">Adventure</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/top-game-03.jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <span class="category">Adventure</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/top-game-04.jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <span class="category">Adventure</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/top-game-05.jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <span class="category">Adventure</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html">Explore</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/top-game-06.jpg" alt=""></a>
                        </div>
                        <div class="down-content">
                            <span class="category">Adventure</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html">Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6>Categories</h6>
                        <h2>Top Categories</h2>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/categories-01.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/categories-05.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/categories-03.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/categories-04.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="<?= ROOT ?>/assets/images/categories-05.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section cta">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="shop">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <h6>Service Hours</h6>
                                    <h2>We Are <em>24h</em> Available For You!</h2>
                                </div>
                                <p>🔴24hrs Technical Support. <br>🔴Island wide door step service for&emsp;<br>local Government and private sectors.
                                </p>
                                <div class="main-button">
                                    <!-- <a href="shop.html">Shop Now</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-2 align-self-end">
                    <div class="subscribe">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <h6>Contact US</h6>
                                    <h2>Contact Us <em>Now!</em> Hurry Up!</h2>
                                    <p>
                                        <br>
                                        <a href="tel:+94712095954"><i class="fas fa-phone-alt"></i>&emsp;+94 71 2095 954</a>
                                        <br><br>
                                        <a href="mailto:wavetechzone@gmail.com"><i class="fas fa-envelope"></i>&emsp;wavetechzone@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('./components/footer.php'); ?>
    <?php include('./components/scripts.php'); ?>
</body>

</html>
