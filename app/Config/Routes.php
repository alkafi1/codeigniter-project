<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['as' => 'home']);

$routes->group('products', function($routes) {
    $routes->get('/', 'ProductController::index', ['as' => 'products.index']);
    $routes->get('create', 'ProductController::create', ['as' => 'products.create']);
    $routes->post('/', 'ProductController::store', ['as' => 'products.store']);
    $routes->get('(:num)', 'ProductController::show/$1', ['as' => 'products.show']);
    $routes->get('(:num)/edit', 'ProductController::edit/$1', ['as' => 'products.edit']);
    $routes->post('(:num)', 'ProductController::update/$1', ['as' => 'products.update']);
    $routes->get('(:num)/delete', 'ProductController::delete/$1', ['as' => 'products.delete']);
});
