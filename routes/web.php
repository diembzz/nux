<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LinksController;

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

Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/home', [LinksController::class, 'home'])->name('home');
Route::get('/link/{key}', [LinksController::class, 'link'])->name('links.link');
Route::get('/link/{key}/regenerate', [LinksController::class, 'regenerate'])->name('links.regenerate');
Route::get('/link/{key}/deactivate', [LinksController::class, 'deactivate'])->name('links.deactivate');
