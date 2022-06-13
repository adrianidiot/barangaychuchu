<?php

use Illuminate\Support\Facades\Route;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/add-family', [App\Http\Controllers\Admin\Admin::class, 'addFamily'])->name('add.family');
    Route::get('/add-resident', [App\Http\Controllers\Admin\Admin::class, 'addResident'])->name('add.resident');
    Route::post('/store-resident', [App\Http\Controllers\Admin\Admin::class, 'storeResident'])->name('store.resident');
});

// Route::post('/login', [App\Http\Controllers\Admin\admin::class, 'login'])->name('login');

