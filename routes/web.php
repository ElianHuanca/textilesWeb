<?php

use App\Http\Controllers\AlmacenesController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\TelasController;
use App\Http\Controllers\TipoGastosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

/* //--------------------------------------CASO DE USO USUARIOS
Route::get('/users', [UserController::class, 'index'])->name('users.index');//VISTA PRINCIPAL CU1 USUARIO
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');//VISTA PARA CREAR USUARIO
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');//VISTA PRINCIPAL Eliminar
Route::post('/users', [UserController::class, 'store'])->name('users.store'); //Esto es para guardar
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');//Bista para editar Usuario
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');//Esto es para actualizar
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------CASO DE USO PRODUCTOS
Route::get('/telas', [TelaController::class, 'index'])->name('telas.index');//VISTA PRINCIPAL CU2 PRODUCTO
Route::get('/telas/create', [TelaController::class, 'create'])->name('telas.create');//VISTA PARA CREAR PRODUCTO
Route::delete('/telas/{tela}', [TelaController::class, 'destroy'])->name('telas.destroy');//VISTA PRINCIPAL Eliminar
Route::post('/telas', [TelaController::class, 'store'])->name('telas.store'); //Esto es para guardar
Route::get('/telas/{tela}/edit', [TelaController::class, 'edit'])->name('telas.edit');//Bista para editar Producto
Route::put('/telas/{tela}', [TelaController::class, 'update'])->name('telas.update');//Esto es para actualizar
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//--------------------------------------CASO DE USO SUCURSALES
Route::get('/sucursales', [SucursalController::class, 'index'])->name('sucursales.index');//VISTA PRINCIPAL CU3 SUCURSALES
Route::get('/sucursales/create', [SucursalController::class, 'create'])->name('sucursales.create');//VISTA PARA CREAR SUCURSALES
Route::delete('/sucursales/{sucursal}', [SucursalController::class, 'destroy'])->name('sucursales.destroy');//VISTA PRINCIPAL Eliminar
Route::post('/sucursales', [SucursalController::class, 'store'])->name('sucursales.store'); //Esto es para guardar
Route::get('/sucursales/{sucursal}/edit', [SucursalController::class, 'edit'])->name('sucursales.edit');//Bista para editar Sucursal
Route::put('/sucursales/{sucursal}', [SucursalController::class, 'update'])->name('sucursales.update');//Esto es para actualizar */
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::resource('users', UserController::class)->names('users');
Route::resource('almacenes',AlmacenesController::class)->names('almacenes');
Route::resource('sucursales',SucursalesController::class)->names('sucursales');
Route::resource('telas', TelasController::class)->names('telas');
Route::resource('proveedores', ProveedoresController::class)->names('proveedores');
Route::resource('tipogastos', TipoGastosController::class)->names('tipogastos');
Route::resource('ventas', VentasController::class)->names('ventas');
Route::resource('compras', ComprasController::class)->names('compras');

Route::get('gastos/create/{idcompra}', [GastosController::class, 'create'])->name('gastos.create');