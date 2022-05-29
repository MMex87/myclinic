<?php

namespace Config;


// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// routes Pendaftaran
$routes->get('/', 'Pendaftaran::index');

// routes Pendaftaran obat
$routes->get('/pendaftaran/obat', 'SistemObat::index');
$routes->get('/pendaftaran/obat/(:num)', 'SistemObat::tindakan/$1');

// routes Pendaftaran Diagnosa
$routes->get('/diagnosa', 'Diagnosa::index');
$routes->delete('/diagnosa/delete/(:num)', 'Diagnosa::delete/$1');
$routes->get('/diagnosa/tindakan/(:num)', 'Diagnosa::tindakan/$1');
$routes->get('/diagnosa/obat/', 'Diagnosa::obat/$1');
$routes->delete('/diagnosa/obatDelete/(:num)', 'Diagnosa::obatDelete/$1');

// routes Pasien
$routes->get('/pasien', 'Pasien::index');
$routes->get('/pasien/edit/(:segment)', 'Pasien::edit/$1');
$routes->delete('/pasien/data_pasien/(:num)', 'Pasien::delete/$1');

// routes Obat
$routes->get('/obat', 'Obat::index');
$routes->get('/obat/edit/(:segment)', 'Obat::edit/$1');
$routes->delete('/obat/data_obat/delete/(:num)', 'Obat::delete/$1');

// routes Laporan
$routes->get('/laporan', 'Laporan::index');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}