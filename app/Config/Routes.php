<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->getDefaultController('LoginController');
$routes->setDefaultMethod('index');
$routes->setAutoRoute(true);
// $routes->get('/', 'Home::user');
$routes->get('/cabang/index', 'CabangController::index');
$routes->get('/cabang/index', 'CabangController::simpan');
$routes->get('/cabang/tambah', 'CabangController::tambah');
$routes->get('simpan', 'CabangController::simpan'); // Menangani form submission
$routes->get('index', 'CabangController::index');
$routes->get('cabang/tambah', 'CabangController::tambah');
$routes->post('cabang/simpan', 'CabangController::simpan');
$routes->get('cabang/hapus/(:num)', 'CabangController::hapus/$1');
$routes->get('cabang/edit', 'CabangController::edit');
$routes->get('cabang/edit/(:num)', 'CabangController::edit/$1');
$routes->post('cabang/update/(:num)', 'CabangController::update/$1');
$routes->get('/vendor/index', 'VendorController::index');
$routes->get('/vendor/tambah', 'VendorController::tambah');
$routes->post('/vendor/simpan', 'VendorController::simpan');
$routes->get('vendor/hapus/(:num)', 'VendorController::hapus/$1');
// $routes->get('/kontrak/index', 'KontrakController::index');
$routes->group('kontrak', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('index', 'KontrakController::index');
});

$routes->get('/kontrak/tambah', 'KontrakController::tambah');
$routes->post('/kontrak/simpan', 'KontrakController::simpan');
$routes->get('kontrak/lihatPdf/(:segment)', 'KontrakController::lihatPdf/$1');
$routes->get('kontrak/hapus/(:num)', 'KontrakController::hapus/$1');
$routes->get('kontrak/edit/(:num)', 'KontrakController::edit/$1');
$routes->post('kontrak/update/(:num)', 'KontrakController::update/$1');
$routes->get('/penilaian/index', 'PenilaianController::index');
$routes->get('/', 'LoginController::index');
$routes->get('/penilaian', 'KontrakController::tampilkanPenilaian');
$routes->get('/file/(:segment)', 'FileController::lihatFile/$1');
$routes->get('/kontrak/edit/(:num)', 'KontrakController::edit/$1');
$routes->get('/penilaian/upload/(:num)', 'PenilaianController::upload/$1');
$routes->get('/penilaian/update/(:num)', 'PenilaianController::update/$1');
$routes->get('/penilaian/personil/(:num)', 'PenilaianController::personil/$1');
$routes->get('/penilaian/kinerja/(:num)', 'PenilaianController::kinerja/$1');
$routes->get('/penilaian/m_mitra/(:num)', 'PenilaianController::m_mitra/$1');
$routes->get('/penilaian/material/(:num)', 'PenilaianController::material/$1');
$routes->get('/penilaian/kedisiplinan/(:num)', 'PenilaianController::kedisiplinan/$1');
$routes->get('/penilaian/fatal_error/(:num)', 'PenilaianController::fatal_error/$1');
$routes->post('/penilaian/update/(:num)', 'PenilaianController::update/$1');
$routes->post('/penilaian/tambahpersonil/(:num)', 'PenilaianController::tambahpersonil/$1');
$routes->post('/penilaian/tambahkinerja/(:num)', 'PenilaianController::tambahkinerja/$1');
$routes->post('/penilaian/tambahmanajemen/(:num)', 'PenilaianController::tambahmanajemen/$1');
$routes->post('/penilaian/tambahmaterial/(:num)', 'PenilaianController::tambahmaterial/$1');
$routes->post('/penilaian/tambahkedisiplinan/(:num)', 'PenilaianController::tambahkedisiplinan/$1');
$routes->post('/penilaian/tambahfatal_error/(:num)', 'PenilaianController::tambahfatal_error/$1');
$routes->get('/penilaian/laporan', 'PenilaianController::laporan');
$routes->get('penilaian/cetakPDF', 'PenilaianController::cetakPDF', ['as' => 'cetakPDF']);
$routes->get('penilaian/cetakPDFlaporan', 'PenilaianController::cetakPDFlaporan');
$routes->get('kontrak/cetakPDF', 'KontrakController::cetakPDF');
$routes->post('/kontrak/update/(:num)', 'KontrakController::update/$1');
$routes->post('/LoginController/login', 'LoginController::login');
$routes->post('/logout', 'LoginController::logout');
$routes->delete('penilaian/delete/(:num)', 'PenilaianController::delete/$1');
$routes->get('download/(:segment)', 'PenilaianController::download/$1');
$routes->get('/penilaian/cetak/(:any)/(:any)', 'PenilaianController::cetak/$1/$2');
$routes->get('/vendor/edit/(:num)', 'VendorController::edit/$1');  // Penambahan route edit
$routes->post('/vendor/update/(:num)', 'VendorController::update/$1');  // Penambahan route update
$routes->post('/login/login', 'LoginController::login');
$routes->get('/cabang/cari', 'CabangController::cari');
$routes->get('/kontrak/cetakByCabang/(:any)', 'KontrakController::cetakByCabang/$1');



// // Menambahkan rute untuk tambahfile
$routes->get('/penilaian/tambahfile/(:num)', 'PenilaianController::tambahfile/$1');

// // Menambahkan rute untuk simpanfile
$routes->get('/penilaian/update/(:num)', 'PenilaianController::update/$1');
