<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\PasswordResetRequestController;

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


Route::post('/users', [LoginController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot', [ForgotController::class, 'forgot']);
//Route::post('/reset', [ForgotController::class, 'reset']);
Route::post('/reset', [PasswordResetRequestController::class, 'sendEmail']);
Route::post('/resetPassword', [ChangePasswordController::class, 'passwordResetProcess']);
