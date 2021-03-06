<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('users', 'UserController')->except('update');
Route::post('users/{user}', 'UserController@update')->name('users.update');
Route::post('users/rut/store/validate', 'UserController@validateStoreRut');
Route::post('users/rut/update/validate/{user}', 'UserController@validateUpdateRut');
