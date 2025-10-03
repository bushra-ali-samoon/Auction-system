<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form'); 
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form'); 
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::resource('auctions', AuctionController::class)->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});
 
Route::get('auctions/{auction}/bids/create', [BidController::class, 'create'])->name('bids.create')->middleware('auth');
Route::post('auctions/{auction}/bids', [BidController::class, 'store'])->name('bids.store')->middleware('auth');
