<header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">

            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">
              <img src="assets/images/logo-tp.png" alt="" style="width: 50px;">
            </a>
            <!-- ***** Logo End ***** -->

            <!-- ***** Menu Start ***** -->
            <ul class="nav">
                <li><a href="/wavetechzone/" <?= !isset($path) || ($path === '/') ? 'class="active"' : '' ?> >Home</a></li>
                <li><a href="/wavetechzone/shop" <?= (isset($path) && $path === '/shop') ? 'class="active"' : '' ?> >Shop</a></li>
                              <!-- <li><a href="/wavetechzone/product-details">Product Details</a></li> -->
                <li><a href="/wavetechzone/games" <?= (isset($path) && $path === '/games') ? 'class="active"' : '' ?> >Games</a></li>
                <li><a href="/wavetechzone/contact" <?= (isset($path) && $path === '/contact') ? 'class="active"' : '' ?> >Contact Us</a></li>
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
