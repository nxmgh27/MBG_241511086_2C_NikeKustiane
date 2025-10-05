<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login & Auth
$routes->get('/login', 'Auth::login');
$routes->post('/login/auth', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');

// Dashboard
$routes->get('/dashboard/gudang', 'Dashboard::gudang');
$routes->get('/dashboard/dapur', 'Dashboard::dapur');

// Bahan Baku
$routes->get('/bahan', 'Bahan::index');
$routes->get('/bahan/create', 'Bahan::create');
$routes->post('/bahan/simpan', 'Bahan::store');
$routes->get('/bahan/edit/(:num)', 'Bahan::edit/$1');
$routes->post('/bahan/update/(:num)', 'Bahan::update/$1');
$routes->post('/bahan/delete/(:num)', 'Bahan::delete/$1');

// Dapur
$routes->get('/dapur/status_permintaan', 'DapurController::index');
$routes->get('/dapur/create_permintaan', 'DapurController::create');
$routes->post('/dapur/store', 'DapurController::store');
$routes->get('/dapur/data_bahan', 'DapurController::dataBahan');

// Gudang
$routes->get('/gudang/status_permintaan', 'PermintaanGudang::statusPermintaan');
$routes->get('/gudang/approve/(:num)', 'PermintaanGudang::approve/$1');
$routes->post('/gudang/reject/(:num)', 'PermintaanGudang::reject/$1');
$routes->post('/gudang/edit_status/(:num)', 'PermintaanGudang::edit_status/$1');

