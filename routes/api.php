<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MyTaskController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($route) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
});


Route::group(['middleware' => 'auth:api','prefix' => 'tasks'], function(){
    Route::get('index', [TaskController::class, 'index']);
    Route::get('show/{id}', [TaskController::class, 'show']);
    Route::group(['middleware'=>'checkrole'], function(){
        Route::delete('delete/{id}',[TaskController::class, 'destroy']);
        Route::post('create', [TaskController::class, 'store']);
        Route::put('update/{id}', [TaskController::class, 'update']);
    });
});
Route::group(['middleware' => 'auth:api', 'prefix' => 'users'], function(){
    Route::get('index', [UserController::class, 'index']);
    Route::get('show/{id}', [UserController::class, 'show']);
    Route::put('update/{id}', [UserController::class, 'updateStatus'])->middleware('checkrole');
});

Route::group(['middleware' => 'auth:api','prefix' => 'mytasks'], function(){
    Route::get('index', [MyTaskController::class, 'index']);
    Route::get('show/{id}', [MyTaskController::class, 'show']);
    Route::put('update/{id}', [MyTaskController::class, 'update']);
});
