<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->post('/register', 'Login::register');
$routes->get('/logout', 'Login::logout');
$routes->post('/login', 'Login::auth');

$routes->group('',['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'Home::index');

    // menu user
    $routes->get('/user', 'UserController::index');
    $routes->post('/user', 'UserController::create');
    $routes->post('/user/hapus', 'UserController::delete');
    $routes->get('/user/detail', 'UserController::detail');
    $routes->post('/user/update', 'UserController::update');

    // menu file
    $routes->get('/file', 'ArsipController::index');
    $routes->post('/file', 'ArsipController::create');
    $routes->get('/file/detail', 'ArsipController::detail');
    $routes->post('/file/update', 'ArsipController::update');
    $routes->post('/file/hapus', 'ArsipController::delete');

    // menu fakultas
    $routes->get('/fakultas', 'FakultasController::index');
    $routes->post('/fakultas', 'FakultasController::create');
    $routes->get('/fakultas/detail', 'FakultasController::detail');
    $routes->post('/fakultas/update', 'FakultasController::update');
    $routes->post('/fakultas/hapus', 'FakultasController::delete');

    // menu kategori
    $routes->get('/kategori', 'KategoriController::index');
    $routes->post('/kategori', 'KategoriController::create');
    $routes->get('/kategori/detail', 'KategoriController::detail');
    $routes->post('/kategori/update', 'KategoriController::update');
    $routes->post('/kategori/hapus', 'KategoriController::delete');
    
});


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
