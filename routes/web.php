<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrestasiController;


/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
|
| / akan memanggil DashboardController@publicDashboard
|
*/
Route::get('/', [DashboardController::class, 'publicDashboard'])
    ->name('public.dashboard');


/*
|--------------------------------------------------------------------------
| PROFIL
|--------------------------------------------------------------------------
*/
Route::get(
    '/profil',
    [ProfilSekolahController::class, 'publicProfil']
)->name('public.profil');


/*
|--------------------------------------------------------------------------
| GURU PUBLIC
|--------------------------------------------------------------------------
*/

/*
 * Daftar guru
 * URL: /guru
 */
Route::get(
    '/guru',
    [GuruController::class, 'publicGuru']
)->name('public.guru');


/*
 * Detail guru
 * URL: /guru/{id}
 */
Route::get('/guru/{id}', [GuruController::class, 'publicShow'])
    ->name('public.guru.show');

/*
|--------------------------------------------------------------------------
| SISWA PUBLIC
|--------------------------------------------------------------------------
*/
Route::get(
    '/siswa',
    [SiswaController::class, 'publicSiswa']
)->name('public.siswa');


/*
|--------------------------------------------------------------------------
| PRESTASI PUBLIC
|--------------------------------------------------------------------------
*/

Route::get(
    '/prestasi',
    [PrestasiController::class, 'publicPrestasi']
)->name('public.prestasi');

Route::get('/prestasi/{id}', [PrestasiController::class, 'publicShow'])
    ->name('public.prestasi.show');

/*
|--------------------------------------------------------------------------
| BERITA PUBLIC
|--------------------------------------------------------------------------
*/
Route::get(
    '/berita',
    [BeritaController::class, 'publicBerita']
)->name('public.berita');

Route::get( '/berita/{slug}', [BeritaController::class, 'publicShow'] )->name('public.berita.show');

/*
|--------------------------------------------------------------------------
| PENGUMUMAN PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/pengumuman', [PengumumanController::class, 'publicPengumuman'])
    ->name('public.pengumuman');

Route::get('/pengumuman/{id}', [PengumumanController::class, 'publicShow'])
    ->name('public.pengumuman.show');


/*
|--------------------------------------------------------------------------
| EKSTRAKURIKULER PUBLIC
|--------------------------------------------------------------------------
*/
Route::get(
    '/ekstrakurikuler',
    [EkstrakurikulerController::class, 'publicEkstrakurikuler']
)->name('public.ekstrakurikuler');
Route::get( '/ekstrakurikuler/{slug}', [EkstrakurikulerController::class, 'publicShow'] )->name('public.ekstrakurikuler.show');



/*
|--------------------------------------------------------------------------
| GALERI PUBLIC
|--------------------------------------------------------------------------
*/
Route::get(
    '/galeri',
    [GaleriController::class, 'publicGaleri']
)->name('public.galeri');

Route::get('/galeri/{id}', [GaleriController::class, 'publicShow'])
    ->name('public.galeri.show');
/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    /*
     * Login user
     */
    Route::get(
        '/login',
        [AuthController::class, 'index']
    )->name('login');


    /*
     * Login admin
     */
    Route::get(
        '/admin/login',
        [AuthController::class, 'index']
    )->name('admin.login');


    /*
     * Proses login
     */
    Route::post(
        '/admin/login',
        [AuthController::class, 'processLogin']
    )->name('proses.login');
});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::match(
    ['get', 'post'],
    '/logout',
    [AuthController::class, 'logout']
)->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | PROFIL SEKOLAH
        |--------------------------------------------------------------------------
        */

        Route::prefix('profil-sekolah')->group(function () {

            Route::get(
                '/',
                [ProfilSekolahController::class, 'index']
            )->name('admin.profil.index');

            Route::post(
                '/save',
                [ProfilSekolahController::class, 'save']
            )->name('admin.profil.save');
        });


        Route::get(
            '/profil/edit',
            [ProfilSekolahController::class, 'edit']
        )->name('admin.profil.edit');


        /*
        |--------------------------------------------------------------------------
        | BERITA
        |--------------------------------------------------------------------------
        */

        Route::prefix('berita')->group(function () {

            Route::get(
                '/',
                [BeritaController::class, 'index']
            )->name('admin.berita.index');

            Route::get(
                '/add-edit/{id?}',
                [BeritaController::class, 'addEdit']
            )->name('admin.berita.addEdit');

            Route::post(
                '/save/{id?}',
                [BeritaController::class, 'save']
            )->name('admin.berita.save');

            Route::get(
                '/{id}',
                [BeritaController::class, 'show']
            )->name('admin.berita.show');

            Route::delete(
                '/{id}',
                [BeritaController::class, 'destroy']
            )->name('admin.berita.delete');
        });

        /*
|--------------------------------------------------------------------------
| PENGUMUMAN ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('pengumuman')->group(function () {

    Route::get('/', [PengumumanController::class, 'index'])
        ->name('admin.pengumuman.index');

    Route::get('/add-edit/{id?}', [PengumumanController::class, 'addEdit'])
        ->name('admin.pengumuman.addEdit');

    Route::post('/save', [PengumumanController::class, 'save'])
        ->name('admin.pengumuman.save');

    Route::get('/{id}', [PengumumanController::class, 'show'])
        ->name('admin.pengumuman.show');

    Route::delete('/{id}', [PengumumanController::class, 'destroy'])
        ->name('admin.pengumuman.delete');
});


        /*
|--------------------------------------------------------------------------
| PRESTASI
|--------------------------------------------------------------------------
*/

Route::prefix('prestasi')->group(function () {

    Route::get(
        '/',
        [PrestasiController::class, 'index']
    )->name('admin.prestasi.index');

    Route::get(
        '/add-edit/{id?}',
        [PrestasiController::class, 'addEdit']
    )->name('admin.prestasi.addEdit');

    Route::post(
        '/save/{id?}',
        [PrestasiController::class, 'save']
    )->name('admin.prestasi.save');

    Route::get(
        '/{id}',
        [PrestasiController::class, 'show']
    )->name('admin.prestasi.show');

    Route::delete(
        '/{id}',
        [PrestasiController::class, 'destroy']
    )->name('admin.prestasi.delete');
});


        /*
        |--------------------------------------------------------------------------
        | EKSTRAKURIKULER
        |--------------------------------------------------------------------------
        */

        Route::prefix('ekstrakurikuler')->group(function () {

            Route::get(
                '/',
                [EkstrakurikulerController::class, 'index']
            )->name('admin.ekstrakurikuler.index');

            Route::get(
                '/add-edit/{id?}',
                [EkstrakurikulerController::class, 'addEdit']
            )->name('admin.ekstrakurikuler.addEdit');

            Route::post(
                '/save/{id?}',
                [EkstrakurikulerController::class, 'save']
            )->name('admin.ekstrakurikuler.save');

            Route::get(
                '/{id}',
                [EkstrakurikulerController::class, 'show']
            )->name('admin.ekstrakurikuler.show');

            Route::delete(
                '/{id}',
                [EkstrakurikulerController::class, 'destroy']
            )->name('admin.ekstrakurikuler.delete');
        });


        /*
        |--------------------------------------------------------------------------
        | GALERI
        |--------------------------------------------------------------------------
        */

        Route::prefix('galeri')->group(function () {

            Route::get(
                '/',
                [GaleriController::class, 'index']
            )->name('admin.galeri.index');

            Route::get(
                '/add-edit/{id?}',
                [GaleriController::class, 'addEdit']
            )->name('admin.galeri.addEdit');

            Route::post(
                '/save/{id?}',
                [GaleriController::class, 'save']
            )->name('admin.galeri.save');

            Route::get(
                '/{id}',
                [GaleriController::class, 'show']
            )->name('admin.galeri.show');

            Route::delete(
                '/{id}',
                [GaleriController::class, 'destroy']
            )->name('admin.galeri.delete');
        });


        /*
        |--------------------------------------------------------------------------
        | GURU
        |--------------------------------------------------------------------------
        */

        Route::prefix('guru')->group(function () {

            /*
             * Admin & Operator
             * Melihat daftar guru
             */
            Route::get(
                '/',
                [GuruController::class, 'index']
            )->name('admin.guru.index');


            /*
             * ADMIN SAJA
             * Tambah, edit, hapus
             */
            Route::middleware('role:admin')->group(function () {

                Route::get(
                    '/add-edit/{id?}',
                    [GuruController::class, 'addEdit']
                )->name('admin.guru.addEdit');

                Route::post(
                    '/save/{id?}',
                    [GuruController::class, 'save']
                )->name('admin.guru.save');

                Route::delete(
                    '/{id}',
                    [GuruController::class, 'destroy']
                )->name('admin.guru.delete');
            });


            /*
             * Admin & Operator
             * Detail guru
             */
            Route::get(
                '/{id}',
                [GuruController::class, 'show']
            )->name('admin.guru.show');
        });


        /*
        |--------------------------------------------------------------------------
        | SISWA
        |--------------------------------------------------------------------------
        */

        Route::prefix('siswa')->group(function () {

            /*
             * Admin & Operator
             */
            Route::get(
                '/',
                [SiswaController::class, 'index']
            )->name('admin.siswa.index');


            /*
             * Admin saja
             */
            Route::middleware('role:admin')->group(function () {

                Route::get(
                    '/add-edit/{id?}',
                    [SiswaController::class, 'addEdit']
                )->name('admin.siswa.addEdit');

                Route::post(
                    '/save/{id?}',
                    [SiswaController::class, 'save']
                )->name('admin.siswa.save');

                Route::delete(
                    '/{id}',
                    [SiswaController::class, 'destroy']
                )->name('admin.siswa.delete');
            });


            /*
             * Admin & Operator
             */
            Route::get(
                '/{id}',
                [SiswaController::class, 'show']
            )->name('admin.siswa.show');
        });


        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        Route::prefix('user')->group(function () {

            /*
             * Admin & Operator
             */
            Route::get(
                '/',
                [UserController::class, 'index']
            )->name('admin.user.index');


            /*
             * Admin saja
             */
            Route::middleware('role:admin')->group(function () {

                Route::get(
                    '/add-edit/{id?}',
                    [UserController::class, 'addEdit']
                )->name('admin.user.addEdit');

                Route::post(
                    '/save/{id?}',
                    [UserController::class, 'save']
                )->name('admin.user.save');

                Route::delete(
                    '/{id}',
                    [UserController::class, 'destroy']
                )->name('admin.user.delete');
            });


            /*
             * Admin & Operator
             */
            Route::get(
                '/{id}',
                [UserController::class, 'show']
            )->name('admin.user.show');
        });

    });