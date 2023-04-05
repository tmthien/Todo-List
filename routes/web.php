<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MyTaskController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('comment/add', [CommentController::class, 'add'])->name('comment.add');
Route::post('reply/store', [CommentController::class, 'reply'])->name('reply.add');

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);    
 
    Route::resource('users', UserController::class);
    
    Route::get('profile',[ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/{user}',[ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('mytask', [MyTaskController::class, 'index'])->name('mytask.index');
    Route::get('tasks/{$id}/downloadFile', [TaskController::class, 'downloadFile'])->name('downloadFile');
  });