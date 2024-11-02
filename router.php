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
        require 'contact.php';
        break;
    case '/shop':
        require 'shop.php';
        break;
    case '/games':
        require 'games.php';
        break;
    case '/product-details':
        require 'product-details.php';
        break;
    case '/admin/':
        require 'admin/adminLogin.php';
        break;
    case '/adminDashboard.php':
        require 'admin/adminDashboard.php';
        break;
    case '/adminLogout':
        require 'admin/adminLogout.php';
        break;
    case '/adminRegister/':
        require 'admin/adminRegister.php';
        break;
    default:
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}
