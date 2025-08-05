<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('auth', function($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::login');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::register');
    $routes->get('logout', 'AuthController::logout');
});

$routes->get('dashboard', 'Home::dashboard', ['filter' => 'auth']);

$routes->group('mahasiswa', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'MahasiswaController::index');
    $routes->get('create', 'MahasiswaController::create');
    $routes->post('store', 'MahasiswaController::store');
    $routes->get('edit/(:num)', 'MahasiswaController::edit/$1');
    $routes->post('update/(:num)', 'MahasiswaController::update/$1');
    $routes->get('delete/(:num)', 'MahasiswaController::delete/$1');
});
