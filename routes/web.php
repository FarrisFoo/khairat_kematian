<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TuntutanController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LaporanController;

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
Route::middleware(['web'])->group(function () {

    Route::middleware(['IfAuthenticated'])->group(function () {
        /*
        * Login Function
        */
        Route::get('/', [LoginController::class, 'loginPage'])->name('login-page');

        Route::post('/login-process', [LoginController::class, 'login'])->name('login');

        Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

        /*
        * Register Function
        */
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register-page');

        Route::post('/register', [RegisterController::class, 'register'])->name('register');

        /*
        *  Homepage Function
        */


        // Route::get('/', [WebsiteController::class, 'index'])->name('website.index');
    });

    Route::middleware(['IsNotAuthenticated'])->group(function () {
        //dashboard middleware
        Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');

        Route::post('/members', [MemberController::class, 'store'])->name('members.store');

        Route::get('/members-listing', [MemberController::class, 'index'])->name('members.index');

        Route::get('/members/{member}', [MemberController::class, 'show'])->name('members.show');

        Route::put('/members/{member}/verify', [MemberController::class, 'verify'])->name('members.verify');

        /*
        * Payment Function
        */
        Route::get('/payment-methods', [PaymentController::class, 'showPaymentMethods'])->name('payment-methods');

        Route::post('/payment-methods', [PaymentController::class, 'storePayment'])->name('payment.store');

        /*
        * tuntutan Function
        */
        Route::get('/tuntutan/create', [TuntutanController::class, 'create'])->name('tuntutan.create');

        Route::post('/tuntutan', [TuntutanController::class, 'store'])->name('tuntutan.store');

        Route::get('/tuntutan-listing', [TuntutanController::class, 'index'])->name('tuntutan.index');

        Route::get('/tuntutan/{tuntutan}', [TuntutanController::class, 'show'])->name('tuntutan.show');

        Route::put('/tuntutan/{tuntutan}/approve', [TuntutanController::class, 'approve'])->name('tuntutan.approve');

        Route::put('/tuntutan/{tuntutan}/reject', [TuntutanController::class, 'reject'])->name('tuntutan.reject');

        /*
        * Notifikasi Function
        */
        Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifications.index');

        Route::get('/notifikasi/create', [NotificationController::class, 'create'])->name('notifications.create');

        Route::post('/notifikasi/store', [NotificationController::class, 'store'])->name('notifications.store');

        Route::get('/notifikasi/show/{notifikasi}', [NotificationController::class, 'show'])->name('notifications.show');

        /*
        * Laporan Function
        */
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

        Route::get('/laporan/ahli', [LaporanController::class, 'ahli'])->name('laporan.ahli');

        Route::get('/laporan/dana-masuk', [LaporanController::class, 'danaMasuk'])->name('laporan.dana-masuk');

        Route::get('/laporan/dana-keluar', [LaporanController::class, 'danaKeluar'])->name('laporan.dana-keluar');

    });
});
