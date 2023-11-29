<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//CLIENT
$routes->get('/', 'Client::index');
$routes->post('/', 'Client::index');
$routes->get('Authentication/signInClient', 'Authentication::signInClient');
$routes->get('Client/showSignUp', 'Client::showSignUp');
$routes->get('Client/showSignIn', 'Client::showSignIn');
$routes->post('Client/registerUser', 'Client::registerUser');
$routes->post('Client/getProducts', 'Client::getProducts');
$routes->post('Client/showModalSignIn', 'Client::showModalSignIn');
$routes->post('Client/addProductToShop', 'Client::addProductToShop'); 
$routes->post('Client/removeProductToShop', 'Client::removeProductToShop');
$routes->post('Client/basket', 'Client::basket');
$routes->get('Client/getDtShop', 'Client::getDtShop');
$routes->get('Client/account', 'Client::account');
$routes->post('Client/logout', 'Client::logout');

//ADMIN
#GET
$routes->get('Admin', 'Authentication::signInAdmin');
$routes->get('Admin/main', 'Admin::index');
$routes->get('Admin/showViewProducts', 'Admin::showViewProducts');
$routes->get('Admin/showViewEmployees', 'Admin::showViewEmployees');
$routes->get('Admin/showViewSales', 'Admin::showViewSales');
$routes->get('Admin/showViewSales', 'Admin::showViewSales');
$routes->get('Admin/showViewCreateProduct', 'Admin::showViewCreateProduct');
#POST
$routes->post('Admin/showViewProducts', 'Admin::showViewProducts');
$routes->post('Admin/createProduct', 'Admin::createProduct');
$routes->post('Admin/showViewModalCreateCategory', 'Admin::showViewModalCreateCategory');
$routes->post('Admin/createCategory', 'Admin::createCategory');
$routes->post('Admin/showViewModalCreateSubCategory', 'Admin::showViewModalCreateSubCategory');
$routes->post('Admin/createSubCategory', 'Admin::createSubCategory');
$routes->post('Admin/showViewCreateProduct', 'Admin::showViewCreateProduct');
$routes->post('Admin/productActions', 'Admin::productActions');


//Authentication
$routes->post('Authentication/login', 'Authentication::login');
$routes->post('Authentication/signInProcessAdmin', 'Authentication::signInProcessAdmin');
$routes->post('Authentication/signInProcessClient', 'Authentication::signInProcessClient');
