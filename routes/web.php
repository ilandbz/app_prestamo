<?php

use App\Http\Controllers\CajaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('usuarios', UsuarioController::class)->middleware(['auth', 'verified']);
Route::resource('prestamos', PrestamoController::class)->middleware(['auth', 'verified']);
Route::resource('clientes', ClienteController::class)->middleware(['auth', 'verified']);
Route::resource('gastos', GastoController::class)->middleware(['auth', 'verified']);


Route::get('/pagos', [PagoController::class, 'index'])->middleware(['auth', 'verified'])->name('pagos.index');
Route::get('/pagos/create/{prestamo}', [PagoController::class, 'create'])->middleware(['auth', 'verified'])->name('pagos.create');
Route::post('/pagos/store', [PagoController::class, 'store'])->name('pagos.store');
Route::post('/pagos/destroy', [PagoController::class, 'store'])->name('pagos.destroy');
Route::post('/usuarios/cargarlista', [UsuarioController::class, 'cargarlista'])->name('usuarios.cargarlista');

Route::get('/caja', [CajaController::class, 'index'])->middleware(['auth', 'verified'])->name('caja.index');
Route::post('/caja/store', [PagoController::class, 'store'])->middleware(['auth', 'verified'])->name('caja.store');
Route::get('/caja/show', [CajaController::class, 'show'])->middleware(['auth', 'verified'])->name('caja.show');
Route::delete('/caja/{caja}', [CajaController::class, 'destroy'])->middleware(['auth', 'verified'])->name('caja.destroy');
Route::post('/caja/update', [CajaController::class, 'store'])->middleware(['auth', 'verified'])->name('caja.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
