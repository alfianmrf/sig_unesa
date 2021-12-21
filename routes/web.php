<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;

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

Route::get('/', [MapController::class, 'index'])->name('index');

Route::get('/resultKampus', [MapController::class, 'resultKampus'])->name('resultKampus');
Route::post('/resultKampusFilter', [MapController::class, 'resultKampusFilter'])->name('resultKampusFilter');
Route::get('/resultFakultas', [MapController::class, 'resultFakultas'])->name('resultFakultas');
Route::post('/resultFakultasFilter', [MapController::class, 'resultFakultasFilter'])->name('resultFakultasFilter');
Route::get('/resultJurusan', [MapController::class, 'resultJurusan'])->name('resultJurusan');
Route::post('/resultJurusanFilter', [MapController::class, 'resultJurusanFilter'])->name('resultJurusanFilter');
Route::get('/resultGedung', [MapController::class, 'resultGedung'])->name('resultGedung');
Route::post('/resultGedungFilter', [MapController::class, 'resultGedungFilter'])->name('resultGedungFilter');
Route::get('/resultProdi', [MapController::class, 'resultProdi'])->name('resultProdi');
Route::post('/resultProdiFilter', [MapController::class, 'resultProdiFilter'])->name('resultProdiFilter');
Route::get('/centerGedung', [MapController::class, 'centerGedung'])->name('centerGedung');