<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/incluirimagem', 'IncluirImagem::index');
$routes->get('/excluirimagem/(:num)', 'ExcluirImagem::index/$1');

