<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ProductController;

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

Route::get('/class', [ClassController::class, 'get']);

Route::get('/class/{id}', [ClassController::class, 'getById']);

Route::get('/test', function (){
    for ($i = 0; $i < 10; $i++)
    {
        $class = \App\Models\ClassModel::create([
            'name' => fake()->name,
            'description' => fake()->text(300)
        ]);

        for ($j = 0; $j < 10; $j++)
        {
            $user = App\Models\User::create([
                'name' => fake()->name,
                'email' => fake()->email(),
                'password' => \Illuminate\Support\Facades\Hash::make('12345678')
            ]);

            DB::table('class_user')->insert([
                'user_id' => $user->id,
                'class_id' => $class->id
            ]);
        }
    }
});
