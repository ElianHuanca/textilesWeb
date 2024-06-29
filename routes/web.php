<?php

use App\Http\Controllers\AlmacenesController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\ReporEstadisController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\TelasController;
use App\Http\Controllers\TipoGastosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('auth.login');

// Protege las rutas de usuarios con el permiso `users.index`
Route::middleware(['auth', 'can:users.index'])->group(function () {
    Route::resource('users', UserController::class)->names('users');
});
Route::middleware(['auth', 'can:almacenes.index'])->group(function () {
    Route::resource('almacenes', AlmacenesController::class)->names('almacenes');
});
Route::resource('users', UserController::class)->names('users');
Route::resource('almacenes',AlmacenesController::class)->names('almacenes');
Route::resource('sucursales',SucursalesController::class)->names('sucursales');
Route::resource('telas', TelasController::class)->names('telas');
Route::resource('proveedores', ProveedoresController::class)->names('proveedores');
Route::resource('tipogastos', TipoGastosController::class)->names('tipogastos');
Route::resource('ventas', VentasController::class)->names('ventas');
Route::resource('compras', ComprasController::class)->names('compras');
Route::resource('roles', RoleController::class)->names('roles');

Route::get('ganancias-sucusal', [ReporEstadisController::class ,'Ganancias_Sucursal']);
Route::get('ganancias-sucusal-tela', [ReporEstadisController::class, 'Ganancias_Sucursal_Telas']);
Route::get('ganancias-telas', [ReporEstadisController::class, 'Ganancias_Telas']);
Route::get('ganancias-telas-2', [ReporEstadisController::class, 'Ganancias_Telas_2']);

Route::get('gastos/create/{idcompra}', [GastosController::class, 'create'])->name('gastos.create');


