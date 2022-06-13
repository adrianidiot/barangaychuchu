<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-family', [App\Http\Controllers\Admin\Admin::class, 'addFamily'])->name('add.family');
Route::get('/add-resident', [App\Http\Controllers\Admin\Admin::class, 'addResident'])->name('add.resident');

// Route::post('/login', [App\Http\Controllers\Admin\admin::class, 'login'])->name('login');

