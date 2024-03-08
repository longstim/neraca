<?php

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


Route::get('/', 'IndexController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/adminlte', function () {
    return view('admin/adminlte');
});

//Pemasukan
Route::middleware(['auth', 'role:admin'])->prefix('pemasukan')->group(function () {
    Route::get('index', 'PemasukanController@index');
    Route::get('daftar-pemasukan', 'PemasukanController@daftarpemasukan');
    Route::get('tambah-pemasukan-rutin', 'PemasukanController@tambahpemasukanrutin');
    Route::post('proses-tambah-pemasukan-rutin', 'PemasukanController@prosestambahpemasukanrutin');
    Route::get('ubah-pemasukan-rutin/{id_pemasukan}', 'PemasukanController@ubahpemasukanrutin');
    Route::post('proses-ubah-pemasukan-rutin', 'PemasukanController@prosesubahpemasukanrutin'); 
    Route::get('hapus-pemasukan-rutin/{id_pemasukan}', 'PemasukanController@hapuspemasukanrutin');
});

//Pemasukan
Route::middleware(['auth', 'role:admin'])->prefix('pengeluaran')->group(function () {
    Route::get('daftar-pengeluaran', 'PengeluaranController@daftarpengeluaran');
    Route::get('tambah-pengeluaran', 'PengeluaranController@tambahpengeluaran');
    Route::post('proses-tambah-pengeluaran', 'PengeluaranController@prosestambahpengeluaran');
    Route::get('ubah-pengeluaran/{id_pengeluaran}', 'PengeluaranController@ubahpengeluaran');
    Route::post('proses-ubah-pengeluaran', 'PengeluaranController@prosesubahpengeluaran'); 
    Route::get('hapus-pengeluaran/{id_pengeluaran}', 'PengeluaranController@hapuspengeluaran');
});

//Profil
Route::get('profil', 'ProfilController@index');
Route::post('proses-ubah-profil', 'ProfilController@prosesubahprofil');
Route::post('proses-ubah-password', 'ProfilController@prosesubahpassword');


//Pengaturan
Route::get('role', 'PengaturanController@daftarrole');
Route::get('permission', 'PengaturanController@daftarpermission');
Route::get('tambahpermission', 'PengaturanController@tambahpermission');
Route::post('prosestambahpermission', 'PengaturanController@prosestambahpermission');
Route::get('user', 'PengaturanController@daftaruser');
Route::get('ubahuser/{id_user}','PengaturanController@ubahuser');
Route::post('prosesubahuser','PengaturanController@prosesubahuser');