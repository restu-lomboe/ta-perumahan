<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PemesananController;
use App\Http\Controllers\Backend\PerumahanController;
use App\Http\Controllers\Backend\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'getLogin'])->name('getLogin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'getRegister'])->name('getRegister');


// route cms
Route::prefix('admin')->middleware('auth.custom')->name('admin.')->group(function () {
     // Routes that require custom authentication middleware
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // perumahan
    Route::get('/perumahan', [PerumahanController::class, 'index'])->name('perumahan');
    Route::prefix('perumahan')->name('perumahan.')->group( function(){
        // CRUD PERUMAHAN
        Route::get('/form/{type}', [PerumahanController::class, 'form'])->name('form');
        Route::post('/create', [PerumahanController::class, 'store'])->name('store');
        Route::post('/update', [PerumahanController::class, 'update'])->name('update');
        Route::get('/delete', [PerumahanController::class, 'delete'])->name('delete');
        Route::get('/detail', [PerumahanController::class, 'detail'])->name('detail');
        Route::get('/detailJson', [PerumahanController::class, 'detailJson'])->name('detail.json');

        // CRUD BLOK PERUMAHAN
        Route::post('/create/block', [PerumahanController::class, 'storeBlock'])->name('store.block');
        Route::get('/detail/block', [PerumahanController::class, 'getDetail'])->name('detail.block');
        Route::post('/update/block', [PerumahanController::class, 'updateBlok'])->name('update.block');
    });


    // pemesanan
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan');
    Route::prefix('pemesanan')->name('pemesanan.')->group( function(){
        // CRUD PEMESANAN
        Route::post('/create', [PemesananController::class, 'store'])->name('store');
        Route::get('/detailJson', [PemesananController::class, 'detailJson'])->name('detail.json');
        Route::post('/update', [PemesananController::class, 'update'])->name('update');
    });


    // usermanagement
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('user.management');
    Route::prefix('user-management')->name('usermanagement.')->group( function(){
        // CRUD USER MANAGEMENT
        Route::post('/create', [UserManagementController::class, 'store'])->name('store');
        Route::get('/detailJson', [UserManagementController::class, 'detailJson'])->name('detail.json');
        Route::post('/update', [UserManagementController::class, 'update'])->name('update');
    });


    // logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::prefix('perumahan')->name('perumahan.')->group( function(){
    // CRUD PERUMAHAN
    Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');
});
