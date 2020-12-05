<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\MarcaMedicamentoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\ObraSocialController;
use App\Http\Controllers\TipoMedicamentoController;
use App\Models\MarcaMedicamento;
use App\Models\TipoMedicamento;

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

Route::get('/',  [HomeController::class,'index'])->name('home');

Route::get('/administrador', function () {
    return view('admin.administrador');
})->name('homeAdministrador')->middleware('roles:es-administrador');

Auth::routes();
Route::post('login',  [LoginController::class,'loginPersonalizado']);
Route::get('register/farmaceutico', [RegisterController::class,'showRegisFarmaceuticoForm'])->name('farmaceutico');
Route::post('register/farmaceutico', [RegisterController::class,'registroFarmaceutico'])->name('registroFarmaceutico');



Route::resource('farmacia', FarmaciaController::class)->middleware('roles:es-administrador');
Route::delete('borrarFarmacia/{farmacia}', [FarmaciaController::class,'borrarFarmacias'])->middleware('roles:es-administrador');
Route::post('almacenarFarmacia', [FarmaciaController::class,'almacenarFarmaciasAdmin'])->name('almacenarFarmaciaAdmin')->middleware('roles:es-administrador');
Route::post('solicitudFarmacia', [FarmaciaController::class,'solicitudFarmacia'])->name('solicitudFarmacia')->middleware('roles:es-administrador');

Route::get('farmacias', [FarmaciaController::class,'listarFarmacias'])->name('farmacias');
Route::post('farmaciasucursal', [SucursalController::class,'farmaciaSucursal'])->name('farmaciaSucursal');
Route::get('verfarmacia',[FarmaciaController::class,'verFarmacia'])->middleware('roles:es-farmaceutico')->name('verfarmacia');
Route::post('buscarfarmaciasucursal/', [SucursalController::class,'buscarFarmaciaSucursal'])->name('buscarFarmaciaSucursal');
//Al usar el middleware RolMiddleware podemos enviar mas de un rol, pero debemos cambiar ('roles:esAdmin') o por (roles:slug_rol) siendo slug_rol el valor del atributo de la Base de Datos 
// porque antes estabamos usando gates , pero a las gates no le podemos pasar mas de un ROL al mismo tiempo en las rutas
// Esto es solo para las rutas, en las vistas seguimos usando gates y para definir varias gates en la vista
// hacemos @canany(['nombreGate1','nombreGate2']) .... @endcanany
Route::resource('usuario', UsuarioController::class)->middleware('roles:es-administrador');
Route::get('usuario/{usuario}/rolypermisos',[UsuarioController::class,'usuarioRolesyPermisos'])->name('usuario.rolpermisos')->middleware('roles:es-administrador');
Route::post('usuario/rolypermisos',[UsuarioController::class,'almacenarRolesyPermisos'])->name('usuario.almacenarrolpermisos')->middleware('roles:es-administrador');
Route::resource('roles', RolesController::class)->middleware('roles:es-administrador');
Route::resource('permisos', PermisosController::class)->middleware('roles:es-administrador');
Route::resource('localidad', LocalidadController::class)->middleware('roles:es-administrador');
Route::get('farmacias', [FarmaciaController::class,'listarFarmacias'])->name('farmacias');
Route::post('solicitudUsuario', [UsuarioController::class,'solicitudUsuario'])->name('solicitudUsuario')->middleware('roles:es-administrador');


Route::resource('turno', TurnoController::class)->middleware('roles:es-administrador');
Route::resource('sucursal', SucursalController::class)->middleware('roles:es-farmaceutico,es-administrador');
Route::delete('borrarSucursal/{sucursal}', [SucursalController::class,'borrarSucursal'])->middleware('roles:es-administrador');
Route::post('solicitudSucursal', [SucursalController::class,'solicitudSucursal'])->name('solicitudSucursal')->middleware('roles:es-administrador');
Route::get('panelFarmaceutico', [SucursalController::class,'panelFarmaceutico'])->name('panel.farmaceutico')->middleware('roles:es-farmaceutico');


Route::resource('obrasocial', ObraSocialController::class)->middleware('roles:es-farmaceutico,es-administrador');
Route::get('obrasocialfarmacia', [ObraSocialController::class, 'listarObraSocialFarmacia'])->middleware('roles:es-administrador')->name('obrasocialfarmacia');
Route::post('obrasocialfarmacia', [ObraSocialController::class, 'agregarObraSocialFarmacia'])->middleware('roles:es-administrador')->name('agregarobrasocialfarmacia');

Route::post('sucursalturnohoy', [HomeController::class,'verSucursalTurnoHoy'])->name('verSucursalTurnoHoy');
Route::get('turnossiguientes', [HomeController::class,'verSucursalesProximasTurno'])->name('verTurnosSiguientes');

//Mi perfil Farmacuetico
Route::get('vermiperfil', [UsuarioController::class, 'verMiPerfilFarmaceutico'])->middleware('roles:es-farmaceutico')->name('miPerfilFarmacuetico');
Route::get('subirfotoperfil', [UsuarioController::class, 'subirFotoPerfil'])->middleware('roles:es-farmaceutico')->name('subirFotoPerfil');
Route::post('subirfotoperfil/cargada', [UsuarioController::class, 'cargarFotoPerfil'])->middleware('roles:es-farmaceutico')->name('cargarFotoPerfil');
Route::get('editarperfil', [UsuarioController::class, 'editarPerfil'])->middleware('roles:es-farmaceutico')->name('editarPerfil');
Route::patch('editarperfil/actualizar/{usuario}', [UsuarioController::class, 'actualizarPerfil'])->middleware('roles:es-farmaceutico')->name('actualizarPerfil');

//E-mail contacto
Route::get('emailcontacto', [HomeController::class,'emailContacto'])->name('emailcontacto'); 
Route::post('enviarconsulta', [HomeController::class,'enviarEmailContacto'])->name('enviarEmailContacto');

Route::resource('tipoMedicamentos',TipoMedicamentoController::class)->middleware('roles:es-administrador');
Route::resource('marcaMedicamentos',MarcaMedicamentoController::class)->middleware('roles:es-administrador');
Route::resource('medicamentos',MedicamentoController::class)->middleware('roles:es-administrador');
Route::get('cargarMedicamento/{sucursal}/cargarStock',[SucursalController::class,'cargarStockMedicamento'])->middleware('roles:es-farmaceutico')->name('medicamentos.cargar');
Route::patch('almacenarStockMedicamento/{sucursal}',[SucursalController::class,'almacenarStockMedicamento'])->middleware('roles:es-farmaceutico')->name('medicamentos.almacenar');
Route::get('listado/{farmacia}/medicamentos',[SucursalController::class,'verMedicamentosFarmacia'])->middleware('roles:es-registrado')->name('listado.medicamentos');
Route::delete('borrarStockSucursal/{sucursal}/{medicamento}',[SucursalController::class,'borrarStockSucursal'])->middleware('roles:es-farmaceutico')->name('stocksucursal.borrar');

//Contactar Al Admin
Route::get('contactaradministrador', [SucursalController::class,'contactarAdmin'])->middleware('roles:es-farmaceutico')->name('contactarAdmin');
Route::post('enviarmailadministrador', [SucursalController::class,'enviarEmailAdministrador'])->middleware('roles:es-farmaceutico')->name('enviarEmailAdministrador');
