<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">

                    <!-- ***** Logo Start ***** -->
                    <a href="<?= ROOT ?>" class="logo">
                        <img src="<?= asset('images/logo-tp.png') ?>" alt="" style="width: 50px;">
                    </a>
                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="<?= ROOT ?>" <?= !isset($path) || ($path === '/') ? 'class="active"' : '' ?>>Home</a></li>
                        <li><a href="<?= ROOT ?>/shop" <?= (isset($path) && $path === '/shop') ? 'class="active"' : '' ?>>Shop</a></li>
                        <!-- <li><a href="<?= ROOT ?>/product-details">Product Details</a></li> -->
                        <li><a href="<?= ROOT ?>/contact" <?= (isset($path) && $path === '/contact') ? 'class="active"' : '' ?>>Contact Us</a></li>
                        <li><a href="<?= ROOT ?>/admin" <?= (isset($path) && $path === '/admin') ? 'class="active"' : '' ?>>Admin</a></li>
                        <!-- <li><a href="#">Sign In</a></li> -->
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
