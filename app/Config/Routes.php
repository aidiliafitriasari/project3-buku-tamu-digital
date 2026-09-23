<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// PUBLIK ROUTE
$routes->get('/', 'Home::index');

// Authentication
$routes->get('akses-panel', 'AuthController::login');
$routes->post('akses-panel', 'AuthController::attemptLogin');
$routes->post('logout', 'AuthController::logout');

// Guest
$routes->get('pendaftaran', 'GuestController::index');
$routes->get('pendaftaran/sukses', 'GuestController::success');

// Kiosk
$routes->get('kiosk', 'KioskController::index');

// Checkout melalui QR
$routes->get('checkout/(:segment)', 'CheckoutController::index/$1');
$routes->post('checkout/(:segment)', 'CheckoutController::process/$1');

// ADMINISTRATOR ROUTE
$routes->group(
    'admin',
    [
        'filter' => [
            'auth',
            'role:administrator',
        ],
    ],
    static function ($routes) {

        $routes->get('dashboard', 'Admin\DashboardController::index');

        // Identitas Instansi
        $routes->get('institution', 'Admin\InstitutionController::index');
        $routes->post('institution/update', 'Admin\InstitutionController::update');

        // Pengaturan
        $routes->get('settings', 'Admin\SettingsController::index');
        $routes->post('settings/update', 'Admin\SettingsController::update');

        // Pengguna
        $routes->get('users', 'Admin\UserController::index');
        $routes->get('users/create', 'Admin\UserController::create');
        $routes->post('users', 'Admin\UserController::store');
        $routes->get('users/edit/(:num)', 'Admin\UserController::edit/$1');
        $routes->post('users/update/(:num)', 'Admin\UserController::update/$1');
        $routes->post('users/delete/(:num)', 'Admin\UserController::delete/$1');

        // Pegawai
        $routes->get('employees', 'Admin\EmployeeController::index');
        $routes->get('employees/create', 'Admin\EmployeeController::create');
        $routes->post('employees', 'Admin\EmployeeController::store');
        $routes->get('employees/edit/(:num)', 'Admin\EmployeeController::edit/$1');
        $routes->post('employees/update/(:num)', 'Admin\EmployeeController::update/$1');
        $routes->post('employees/delete/(:num)', 'Admin\EmployeeController::delete/$1');

        // Departemen
        $routes->get('departments', 'Admin\DepartmentController::index');
        $routes->get('departments/create', 'Admin\DepartmentController::create');
        $routes->post('departments', 'Admin\DepartmentController::store');
        $routes->get('departments/edit/(:num)', 'Admin\DepartmentController::edit/$1');
        $routes->post('departments/update/(:num)', 'Admin\DepartmentController::update/$1');
        $routes->post('departments/delete/(:num)', 'Admin\DepartmentController::delete/$1');

        // Keperluan Kunjungan
        $routes->get('visit-purposes', 'Admin\VisitPurposeController::index');
        $routes->get('visit-purposes/create', 'Admin\VisitPurposeController::create');
        $routes->post('visit-purposes', 'Admin\VisitPurposeController::store');
        $routes->get('visit-purposes/edit/(:num)', 'Admin\VisitPurposeController::edit/$1');
        $routes->post('visit-purposes/update/(:num)', 'Admin\VisitPurposeController::update/$1');
        $routes->post('visit-purposes/delete/(:num)', 'Admin\VisitPurposeController::delete/$1');

        // Kunjungan
        $routes->get('visits', 'Admin\VisitController::index');
        $routes->get('visits/(:num)', 'Admin\VisitController::show/$1');

        // Activity Log
        $routes->get('activity-logs', 'Admin\ActivityLogController::index');
        $routes->get('activity-logs/(:num)', 'Admin\ActivityLogController::show/$1');

        // Laporan
        $routes->get('reports', 'Admin\ReportController::index');
        $routes->get('reports/export', 'Admin\ReportController::export');
        $routes->get('reports/print', 'Admin\ReportController::print');
    }
);

// PETUGAS ROUTE
$routes->group(
    'petugas',
    [
        'filter' => [
            'auth',
            'role:petugas',
        ],
    ],
    static function ($routes) {

        $routes->get('dashboard', 'Petugas\DashboardController::index');

        // Kunjungan
        $routes->get('visits', 'Petugas\VisitController::index');
        $routes->get('visits/(:num)', 'Petugas\VisitController::show/$1');
        $routes->get('visits/(:num)/edit', 'Petugas\VisitController::edit/$1');
        $routes->post('visits/(:num)/update', 'Petugas\VisitController::update/$1');

        // Check-in
        $routes->post(
            'visits/(:num)/check-in',
            'Petugas\VisitController::checkIn/$1'
        );

        // Checkout
        $routes->post(
            'visits/(:num)/checkout',
            'Petugas\VisitController::checkout/$1'
        );
    }
);
