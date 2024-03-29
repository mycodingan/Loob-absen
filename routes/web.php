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

Route::post('/absens/search', [AbsenController::class, 'search'])->name('absen.search');
// Route::resource('absen', AbsenController::class)->except(['update']);
Route::get('/absen/count-by-date', [AbsenController::class, 'countValuesByDate'])->name('absen.count_by_date');
Route::post('absen/import', [AbsenController::class, 'import'])->name('absen.import');
Route::get('absen/export', [AbsenController::class, 'export'])->name('absen.export');
Route::get('/absen', [AbsenController::class, 'index'])->name('absen.index');
Route::post('/absen', [AbsenController::class, 'store'])->name('absen.store');
Route::get('/absen/{id}/edit', [AbsenController::class, 'edit'])->name('absen.edit');
Route::get('/absen/{absen}', [AbsenController::class, 'show'])->name('absen.show');
Route::put('/absen/{absen}', [AbsenController::class, 'update'])->name('absen.update');
Route::delete('/absen/{absen}', [AbsenController::class, 'destroy'])->name('absen.destroy');
