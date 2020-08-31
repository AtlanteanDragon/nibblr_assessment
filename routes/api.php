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

Route::get('/user', function (Request $request) {
        return $request->user();
});
Route::group(['middleware' => ['cors', 'json.response']], function () {
    //public routes
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
});
Route::middleware('auth:api')->group(function () {
    //protected routes
    Route::post('/edit', 'Auth\ApiAuthController@edit')->name('edit.api');
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    Route::get('/dinners/list', 'DinnerController@list')->name('dinner.list');
    Route::get('/dinners/get', 'DinnerController@get')->name('dinner.get');
    Route::get('/dinners/create', 'DinnerController@create')->name('dinner.create');
    Route::get('/dinners/join', 'DinnerController@join')->name('dinner.join');
    Route::get('/user/authenticated', function (Request $request){
        return true;
    });
});