<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Login::index');
$routes->get('/barang', 'Barang::index');
$routes->get('/barang/history', 'Barang::history');
$routes->get('/barang/list', 'Barang::listData'); 
$routes->post('/barang/add', 'Barang::add');       // <-- Rute baru
$routes->post('/barang/update', 'Barang::update');
$routes->get('/barang/edit/(:any)', 'Barang::edit/$1');
$routes->post('/barang/delete/(:any)', 'Barang::delete/$1');
$routes->post('/barang/reset', 'Barang::reset');

$routes->get('/pembelian', 'Pembelian::index');
$routes->get('/pembelian/history', 'Pembelian::history');
$routes->get('/pembelian/list', 'Pembelian::listData');
$routes->post('/pembelian/add', 'Pembelian::add'); 
$routes->post('/pembelian/update', 'Pembelian::update');
$routes->get('/pembelian/edit/(:any)', 'Pembelian::edit/$1');
$routes->post('/pembelian/delete/(:any)', 'Pembelian::delete/$1');
$routes->post('/pembelian/reset', 'Pembelian::reset');
