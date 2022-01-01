<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportpdfController;

// use Alert;
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
    return view('index');
});

Route::get('/login',[LoginController::class,'loginIndex'])->name('login');
Route::post('/login',[LoginController::class,'loginAuth']);

Route::get('/register',[LoginController::class,'registerIndex'])->name('register');
Route::post('/register',[LoginController::class,'registerStore']);

Route::get('logout',[LoginController::class, 'logOut']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'info']);
    //anggota
    Route::resource('/anggota',AnggotaController::class);
    
    //kasin
    Route::resource('/kas', KasController::class);
    Route::post('/kas/{id}', [KasController::class,'editkas']);
    
    //kasout
    Route::post('/pengeluaran/{id}',[KasController::class,'pengeluaran']);
    Route::put('/pengeluaran/{id}',[KasController::class,'editpengeluaran']);
    Route::delete('/pengeluaran/{id}',[KasController::class, 'dellkas']);
    
    //profile
    Route::get('/profil', [ProfilController::class, 'profil']);
    
    //export PDF
    Route::get('/exportpdfanggota',[ExportpdfController::class,'exportpdfanggota']);
    Route::post('/exportpdfkasout',[ExportpdfController::class,'exportpdfkasout']);
    Route::get('/exportpdfkasin',[ExportpdfController::class,'exportpdfkasin']);
    Route::post('/exportpdfkasincustom/{id}',[ExportpdfController::class,'exportpdfkasincustom']);
});
