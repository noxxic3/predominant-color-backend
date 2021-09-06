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

//Route::get('images', 'App\Http\Controllers\ColorController@index');
Route::post('images', 'App\Http\Controllers\ColorController@store');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
