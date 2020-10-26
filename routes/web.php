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
Route::post('/preventivos/detalle', 'PreventivoController@view')->name('preventivos.view');
Route::post('/preventivos/busqueda', 'PreventivoController@search')->name('preventivos.search');
Route::get('/preventivos/edit/{id}', 'PreventivoController@edit')->name('preventivos.edit');
Route::patch('/preventivos/{id}', 'PreventivoController@update')->name('preventivos.update');

Route::get('/compras_men', 'Prueba@compras_men');
Route::get('/ejec_presup', 'PreventivoController@rep_ejec_presup')->name('ejec_presup');
