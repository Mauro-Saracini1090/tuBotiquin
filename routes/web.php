<?php

use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
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

Auth::routes();
Route::get('register/farmaceutico', [RegisterController::class,'showRegisFarmaceuticoForm'])->name('farmaceutico');
Route::post('register/farmaceutico', [RegisterController::class,'registroFarmaceutico'])->name('registroFarmaceutico');



Route::resource('usuario', UsuarioController::class);
Route::resource('roles', RolesController::class);
Route::resource('permisos', PermisosController::class);