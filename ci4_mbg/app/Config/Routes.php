<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Auth::login');
$routes->post('/auth/doLogin', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard/gudang', 'Dashboard::gudang');
$routes->get('/dashboard/dapur', 'Dashboard::dapur');

$routes->group('bahanbaku', function($routes) {
    $routes->get('/', 'BahanBaku::index');
    $routes->get('create', 'BahanBaku::create');
    $routes->post('store', 'BahanBaku::store');
    $routes->get('edit/(:num)', 'BahanBaku::edit/$1');
    $routes->post('update/(:num)', 'BahanBaku::update/$1');
    $routes->get('delete/(:num)', 'BahanBaku::delete/$1');

    $routes->get('/bahanbaku', 'BahanBaku::index');
    $routes->get('/bahanbaku/create', 'BahanBaku::create');
    $routes->post('/bahanbaku/store', 'BahanBaku::store');
});
