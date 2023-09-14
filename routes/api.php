<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\User\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//-----------------------------------------------------------------------------------------
//Admin
Route::prefix('admin')->group(function(){
    Route::post('login', [AdminAuthController::class,'login']);
    Route::post('refresh',[AdminAuthController::class,'refresh'] );
    Route::post('me', [AdminAuthController::class,'me']);
    Route::apiResource('post', PostController::class);
    // Route::get('post', [PostController::class,'index']);

});
//-----------------------------------------------------------------------------------------
//User
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('refresh',[AuthController::class,'refresh'] );
    Route::post('me', [AuthController::class,'me']);

});
