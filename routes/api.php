<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

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

Route::group([
    'middleware' => 'auth:admin'
], function(){
    Route::post('/product', [ProductController::class, 'store'])->middleware('auth:admin');
    Route::put('/product/{id}', [ProductController::class, 'updateById']);
    Route::delete('/product/{id}', [ProductController::class, 'deleteById']);
});

Route::get('/product', [ProductController::class, 'get']);
Route::get('/product/{id}', [ProductController::class, 'getById']);

Route::post('/admin/login', [AdminController::class, 'login']);