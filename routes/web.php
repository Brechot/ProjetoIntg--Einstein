<?php

use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Auth;
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
Route::redirect('/', '/login');

Auth::routes(['verify' => false]);

Route::group(['prefix' => 'einstein', 'as' => 'einstein.', 'middleware' => ['auth'/*, 'verified'*/]], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Roles
Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

// Users
Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

// discipline
Route::resource('discipline', \App\Http\Controllers\admin\DisciplineController::class, ['except' => ['store', 'update', 'destroy']]);

// laboratory
Route::resource('laboratory', \App\Http\Controllers\admin\LaboratoryController::class, ['except' => ['store', 'update', 'destroy']]);

// reserve
Route::resource('reserve', \App\Http\Controllers\admin\ReserveController::class, ['except' => ['store', 'update', 'destroy']]);

// software
Route::resource('software', \App\Http\Controllers\admin\SoftwareController::class, ['except' => ['store', 'update', 'destroy']]);

});


