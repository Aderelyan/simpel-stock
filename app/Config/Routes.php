<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Login::index');
$routes->get('/', 'Home::index');
$routes->get('/barang', 'Barang::index');
$routes->get('/barang/history', 'Barang::history');
$routes->get('/barang/list', 'Barang::listData'); 
$routes->post('/barang/add', 'Barang::add');       // <-- Rute baru
$routes->post('/barang/update', 'Barang::update');
$routes->get('/barang/edit/(:any)', 'Barang::edit/$1');

$routes->get('/pembelian', 'Pembelian::index');
$routes->get('/pembelian/history', 'Pembelian::history');
