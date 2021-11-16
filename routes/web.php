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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'Dashboard\DashboardController@index')->middleware('auth:admin')->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'namespace' => 'Dashboard', 'middleware' => 'auth:admin'], function () {
    Route::get('logout', 'LoginController@logout')->name('admin.logout');
    Route::resource('users', 'UserController');
    Route::get('userList', 'UserController@userList')->name('userList');
    Route::get('users/{user}/history', 'UserController@history')->name('userHistory');
    Route::get('historyList/{user}', 'UserController@historyList')->name('historyList');
    Route::get('payments', 'PaymentController@index')->name('payments.index');
    Route::get('activitiesList', 'DashboardController@activitiesList')->name('activiesList');

});

Route::group(['prefix' => 'admin', 'namespace' => 'Dashboard', 'middleware' => 'guest:admin'], function () {

    Route::get('login', 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@postLogin')->name('admin.postLogin');


});
