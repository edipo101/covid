<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', 'DashboardController@show')->name('dashboard');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login.form');

Route::get('/preventivos/', 'PreventivoController@show_all')->name('preventivos.all');
Route::post('/preventivos/detalle', 'PreventivoController@view')->name('preventivos.view');
Route::post('/preventivos/busqueda', 'PreventivoController@search')->name('preventivos.search');
Route::get('/preventivos/create', 'PreventivoController@create')->name('preventivos.create');
Route::post('/preventivos', 'PreventivoController@store')->name('preventivos.store');
Route::get('/preventivos/edit/{id}', 'PreventivoController@edit')->name('preventivos.edit');
Route::patch('/preventivos/{id}', 'PreventivoController@update')->name('preventivos.update');
Route::get('/preventivos/secretarias', 'PreventivoController@by_secretarias')->name('preventivos.secretarias');
Route::get('/preventivos/personal', 'PreventivoController@personal')->name('preventivos.personal');
Route::get('/preventivos/liberados', 'PreventivoController@by_liberados')->name('preventivos.liberados');
Route::get('/preventivos/men', 'PreventivoController@show_menores')->name('preventivos.men');
Route::get('/preventivos/dir', 'PreventivoController@show_mayores')->name('preventivos.dir');
Route::post('/preventivos/destroy', 'PreventivoController@destroy')->name('preventivos.destroy');

Route::get('/partidas/presupuesto', 'ReporteController@show_presupuesto')->name('partidas.presupuesto');

Route::get('/ejec_presup', 'PreventivoController@rep_ejec_presup')->name('ejec_presup');
Route::get('/desembolsos', 'ReporteController@show_desembolsos')->name('desembolsos');

Route::get('/ubicaciones_men', 'ComboDatos@getUbicacionesMen')->name('ubicaciones_men');
Route::get('/ubicaciones_dir', 'ComboDatos@getUbicacionesDir')->name('ubicaciones_dir');
Route::get('/estados', 'ComboDatos@getEstados')->name('estados');
Route::get('/unidades', 'ComboDatos@getUnidades')->name('unidades');

// Descarga de archivos
Route::get('/pdf', 'PDFController@pdf')->name('download');
Route::get('/pdf_menores', 'PDFController@pdf_menores')->name('download.menores');
Route::get('/pdf_mayores', 'PDFController@pdf_mayores')->name('download.mayores');
Route::get('/pdf_secretarias', 'PDFController@pdf_secretarias')->name('download.secretarias');
Route::get('/pdf_presupuesto', 'PDFController@pdf_presupuesto')->name('download.presupuesto');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.show');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('usuarios', 'UsuarioController');
Route::patch('usuarios/password/{usuario}', 'UsuarioController@update_password')->name('usuarios.update_password');
Route::patch('usuarios/avatar/{usuario}', 'UsuarioController@update_avatar')->name('usuarios.update_avatar');