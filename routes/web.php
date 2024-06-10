<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotteryTicketController;
use App\Http\Controllers\SorterController;

//Vista principal
Route::get('/', function () {
    return view('welcome');
})->name('main');
//Vista Iniciar Sesion
Route::get('login', function () {
    return view('auth.login');
})->name('login');
//Vista Controlador de Iniciar Sesion
Route::post('login',[LoginController::class,'store'])->name('login.store');



//Vista Controlador Salir de la sesion
Route::get('logout',[LogoutController::class,'logout'])->name('logout');



//Controlador Busqueda
Route::get('/search',[AdminController::class,'search'])->name('search.admin');


Route::middleware('auth')->group(function(){
    //Vista Admin Principal
    Route::get('admin.view',[AdminController::class,'index'])->name('admin.view');
    //Vista Registrar sorteador
    Route::get('admin/register', function () {
        return view('admin.register');
    })->name('admin.register');
    //Vista Controlador Registrar
    Route::post('admin/register',[RegisterController::class,'store'])->name('register.store');
    Route::post('admin/edit/{id}',[AdminController::class,'changeStat'])->name('admin.change');
    Route::get('sorter.view',[SorterController::class,'index'])->name('sorter.view');
    Route::post('/sorter-register',[SorterController::class,'registerRaffle'])->name('sorter.register');
});

//Vista Comprar Ticket
//Route::get('/buy-ticket', [LotteryTicketController::class, 'showForm'])->name('buy-ticket-form');
//Vista Controlador Comprar Ticket
Route::get('/buyTicket', [LotteryTicketController::class, 'showForm'])->name('buyTicket');
Route::post('/buyTicket',[LotteryTicketController::class,'store'])->name('buyTicket.store');
