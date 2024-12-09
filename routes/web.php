<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\administrador;
use App\Http\Controllers\admin\DashBoardController;



//Route::middleware()

Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__.'/admin.php';
require __DIR__.'/supervisior.php';
require __DIR__.'/auth.php';
require __DIR__.'/user.php';
