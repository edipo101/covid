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
Route::get('/preventivos/', 'PreventivoController@show_all')->name('preventivos.all');
Route::post('/preventivos/detalle', 'PreventivoController@view')->name('preventivos.view');
Route::post('/preventivos/busqueda', 'PreventivoController@search')->name('preventivos.search');
Route::get('/preventivos/create', 'PreventivoController@create')->name('preventivos.create');
Route::post('/preventivos', 'PreventivoController@store')->name('preventivos.store');
Route::get('/preventivos/edit/{id}', 'PreventivoController@edit')->name('preventivos.edit');
Route::patch('/preventivos/{id}', 'PreventivoController@update')->name('preventivos.update');

Route::get('/preventivos/men', 'PreventivoController@show_menores')->name('preventivos.men');
Route::get('/preventivos/dir', 'PreventivoController@show_mayores')->name('preventivos.dir');

Route::get('/compras_men', 'Prueba@compras_men');
Route::get('/ejec_presup', 'PreventivoController@rep_ejec_presup')->name('ejec_presup');

Route::get('/ubicaciones_men', 'ComboDatos@getUbicacionesMen')->name('ubicaciones_men');
Route::get('/ubicaciones_dir', 'ComboDatos@getUbicacionesDir')->name('ubicaciones_dir');
Route::get('/estados', 'ComboDatos@getEstados')->name('estados');
Route::get('/unidades', 'ComboDatos@getUnidades')->name('unidades');