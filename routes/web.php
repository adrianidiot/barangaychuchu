<?php

use Illuminate\Support\Facades\Route;

if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/add-family/{id}', [App\Http\Controllers\Admin\Admin::class, 'addFamily'])->name('add.family');
    Route::get('/add-new-resident', [App\Http\Controllers\Admin\Admin::class, 'addNewResident'])->name('add.new.resident');
    Route::get('/add-resident-existing-family', [App\Http\Controllers\Admin\Admin::class, 'addResidentExistingFamily'])->name('add.existing.resident');
    Route::post('/store-resident', [App\Http\Controllers\Admin\Admin::class, 'storeResident'])->name('store.resident');

    // category
    Route::get('/all-residents', [App\Http\Controllers\Admin\Admin::class, 'allResidents'])->name('show.all-residents');
    Route::get('/working', [App\Http\Controllers\Admin\Admin::class, 'working'])->name('show.working');
    Route::get('/none-working', [App\Http\Controllers\Admin\Admin::class, 'NonWorking'])->name('show.nonWorking');
    // Route::get('/pwd', [App\Http\Controllers\Admin\Admin::class, 'pwd'])->name('show.pwd');
    Route::get('/senior-citizen', [App\Http\Controllers\Admin\Admin::class, 'seniorCitizen'])->name('show.senior-citizen');
    Route::get('/minors', [App\Http\Controllers\Admin\Admin::class, 'minors'])->name('show.minors');
    // Route::get('/4ps', [App\Http\Controllers\Admin\Admin::class, 'Fourpis'])->name('show.4pis');

    Route::get('/delete-residents/{id}', [App\Http\Controllers\Admin\Admin::class, 'deleteResidents'])->name('admin.delete.resident');
    Route::post('/update-data', [App\Http\Controllers\Admin\Admin::class, 'updateResident']);
});


