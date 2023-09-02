<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::submit');
$routes->get('/signup', 'Signup::index');
$routes->post('/signup', 'Signup::submit');
// $routes->get('/signup/submit', 'Signup::submit');
$routes->get('/signup/success', 'Login::index');
$routes->get('/login/success', 'Login::success');
$routes->get('/test/database', 'Test::databaseTest');
