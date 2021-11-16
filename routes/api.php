<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Payment;
use App\Http\Resources\PaymentResource as PaymentResource;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'API'], function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');


});

Route::group(['middleware' => ['auth:sanctum'], 'namespace' => 'api'], function () {
    Route::get('/profile', 'UserController@profile');
    Route::get('/transactions', 'UserController@transactions');
    Route::get('/users', 'UserController@getUsers');
    Route::post('/payment', 'PaymentController@store');
});


