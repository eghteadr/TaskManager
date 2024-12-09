<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ProjectController;

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');

    Route::prefix('project')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('project.index');
        Route::post('/store', [ProjectController::class, 'store'])->name('project.store');
        Route::get('/edit/{project}', [ProjectController::class, 'edit'])->name('project.edit');
        Route::post('/update/{project}', [ProjectController::class, 'update'])->name('project.update');
        Route::post('/destroy/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');
    });

    Route::prefix('team')->group(function () {
        Route::post('/store-team', [TeamController::class, 'store'])->name('team.store');
        Route::get('/create-team/{id}', [TeamController::class, 'index'])->name('team.create');
        Route::post('/destroy-user-from-team/{id}', [TeamController::class, 'destroy'])->name('team.destroyfromteam');
    });

    Route::get('/users-create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/user-store', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/user-destroy/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

});
