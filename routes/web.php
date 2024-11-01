<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeaderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::resource('/headers', HeaderController::class)->names('header');

Route::get('/get-headers-data',[HeaderController::class,'getHeaderData'])->name('get-header-data');
