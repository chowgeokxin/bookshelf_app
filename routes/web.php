<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\BookShelfController::class, 'index'])->name('bookshelf.index');
    Route::post('new', [App\Http\Controllers\BookShelfController::class, 'store'])->name('bookshelf.store');
    Route::get('new', [App\Http\Controllers\BookShelfController::class, 'create'])->name('bookshelf.create');
    Route::get('book/{id}', [App\Http\Controllers\BookShelfController::class, 'show'])->name('bookshelf.show');
    Route::put('book/{id}', [App\Http\Controllers\BookShelfController::class, 'update'])->name('bookshelf.update');
    Route::delete('book/{id}', [App\Http\Controllers\BookShelfController::class, 'delete'])->name('bookshelf.delete');

    Route::match(['get', 'post'], 'get', [App\Http\Controllers\BookShelfController::class, 'get']);
});