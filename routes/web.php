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

// AJAX REQUEST
// Route::get('sebaran/send-form', 'SebaranController@send_form')->name('sebaran.send_form');

Route::get('sebaran/get_data', 'SebaranController@ajax_create')->name('sebaran.ajax_create');
Route::get('sebaran/cari', 'SebaranController@ajax_select')->name('sebaran.ajax_select');

Route::get('sebaran/cari_matkul', 'SebaranController@ajax_select_matkul')->name('sebaran.ajax_select_matkul');
Route::get('sebaran/cari_matkul_edit', 'SebaranController@ajax_select_matkul_edit')->name('sebaran.ajax_select_matkul_edit');

Route::resource('users', 'UserController');
Route::resource('dosen', 'DosenController'); 
Route::get('dosen/export_excel', 'DosenController@export_excel')->name('exportdosen');;
Route::resource('matkul', 'MatkulController'); 
Route::resource('prodi', 'ProdiController'); 
Route::resource('sebaran', 'SebaranController');



// APPROVE SEBARAN
Route::get('sebaran/{id}/approve','SebaranController@approve')->name('sebaran.approve');


// KELAS
Route::resource('kelas', 'KelasController'); 


// Route::get('kelas', 'KelasController@index')->name('kelas.index');
// Route::get('kelas/create', 'KelasController@create')->name('kelas.create');
// Route::post('kelas/store', 'KelasController@store')->name('kelas.store');
// Route::get('kelas/edit/{id}', 'KelasController@edit')->name('kelas.edit');
// Route::get('kelas/delete/{id}', 'KelasController@destroy')->name('kelas.destroy');
// Route::post('kelas/update/{id}', 'KelasController@update')->name('kelas.update');





