<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//Login & Auth Routes
$routes->get('/login', 'Auth::login');
$routes->post('/login/auth', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');

// Dashboard Routes
$routes->get('/dashboard/gudang', 'Dashboard::gudang');
$routes->get('/dashboard/dapur', 'Dashboard::dapur');

// Bahan Baku Routes
$routes->get('/bahan', 'Bahan::index');                 // Lihat data bahan
$routes->get('/bahan/create', 'Bahan::create');         // Form tambah bahan
$routes->post('/bahan/simpan', 'Bahan::store');         // Simpan bahan baru
$routes->get('/bahan/edit/(:num)', 'Bahan::edit/$1');   // Form edit bahan
$routes->post('/bahan/update/(:num)', 'Bahan::update/$1'); // Update bahan
$routes->get('/bahan/delete/(:num)', 'Bahan::delete/$1');   // Hapus bahan

// Route untuk halaman Status Permintaan Gudang
$routes->get('/gudang/status_permintaan', 'Permintaan::index');

