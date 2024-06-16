<?php

use App\Http\Controllers\EntryController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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
    return view('home.home');
});

Route::get('/publicaciones', [EntryController::class, 'ViewEntrys'])->name('publicaciones');
Route::get('/publicaciones/{id}', [EntryController::class, 'DetailEntry'])->name('publicaciones.detalle');
Route::get('/publicaciones/categoria/{id}', [EntryController::class, 'filterByCategory'])->name('publicaciones.categoria');
Route::post('/publicaciones/{id}/intereses', [FavoriteController::class, 'add'])->name('publicaciones.favorita');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
