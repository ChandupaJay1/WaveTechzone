<?php require_once SERVER_ROOT . '/config.php'; ?>

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
    <?php include_once('./components/header.php'); ?>
    <!-- ***** Header Area End ***** -->

    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Contact Us</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > Contact Us</span>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-page section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="left-text">
                        <div class="section-heading">
                            <h6>Contact Us</h6>
                            <h2>Say Hello!</h2>
                        </div>
                        <p>LUGX Gaming Template is based on the latest Bootstrap 5 CSS framework. This template is provided by TemplateMo and it is suitable for your gaming shop ecommerce websites. Feel free to use this for any purpose. Thank you.</p>
                        <ul>
                            <li><span>Address:</span>
                                <a href="https://www.google.com/maps?q=Sunny+Isles+Beach,+FL+33160,+United+States" target="_blank">
                                    Stage II, New Town, Anuradhapura Town, Sri Lanka
                                </a>
                            </li>
                            <li><span>Phone:</span>
                                <a href="tel:+94712095954">+94 71 209 5954</a>
                            </li>
                            <li><span>Email:</span>
                                <a href="mailto:wavetechzone@gmail.com">wavetechzone@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3319.804698421347!2d80.41825684170861!3d8.309222034076203!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afcf5160d51f77d%3A0x6bbab350b4841d51!2sWAVE%20TECHZONE!5e0!3m2!1sen!2slk!4v1729062126474!5m2!1sen!2slk" width="100%" height="325px" frameborder="0" style="border:0; border-radius: 23px;" allowfullscreen=""></iframe>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <!-- Contact form start -->
                                <form id="contact-form" action="contact-process.php" method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <input type="text" name="name" id="name" placeholder="Your Name..." autocomplete="on" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <input type="text" name="surname" id="surname" placeholder="Your Surname..." autocomplete="on" required>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <input type="email" name="email" id="email" placeholder="Your E-mail..." required>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6">
                                            <fieldset>
                                                <input type="text" name="subject" id="subject" placeholder="Subject..." autocomplete="on">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <textarea name="message" id="message" placeholder="Your Message"></textarea>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit" class="orange-button">Send Message Now</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </form>

                                <br>

                                <!-- Display success/error messages -->
                                <?php
                                if (isset($_GET['status'])) {
                                    if ($_GET['status'] == 'success') {
                                        echo "<p class='success-message'>🎉 Your message has been successfully sent! Thank you for reaching out to us.</p>";
                                    } elseif ($_GET['status'] == 'error') {
                                        echo "<p class='error-message'>⚠️ Oops! There was a problem sending your message. Please try again later.</p>";
                                    } elseif ($_GET['status'] == 'validation_error' && isset($_GET['message'])) {
                                        echo "<p class='error-message'>❌ " . htmlspecialchars($_GET['message']) . "</p>";
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('./components/footer.php'); ?>

    <!-- Scripts -->
    <?php include('./components/scripts.php'); ?>
</body>

</html>
