<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/departments', App\Http\Controllers\DepartmentController::class)->middleware('auth');
Route::resource('/employees', App\Http\Controllers\EmployeeController::class)->middleware('auth');
Route::resource('/profile', App\Http\Controllers\UserController::class)->middleware('auth');
