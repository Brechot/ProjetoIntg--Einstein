<?php

use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/alterar-senha/{email}',[App\Http\Controllers\Auth\LoginController::class, 'alterarSenhaIndex'])->name('password.index');
Route::post('/changePassword',[App\Http\Controllers\Auth\LoginController::class, 'alterarSenha'])->name('password.alter');

// Registrar usuários
//Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//Route::post('register', [RegisterController::class, 'register']);

// Redefinir senha
//Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
//Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
//Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

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
Route::resource('reserve', \App\Http\Controllers\admin\ReserveController::class, ['except' => ['create','store', 'update', 'destroy']]);
Route::get('reserve/create/{laboratory}', [\App\Http\Controllers\admin\ReserveController::class, 'create'])->name('reserve.create');
Route::get('approve', [\App\Http\Controllers\admin\ReserveController::class, 'approve'])->name('reserve.approve');

// software
Route::resource('software', \App\Http\Controllers\admin\SoftwareController::class, ['except' => ['store', 'update', 'destroy']]);

});


