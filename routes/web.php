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
    return view('auth/login');
});
Auth::routes();
Route::get('rekap/export_excel', 'RekapController@export_excel')->name('rekap.export');
Route::get('sebaran/export_excel', 'SebaranController@export_excel')->name('sebaran.export');
Route::get('sebaran/export_excel/prodi', 'SebaranController@export_excel_prodi')->name('sebaran.export.prodi');
Route::get('/export', 'RekapController@export')->name('.export');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('sebaran/tambah_form1', 'SebaranController@kurikulum_2019_ganjil')->name('sebaran.kurikulum_2019_ganjil');
Route::get('sebaran/tambah_form2', 'SebaranController@kurikulum_2019_genap')->name('sebaran.kurikulum_2019_genap');
Route::get('sebaran/tambah_form3', 'SebaranController@kurikulum_2014_ganjil')->name('sebaran.kurikulum_2014_ganjil');
Route::get('sebaran/tambah_form4', 'SebaranController@kurikulum_2014_genap')->name('sebaran.kurikulum_2014_genap');



// AJAX REQUEST
Route::get('rekap/get_dosen', 'RekapController@ajax_dosen')->name('rekap.ajax_dosen');
Route::get('sebaran/get_data', 'SebaranController@ajax_create')->name('sebaran.ajax_create');
Route::get('sebaran/get_kelas', 'SebaranController@pilih_kelas')->name('sebaran.pilih_kelas');
// Route::get('sebaran/send-form', 'SebaranController@send_form')->name('sebaran.send_form');

//  SEBARAN
Route::get('sebaran/kurikulum_2019_ganjil', 'SebaranController@create_kur2019_ganjil')->name('sebaran.create_kur2019_ganjil');
Route::get('sebaran/kurikulum_2019_genap', 'SebaranController@create_kur2019_genap')->name('sebaran.create_kur2019_genap');
Route::get('sebaran/kurikulum_2014_ganjil', 'SebaranController@create_kur2014_ganjil')->name('sebaran.create_kur2014_ganjil');
Route::get('sebaran/kurikulum_2014_genap', 'SebaranController@create_kur2014_genap')->name('sebaran.create_kur2014_genap');
Route::get('sebaran/{id}/approve','SebaranController@approve')->name('sebaran.approve');
Route::resource('sebaran', 'SebaranController');

Route::get('sebaran/cari', 'SebaranController@ajax_select')->name('sebaran.ajax_select');
Route::get('sebaran/cetak_pdf', 'SebaranController@cetak_pdf')->name('cetak_pdf');
Route::get('sebaran/sebaran_pdf', 'SebaranController@sebaran_pdf')->name('sebaran_pdf');



//USERS
Route::resource('users', 'UserController');

//DOSEN
Route::resource('dosen', 'DosenController'); 
Route::get('dosen/export_excel', 'DosenController@export_excel')->name('exportdosen');

//KURIKULUM
Route::resource('kurikulum', 'KurikulumController'); 

//MATKUL
Route::resource('matkul', 'MatkulController'); 
Route::get('sebaran/cari_matkul', 'SebaranController@ajax_select_matkul')->name('sebaran.ajax_select_matkul');
Route::get('sebaran/cari_matkul_edit', 'SebaranController@ajax_select_matkul_edit')->name('sebaran.ajax_select_matkul_edit');

// PRODI
Route::resource('prodi', 'ProdiController'); 

//REKAP
Route::resource('rekap', 'RekapController');

// KELAS
Route::resource('kelas', 'KelasController'); 


// Route::get('kelas', 'KelasController@index')->name('kelas.index');
// Route::get('kelas/create', 'KelasController@create')->name('kelas.create');
// Route::post('kelas/store', 'KelasController@store')->name('kelas.store');
// Route::get('kelas/edit/{id}', 'KelasController@edit')->name('kelas.edit');
// Route::get('kelas/delete/{id}', 'KelasController@destroy')->name('kelas.destroy');
// Route::post('kelas/update/{id}', 'KelasController@update')->name('kelas.update');





