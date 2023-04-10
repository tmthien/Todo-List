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

Route::post('comments', [CommentController::class, 'store'])->name('comments.create');

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);    
 
    Route::resource('users', UserController::class);
    
    Route::get('profile',[ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/{user}',[ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('mytasks', [MyTaskController::class, 'index'])->name('mytasks.index');
    Route::get('mytasks/{id}', [MyTaskController::class, 'show'])->name('mytasks.show');
    Route::put('mytasks/{id}', [MyTaskController::class, 'update'])->name('mytasks.update');
    Route::get('tasks/{id}/dowload_file', [TaskController::class, 'downloadFile'])->name('downloadFile');
  });
  