<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Auth::login');
$routes->post('/login/auth', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard/gudang', 'Dashboard::gudang');
$routes->get('/dashboard/dapur', 'Dashboard::dapur');


