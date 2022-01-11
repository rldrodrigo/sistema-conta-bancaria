<?php

use App\Http\Controllers\ContasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
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

Route::get('/', [HomeController::class])->name('home');

Route::post('painel', [UsuarioController::class, 'login'])->name('usuarios.login');
Route::get('home', [HomeController::class, 'voltar'])->name('home');

Route::get('/registrar', [HomeController::class, 'registrar'])->name('registrar');

Route::post('/registrar', [UsuarioController::class, 'insert'])->name('usuarios.insert');

Route::get('painel/depositar', [ContasController::class, 'depositar'])->name('depositar');
Route::post('painel/depositar', [ContasController::class, 'executarDeposito'])->name('executar.deposito');
Route::get('painel/sacar', [ContasController::class, 'sacar'])->name('sacar');
Route::post('painel/sacar', [ContasController::class, 'executarSaque'])->name('executar.saque');
Route::get('painel/transferir', [ContasController::class, 'transferir'])->name('transferir');
Route::post('painel/transferir', [ContasController::class, 'executarTransferencia'])->name('executar.transferencia');

Route::get('painel/transacoes', [ContasController::class, 'exibirTransacoes'])->name('transacoes');
Route::get('painel/grafico', [ContasController::class, 'exibirGrafico'])->name('grafico');

Route::get('/', [UsuarioController::class, 'logout'])->name('usuarios.logout');
