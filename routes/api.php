<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/register1', App\Http\Controllers\Api\RegisterController::class)->name('register1');

Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

Route::get('level', [App\Http\Controllers\Api\LevelController::class, 'index']);
Route::post('level', [App\Http\Controllers\Api\LevelController::class, 'store']);
Route::get('level/{level}', [App\Http\Controllers\Api\LevelController::class, 'show']);
Route::put('level/{level}', [App\Http\Controllers\Api\LevelController::class, 'update']);
Route::delete('level/{level}', [App\Http\Controllers\Api\LevelController::class, 'destroy']);


Route::get('user', [App\Http\Controllers\Api\UserController::class, 'index']);
Route::post('user', [App\Http\Controllers\Api\UserController::class, 'store']);
Route::get('users/{user}', [App\Http\Controllers\Api\UserController::class, 'show']);
Route::put('users/{user}', [App\Http\Controllers\Api\UserController::class, 'update']);
Route::delete('users/{user}', [App\Http\Controllers\Api\UserController::class, 'destroy']);

Route::get('kategori', [App\Http\Controllers\Api\KategoriController::class, 'index']);
Route::post('kategori', [App\Http\Controllers\Api\KategoriController::class, 'store']);
Route::get('kategori/{kategori}', [App\Http\Controllers\Api\KategoriController::class, 'show']);
Route::put('kategori/{kategori}', [App\Http\Controllers\Api\KategoriController::class, 'update']);
Route::delete('kategori/{kategori}', [App\Http\Controllers\Api\KategoriController::class, 'destroy']);

Route::get('barang', [App\Http\Controllers\Api\BarangController::class, 'index']);
Route::post('barang', [App\Http\Controllers\Api\BarangController::class, 'store']);
Route::get('barang/{barang}', [App\Http\Controllers\Api\BarangController::class, 'show']);
Route::put('barang/{barang}', [App\Http\Controllers\Api\BarangController::class, 'update']);
Route::delete('barang/{barang}', [App\Http\Controllers\Api\BarangController::class, 'destroy']);
