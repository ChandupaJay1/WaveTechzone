<?php

require 'vendor/autoload.php';
require './config.php';


// Get the current URL path and remove the base directory /wavetechzone/
// $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$path = str_replace('/wavetechzone', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
// echo "Resolved Path: $path"; // For debugging

// Define your routes
switch ($path) {
    case '/':
        require 'index.php';
        break;
    case '/contact':
    case '/contact/':
        require 'contact.php';
        break;
    case '/shop':
    case '/shop/':
        require 'shop.php';
        break;
    case '/cart':
    case '/cart/':
        require 'cart.php';
        break;
    case '/games':
    case '/games/':
        require 'games.php';
        break;
    case '/product-details':
    case '/product-details/':
        require 'product-details.php';
        break;
    case '/admin':
    case '/admin/':
        require 'admin/adminLogin.php';
        break;
    case '/adminDashboard':
    case '/adminDashboard/':
        require 'admin/adminDashboard.php';
        break;
    case '/adminLogout':
    case '/adminLogout/':
        require 'admin/adminLogout.php';
        break;
    case '/adminRegister':
    case '/adminRegister/':
        require 'admin/adminRegister.php';
        break;
    case '/adminAddProducts':
    case '/adminAddProducts/':
        require 'admin/adminAddProducts.php';
        break;
    case '/handleProduct':
    case '/handleProduct/':
        require 'admin/addCatupdelpro.php';
        break;
    default:
        http_response_code(404);
        exit("Page not found");
}
