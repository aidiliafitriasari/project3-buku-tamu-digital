<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// PUBLIK ROUTE
$routes->get('/', 'GuestController::index');
$routes->get('pendaftaran', 'GuestController::register');
$routes->post('pendaftaran', 'GuestController::store');
$routes->get('pendaftaran/sukses/(:segment)', 'GuestController::success/$1');

// Authentication
$routes->get('akses-panel', 'AuthController::login');
$routes->post('akses-panel', 'AuthController::attemptLogin');
$routes->post('logout', 'AuthController::logout');

// Kiosk
$routes->get('kiosk', 'KioskController::index');
$routes->get('kiosk/register', 'KioskController::register');
$routes->get('kiosk/success/(:segment)', 'KioskController::success/$1');

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

        // WhatsApp Settings
        $routes->get('whatsapp-settings', 'Admin\WhatsappSettingController::index');
        $routes->post('whatsapp-settings/update', 'Admin\WhatsappSettingController::update');
        $routes->post('whatsapp-settings/test', 'Admin\WhatsappSettingController::test');

        // Pengguna
        $routes->get('users/partial', 'Admin\UserController::partial');
        $routes->get('users', 'Admin\UserController::index');
        $routes->post('users', 'Admin\UserController::store');
        $routes->post('users/update/(:num)', 'Admin\UserController::update/$1');
        $routes->post('users/reset-password/(:num)', 'Admin\UserController::resetPassword/$1');
        $routes->post('users/delete/(:num)', 'Admin\UserController::delete/$1');
        $routes->post('users/restore/(:num)', 'Admin\UserController::restore/$1');
        $routes->post('users/toggle-status/(:num)', 'Admin\UserController::toggleStatus/$1');

        // Pegawai
        $routes->get('employees/partial', 'Admin\EmployeeController::partial');
        $routes->get('employees', 'Admin\EmployeeController::index');
        $routes->post('employees', 'Admin\EmployeeController::store');
        $routes->post('employees/update/(:num)', 'Admin\EmployeeController::update/$1');
        $routes->post('employees/delete/(:num)', 'Admin\EmployeeController::delete/$1');
        $routes->post('employees/restore/(:num)', 'Admin\EmployeeController::restore/$1');
        $routes->post('employees/toggle-status/(:num)', 'Admin\EmployeeController::toggleStatus/$1');

        // Departemen
        $routes->get('departments/partial', 'Admin\DepartmentController::partial');
        $routes->get('departments', 'Admin\DepartmentController::index');
        $routes->post('departments', 'Admin\DepartmentController::store');
        $routes->post('departments/update/(:num)', 'Admin\DepartmentController::update/$1');
        $routes->post('departments/delete/(:num)', 'Admin\DepartmentController::delete/$1');
        $routes->post('departments/restore/(:num)', 'Admin\DepartmentController::restore/$1');
        $routes->post('departments/toggle-status/(:num)', 'Admin\DepartmentController::toggleStatus/$1');

        // Keperluan Kunjungan
        $routes->get('visit-purposes/partial', 'Admin\VisitPurposeController::partial');
        $routes->get('visit-purposes', 'Admin\VisitPurposeController::index');
        $routes->post('visit-purposes', 'Admin\VisitPurposeController::store');
        $routes->post('visit-purposes/update/(:num)', 'Admin\VisitPurposeController::update/$1');
        $routes->post('visit-purposes/delete/(:num)', 'Admin\VisitPurposeController::delete/$1');
        $routes->post('visit-purposes/restore/(:num)', 'Admin\VisitPurposeController::restore/$1');
        $routes->post('visit-purposes/toggle-status/(:num)', 'Admin\VisitPurposeController::toggleStatus/$1');

        // Kunjungan
        $routes->get('visits/partial', 'Admin\VisitController::partial');
        $routes->get('visits', 'Admin\VisitController::index');
        $routes->get('visits/(:num)/data', 'Admin\VisitController::getData/$1');
        $routes->get('visits/(:num)/edit', 'Admin\VisitController::edit/$1');
        $routes->get('visits/(:num)', 'Admin\VisitController::show/$1');
        $routes->post('visits/update/(:num)', 'Admin\VisitController::update/$1');
        $routes->post('visits/delete/(:num)', 'Admin\VisitController::delete/$1');
        $routes->post('visits/restore/(:num)', 'Admin\VisitController::restore/$1');

        $routes->post('visits/(:num)/check-in', 'Admin\VisitController::checkIn/$1');
        $routes->post('visits/(:num)/reject', 'Admin\VisitController::reject/$1');
        $routes->post('visits/(:num)/cancel', 'Admin\VisitController::cancel/$1');
        $routes->post('visits/(:num)/checkout', 'Admin\VisitController::checkout/$1');

        // Activity Log
        $routes->get('activity-logs/partial', 'Admin\ActivityLogController::partial');
        $routes->get('activity-logs', 'Admin\ActivityLogController::index');

        // Laporan
        $routes->get('reports/partial', 'Admin\ReportController::partial');
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
        $routes->get('visits/partial', 'Petugas\VisitController::partial');
        $routes->get('visits', 'Petugas\VisitController::index');
        $routes->get('visits/(:num)/data', 'Petugas\VisitController::getData/$1');
        $routes->get('visits/(:num)/edit', 'Petugas\VisitController::edit/$1');
        $routes->get('visits/(:num)', 'Petugas\VisitController::show/$1');
        $routes->post('visits/update/(:num)', 'Petugas\VisitController::update/$1');

        // Aksi
        $routes->post('visits/(:num)/check-in', 'Petugas\VisitController::checkIn/$1');
        $routes->post('visits/(:num)/reject', 'Petugas\VisitController::reject/$1');
        $routes->post('visits/(:num)/cancel', 'Petugas\VisitController::cancel/$1');
        $routes->post('visits/(:num)/checkout', 'Petugas\VisitController::checkout/$1');

        // Checkout via QR
        $routes->get('checkout', 'Petugas\CheckoutController::scan');
        $routes->get('checkout/(:segment)', 'Petugas\CheckoutController::index/$1');
        $routes->post('checkout/(:segment)', 'Petugas\CheckoutController::process/$1');
    }
);
