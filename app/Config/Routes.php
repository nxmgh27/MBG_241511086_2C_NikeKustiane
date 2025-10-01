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

