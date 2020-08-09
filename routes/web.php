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
Route::get('/', function(){return redirect('admin');});

// Auth::routes();


Route::prefix('admin')->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users','UserController');
    Route::resource('especialidades','EspecialidadController');
    Route::resource('medicos','MedicoController');
    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('user/profile','UserController@getProfile')->name('users.profile');
    Route::get('user/changepassword','UserController@getChangePassword')->name('users.changepassword');
    Route::put('user/postchangepassword','UserController@postChangePassword')->name('users.postchangepassword');
    Route::get('user/changeprofile','UserController@getChangeProfile')->name('users.changeprofile');
    Route::put('user/postchangeprofile','UserController@postChangeProfile')->name('users.postchangeprofile');
    Route::get('user/changeinfomedic','UserController@getChangeInfoMedic')->name('users.changeinfomedic');
    Route::put('user/postchangeinfomedic','UserController@postChangeInfoMedic')->name('users.postchangeinfomedic');
});

Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
