<?php

namespace Config;

use App\Libraries\Hash;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// $routes->get('/', 'Login::index');

$routes->group('/', ['filter' => 'AlreadyLoggedIn'], function ($routes) {
    $routes->get('', 'Login::login');
    $routes->get('login', 'Login::login');
    $routes->get('create', 'Login::create');
    $routes->post('check', 'Login::check');
    $routes->post('recover', 'Login::recover');
});
$routes->group('/', ['filter' => 'AuthCheck'], function ($routes) {
    $routes->group('dashboard/', static function ($routes) {
        $routes->get(Hash::path('index'), 'Dashboard::index');
        $routes->get(Hash::path('changepwd'), 'Dashboard::changepwd');
        $routes->post(Hash::path('updatepwd'), 'Dashboard::updatepwd');
        $routes->get(Hash::path('calendar'), 'Dashboard::calendar');
        $routes->get('load', 'Dashboard::load');
    });
    $routes->group('drone/', static function ($routes) {
        $routes->get(Hash::path('index'), 'Drone::index');
        $routes->get(Hash::path('add'), 'Drone::add');
        $routes->post(Hash::path('addAction'), 'Drone::addAction');
    });
    $routes->group('customer/', static function ($routes) {
        $routes->get(Hash::path('index'), 'Customer::index');
        $routes->post(Hash::path('view'), 'Customer::view');
        $routes->get(Hash::path('show') . '/(:any)', 'Customer::show/$1');
        $routes->get(Hash::path('history'), 'Customer::history');
        $routes->get(Hash::path('credit'), 'Customer::credit');
        $routes->get(Hash::path('cash'), 'Customer::cash');
    });
    $routes->group('payment/', static function ($routes) {
        $routes->get(Hash::path('index'), 'Payment::index');
        $routes->post(Hash::path('paymentAction'), 'Payment::paymentAction');
        $routes->post(Hash::path('paid'), 'Payment::paid');
    });
});
$routes->get('logout', 'Login::logout');

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
