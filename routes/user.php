<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UsersController;

Route::middleware('user')->group(function () {
   Route::get('/emp', [UsersController::class, 'index'])->name('emp.dashboard');
   Route::get('/show-tasks/{id}', [UsersController::class, 'showTasks'])->name('emp.show.tasks');
   Route::post('store-task-time', [UsersController::class, 'storeTaskTime'])->name('emp.store.task.time');
});
