<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ErrorLogController;
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

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('me', [AuthController::class, 'me'])->name('me');

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('user/{id}/set-menu', [UserController::class, 'setMenu'])->name('user.setMenu');

    Route::get('menu', [MenuController::class, 'index'])->name('menu.index');

    Route::get('activity', [ActivityController::class, 'index'])->name('activity.index');

    Route::get('error-log', [ErrorLogController::class, 'index'])->name('error.index');
});
