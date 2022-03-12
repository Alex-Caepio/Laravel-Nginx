<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\UpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('/users', [IndexController::class, 'index']);
Route::get('users/{user}', [IndexController::class, 'person'])->middleware(['auth:api']);
Route::post('/users', [LoginController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/resetPassword', [ChangePasswordController::class, 'resetPassword']);

Route::post('/send', [ResetController::class, 'sendEmail']);

Route::patch('/users/{user}', [UpdateController::class, 'update'])->middleware(['auth:api']);
