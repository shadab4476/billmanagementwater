<?php

use App\Livewire\Auth\Login;
use App\Livewire\Home;
use App\Livewire\Auth\Logout;
use App\Livewire\Auth\Register;
use App\Livewire\Maintenance\MaintenanceData;
use App\Livewire\Maintenance\MaintenanceIndex;
use App\Livewire\Shop\ShopIndex;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Route;

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

Route::get('/', Home::class)->name('home');
Route::get('/home', Home::class)->name('home');
Route::get('/index', Home::class)->name('home');
// maintenance
Route::group(["middleware" => "guest"], function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});
Route::group(["middleware" => "auth"], function () {
    Route::post('/logout', Logout::class)->name('logout');
    // routes of shop 
    Route::get('/shops', ShopIndex::class)->name('index.shop');

    // only superAdmin or admin
    Route::group(["middleware" => ["role:superAdmin"]], function () {
        Route::get('/maintenance/index', MaintenanceIndex::class)->name('all.maintenance');
        Route::get('/maintenance', MaintenanceData::class)->name('index.maintenance');
    });
    Route::group(["middleware" => ["role:superAdmin|admin"]], function () {
        // user rotues
        Route::get('/users', UserIndex::class)->name('index.user');
        Route::post('/active', UserIndex::class)->name('active.user');
    });
});
