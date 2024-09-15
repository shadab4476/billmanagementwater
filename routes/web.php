<?php

use App\Livewire\Auth\Login;
use App\Livewire\Home;
use App\Livewire\Auth\Logout;
use App\Livewire\Auth\Register;
use App\Livewire\Test;
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
Route::get('/index', Home::class)->name('index');

Route::group(["middleware" => "guest"], function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});
Route::group(["middleware" => "auth"], function () {
    Route::post('/logout', Logout::class)->name('logout');
    Route::get('/create-shop', Logout::class)->name('create.shop');
});
