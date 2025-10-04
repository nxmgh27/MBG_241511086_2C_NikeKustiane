<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login & Auth Routes
$routes->get('/login', 'Auth::login');
$routes->post('/login/auth', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');

// Dashboard Routes
$routes->get('/dashboard/gudang', 'Dashboard::gudang');
$routes->get('/dashboard/dapur', 'Dashboard::dapur');

// Bahan Baku Routes
$routes->get('/bahan', 'Bahan::index');                 
$routes->get('/bahan/create', 'Bahan::create');         
$routes->post('/bahan/simpan', 'Bahan::store');         
$routes->get('/bahan/edit/(:num)', 'Bahan::edit/$1');   
$routes->post('/bahan/update/(:num)', 'Bahan::update/$1'); 
$routes->post('/bahan/delete/(:num)', 'Bahan::delete/$1');   

// Permintaan Bahan Routes - Gudang
$routes->get('/gudang/status_permintaan', 'Permintaan::statusPermintaan');  
$routes->get('/gudang/approve/(:num)', 'Permintaan::approve/$1');          
$routes->post('/gudang/reject/(:num)', 'Permintaan::reject/$1');          

// Permintaan Bahan Routes - Dapur
$routes->get('/dapur/status_permintaan', 'Dapur::statusPermintaan');

// Permintaan Dapur Routes
$routes->get('/dapur/permintaan', 'PermintaanDapur::index');    // lihat status permintaan
$routes->get('/dapur/permintaan/create', 'PermintaanDapur::create'); // form buat permintaan
$routes->post('/dapur/permintaan/store', 'PermintaanDapur::store'); // simpan permintaan



