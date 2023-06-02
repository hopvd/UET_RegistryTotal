<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// vehicle
Route::controller(VehicleController::class)->group(function () {
    Route::get('/vehicles', 'index')->name('vehicle.index');
    Route::get('/vehicle/{id}', 'show')->name('vehicle.show');
    Route::post('/vehicle', 'store')->name('vehicle.store');
    Route::put('/vehicle/{id}', 'update')->name('vehicle.update');
    Route::delete('/vehicle/{id}', 'destroy')->name('vehicle.destroy');
});

//Route::middleware('auth:api')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users','index')->name('user.index');
        Route::get('/user/{id}','show');
        Route::post('/user','login')->name('user.login');
        //    Route::put('/users/{id}', 'ApiController@updateUser');
        //    Route::delete('/users/{id}', 'ApiController@deleteUser');
    });
//});

// owner
Route::controller(OwnerController::class)->group(function () {
    Route::get('/owners', 'index')->name('owner.index');
    Route::get('/owner/{id}', 'show')->name('owner.show');
    Route::post('/owner', 'store')->name('owner.store');
    Route::put('/owner/{id}', 'update')->name('owner.update');
    Route::delete('/owner/{id}', 'destroy')->name('owner.destroy');
});

//certification
Route::controller(\App\Http\Controllers\CertificateController::class)->group(function () {
    Route::get('/certificates', 'index')->name('certificate.index');
    Route::get('/certificate/{id}', 'show')->name('certificate.show');
    Route::post('/certificate', 'store')->name('certificate.store');
    Route::put('/certificate/{id}', 'update')->name('certificate.update');
    Route::delete('/certificate/{id}', 'destroy')->name('certificate.destroy');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

