<?php

use App\Livewire\Auth\Login;
use App\Livewire\Home;
use App\Livewire\Auth\Logout;
use App\Livewire\Auth\Register;
use App\Livewire\Bill\BillIndex;
use App\Livewire\Shop\ShopCreate;
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

Route::group(["middleware" => "guest"], function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});
Route::group(["middleware" => "auth"], function () {
    Route::post('/logout', Logout::class)->name('logout');
    // routes of shop 
    Route::get('/shops', ShopIndex::class)->name('index.shop');

    // only admin
    Route::group(["middleware" => "role:admin"], function () {
        // user rotues
        Route::get('/users', UserIndex::class)->name('index.user');
        Route::get('/bills', BillIndex::class)->name('index.bill');
        Route::post('/active', UserIndex::class)->name('active.user');
    });
});
