<?php

use App\Http\Controllers\Admin\CatagoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\User\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\BookController;

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
    Route::apiResource('catagory', CatagoryController::class);

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
    Route::apiResource('comment', CommentController::class);
    Route::get('comment', [CommentController::class,'index']);
    Route::apiResource('book', BookController::class);
});
