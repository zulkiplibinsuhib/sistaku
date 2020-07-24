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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('sebaran/cari', 'SebaranController@ajax_select')->name('sebaran.ajax_select');
Route::get('sebaran/cari_matkul', 'SebaranController@ajax_select_matkul')->name('sebaran.ajax_select_matkul');
Route::get('sebaran/cari_matkul_edit', 'SebaranController@ajax_select_matkul_edit')->name('sebaran.ajax_select_matkul_edit');

Route::resource('dosen', 'DosenController'); 
Route::resource('matkul', 'MatkulController'); 
Route::resource('prodi', 'ProdiController'); 
Route::resource('kelas', 'KelasController'); 
Route::resource('sebaran', 'SebaranController'); 
Route::get('sebaran/{id}/approve','SebaranController@approve')->name('sebaran.approve');





