<?php
require 'vendor/autoload.php';

// Get the current URL path and remove the base directory /wavetechzone/
$path = str_replace('/wavetechzone', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Define your routes
switch ($path) {
    case '/':
        require 'index.php';
        break;
    case '/contact':
        require 'contact.php';
        break;
    case '/shop':
        // require 'shop.php';
        require 'shop.php';
        break;
    case '/games':
        require 'games.php';
        break;
    case '/product-details':
        require 'product-details.php';
        break;
    default:
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}
