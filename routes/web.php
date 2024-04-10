<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layouts.app');
})->name('main');

Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::post('login',[LoginController::class,'store'])->name('login.store');
Route::get('admin.view', function () {
    return view('admin.index');
})->name('admin.view');
Route::get('logout',[LogoutController::class,'logout'])->name('logout');
Route::get('admin/register', function () {
    return view('admin.register');
})->name('admin.register');
Route::post('admin/register',[RegisterController::class,'store'])->name('register.store');