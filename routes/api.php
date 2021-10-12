<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\UserotpController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('sendotp' ,[UserotpController::class, 'sendotp']);
Route::post('verifiyotp' ,[UserotpController::class, 'verificationotp']);
Route::post('singup' ,[UserotpController::class, 'singup']);
Route::put('profileedit/{id}' ,[UserotpController::class, 'profileedit']);

