<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;

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
// Route::get('/', [AnggotaController::class,'index']);
Route::resource('/anggota',AnggotaController::class)->middleware('auth');

Route::get('/dashboard',function(){
    $active = 'dashboard';
    $title = 'Dashboard';
    return view('index',compact('active','title'));
});
