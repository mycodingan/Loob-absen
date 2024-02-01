<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenController;

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

Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');
Route::post('/absen', [AbsenController::class, 'store'])->name('absen.store');
Route::get('/absen/{id}/edit', [AbsenController::class, 'edit'])->name('absen.edit');
Route::put('/absen/{id}', [AbsenController::class, 'update'])->name('absen.update');
Route::delete('/absen/{id}', [AbsenController::class, 'destroy'])->name('absen.destroy');
Route::put('/absen/{absen}', 'AbsenController@update');

