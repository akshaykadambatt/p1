<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('welcome');});
Route::post('/register', [AuthController::class, 'register']);

Route::get('/home', function () {
    return view('home/home');
})->name('home');

Route::post('/getPosts', [HomeController::class, 'textPost']);
Route::post('/storeTextPost', [HomeController::class, 'storeTextPost']);
