<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/user')->group(function () {

        Route::post('/logout',[AuthController::class , 'logout']);
    });


    Route::prefix('/post')->group(function () {

        Route::post('/add',[PostController::class, 'add']);

        Route::post('/update-by-id/{id}',[PostController::class, 'update_by_id']);

        Route::delete('/delete-by-id/{id}',[PostController::class, 'delete_by_id']);

        Route::post('/published-by-id/{id}',[PostController::class, 'published_by_id']);

        Route::post('/unpublished-by-id/{id}',[PostController::class, 'unpublished_by_id']);

        Route::get('/get-all',[PostController::class, 'get_all']);


        Route::get('/user/get-all-by-user-id',[PostController::class, 'get_all_by_user_id']);
    });

});

Route::prefix('/user')->group(function () {



    Route::post('/register',[AuthController ::class , 'register']);

    Route::post('/login',[AuthController::class , 'login']);
});
