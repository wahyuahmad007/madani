<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'home::index');
$routes->setAutoRoute(true);

$routes->post('chart-pendapatan', 'Admin::showChartTransaksi');
$routes->post('chart-produk', 'Admin::showchartproduk');
