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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function(){
	return 'okey makey';
});
Route::get('/show', 'Prueba@show');
Route::get('/compras_men', 'Prueba@compras_men');
Route::get('/reporte', 'Prueba@reporte');
