<?php

use App\Http\Controllers\DressController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\DesignerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('dresses', DressController::class);
Route::resource('types', TypeController::class);
Route::resource('designers', DesignerController::class);
Route::resource('users', UserController::class);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


 Route::get('dresses/designer/{id}',[DressController::class,'getByDesigner']);

 Route::get('dresses/type/{id}',[DressController::class,'getByType']);


 Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::get('my-dresses',[DressController::class,'myDresses']);

    Route::get('/logout',[AuthController::class,'logout']);

    Route::resource('dresses',DressController::class)->only('store','update','destroy');

});