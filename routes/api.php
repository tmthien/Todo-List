<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;


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
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);
});
Route::group(['prefix' => 'task'], function(){
    Route::get('/index', [TaskController::class, 'index']);
    Route::post('/create', [TaskController::class, 'store']);
    Route::get('/show/{id}', [TaskController::class, 'show']);
    Route::put('/update/{id}', [TaskController::class, 'update']);
    Route::delete('/delete/{id}',[TaskController::class, 'destroy']);
});

Route::get('/users/index', [UserController::class, 'index']);
Route::get('/users/show/{id}', [UserController::class, 'show']);

