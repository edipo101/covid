<?php

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

Route::get('/', function(){
	return 'okey makey';
});
Route::get('/preventivos', 'PreventivoController@show_all')->name('preventivos.all');
Route::get('/preventivos/detalle/{id}', 'PreventivoController@details')->name('preventivos.details');
Route::post('/preventivos/busqueda', 'PreventivoController@search')->name('preventivos.search');

Route::get('/compras_men', 'Prueba@compras_men');
Route::get('/reporte', 'PreventivoController@reporte')->name('reporte');
