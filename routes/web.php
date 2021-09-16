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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/add-user', function () {
    return view('add_user');
})->middleware(['auth']);

Route::get('/lists', [\App\Http\Controllers\FrontController::class, 'getLists'])->middleware(['auth'])->name('getLists');

Route::get('/edit-user/{id}', [\App\Http\Controllers\FrontController::class, 'editUser'])->middleware(['auth'])->name('editUser');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
