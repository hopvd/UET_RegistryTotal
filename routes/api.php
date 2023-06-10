<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\VehicleController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/change-pass', [AuthController::class, 'changePassWord']);
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/vehicles', [VehicleController::class, 'index']);
    Route::get('/vehicle/{id}', [VehicleController::class, 'show']);
    Route::post('/vehicle', [VehicleController::class, 'store']);
    Route::put('/vehicle/{id}', [VehicleController::class, 'update']);
    Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/owners', [OwnerController::class, 'index']);
    Route::get('/owner/{id}', [OwnerController::class, 'show']);
    Route::post('/owner', [OwnerController::class, 'store']);
    Route::put('/owner/{id}', [OwnerController::class, 'update']);
    Route::delete('/owner/{id}', [OwnerController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/certificates', [CertificateController::class, 'index']);
    Route::post('/certificate/getlist', [CertificateController::class, 'getList']);
    Route::get('/certificate/{id}', [CertificateController::class, 'show']);
    Route::post('/certificate', [CertificateController::class, 'store']);
    Route::put('/certificate/{id}', [CertificateController::class, 'update']);
    Route::delete('/certificate/{id}', [CertificateController::class, 'destroy']);
});


