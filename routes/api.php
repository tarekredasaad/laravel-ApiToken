<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
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
// EmployeeController::class;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post( '/register' , 'App\Http\Controllers\AuthController@register');
Route::post( '/login' , 'App\Http\Controllers\AuthController@login');

Route::group(['middleware' =>["auth:sanctum"]],function(){

    Route::resources([
        '/employee' => 'App\Http\Controllers\EmployeeController'
    ]);
    Route::post( '/logout' , 'App\Http\Controllers\AuthController@logout');

});
