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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('dosen', 'DosenController'); 
Route::resource('matkul', 'MatkulController'); 
Route::resource('prodi', 'ProdiController'); 
Route::resource('kelas', 'KelasController'); 
Route::resource('sebaran', 'SebaranController'); 
Route::get('sebaran/{id}/approve','SebaranController@approve')->name('sebaran.approve');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('sebaran/cari', 'SebaranController@ajax_select')->name('sebaran.ajax_select');


