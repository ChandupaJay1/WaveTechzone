<?php

require_once __DIR__ . '/config.php';

// $path = str_replace('/wavetechzone', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$uri = $_GET['uri'];

// Define your routes
switch ($uri) {
    case '/':
    case '':
        require 'index.php';
        break;
    case 'contact':
    case 'contact/':
        require 'contact.php';
        break;
    case 'shop':
    case 'shop/':
        require 'shop.php';
        break;
    case 'cart':
    case 'cart/':
        require 'cart.php';
        break;
    case 'games':
    case 'games/':
        require 'games.php';
        break;
    case 'product-details':
    case 'product-details/':
        require 'product-details.php';
        break;
    case 'admin':
    case 'admin/':
        require 'admin/adminLogin.php';
        break;
    case 'adminDashboard':
    case 'adminDashboard/':
        require 'admin/adminDashboard.php';
        break;
    case 'adminLogout':
    case 'adminLogout/':
        require 'admin/adminLogout.php';
        break;
    case 'adminRegister':
    case 'adminRegister/':
        require 'admin/adminRegister.php';
        break;
    case 'adminAddProducts':
    case 'adminAddProducts/':
        require 'admin/adminAddProducts.php';
        break;
    case 'handleProduct':
    case 'handleProduct/':
        require 'admin/addCatupdelpro.php';
        break;
    default:
        http_response_code(404);
        exit("Page not found");
}
