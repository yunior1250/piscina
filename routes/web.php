<?php

use App\Http\Controllers\AmbienteController;
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

Route::get('/', function () {
	return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\PiscinaController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SucursalController;

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

/* sucursal  */
Route::get('/sucursales', [SucursalController::class, 'index'])->name('sucursales.index');
Route::get('/sucursales/create', [SucursalController::class, 'create'])->name('sucursales.create');
Route::post('/sucursales', [SucursalController::class, 'store'])->name('sucursales.store');

Route::get('/sucursales/{id}/edit', [SucursalController::class, 'edit'])->name('sucursales.edit');
Route::put('/sucursales/{id}', [SucursalController::class, 'update'])->name('sucursales.update');
Route::delete('/sucursales/{id}', [SucursalController::class, 'destroy'])->name('sucursales.destroy');



/* 
ambiente  */
Route::get('/ambientes', [AmbienteController::class, 'index'])->name('ambientes.index');
Route::get('/ambientes/create', [AmbienteController::class, 'create'])->name('ambientes.create');
Route::post('/ambientes', [AmbienteController::class, 'store'])->name('ambientes.store');

Route::get('/ambientes/{id}/edit', [AmbienteController::class, 'edit'])->name('ambientes.edit');
Route::put('/ambientes/{id}', [AmbienteController::class, 'update'])->name('ambientes.update');
Route::delete('/ambientes/{id}', [AmbienteController::class, 'destroy'])->name('ambientes.destroy');



/* piscinas  */
Route::get('/piscinas', [PiscinaController::class, 'index'])->name('piscinas.index');
Route::get('/piscinas/create', [PiscinaController::class, 'create'])->name('piscinas.create');
Route::post('/piscinas', [PiscinaController::class, 'store'])->name('piscinas.store');


/* Reserva  */
Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('reservas.update');
Route::delete('/reservas/{id}', [ReservaController::class, 'destroy'])->name('reservas.destroy');

/* 
Procesos  */
Route::get('/procesos', [ProcesoController::class, 'index'])->name('procesos.index');
Route::get('/procesos/create', [ProcesoController::class, 'create'])->name('procesos.create');
Route::post('/procesos', [ProcesoController::class, 'store'])->name('procesos.store');

/*otro mame de todos modos otro mame */

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


