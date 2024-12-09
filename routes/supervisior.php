<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Supervisior\DashboardController;
use App\Http\Controllers\ProjectController;
Route::prefix('supervisor')
    ->middleware('supervisior')
    ->group(function () {
        Route::get('/supervisior-dashboard', [DashboardController::class, 'index'])->name('supervisor.dashboard');
        Route::get('/show-project/{id}', [DashboardController::class, 'showProject'])->name('project.show');
        Route::post('/task-store', [TaskController::class, 'store'])->name('tasks.store');
        Route::post('/task-update/{id}', [TaskController::class, 'update'])->name('tasks.update');
        Route::post('/task-destroy/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/show-task/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    });
