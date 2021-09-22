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

Route::middleware(['auth'])->group(function () {
    Route::view('/add-user', 'add_user');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/lists', [\App\Http\Controllers\FrontController::class, 'getLists'])->name('getLists');
    Route::get('/edit-user/{id}', [\App\Http\Controllers\FrontController::class, 'editUser'])->name('editUser');
    Route::get('import-view', [\App\Http\Controllers\ImportController::class, 'importView']);
    Route::post('import', [\App\Http\Controllers\ImportController::class, 'import'])->name('import');
});

require __DIR__ . '/auth.php';
