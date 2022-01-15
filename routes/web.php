<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TaskController;


Route::get('/', [TaskController::class,'index'])->name('home');

//dashboard
// route::view('dashboard','logindashboard');
route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
route::post('dashboard',[AdminController::class,'loginPanel']);
route::post('addEmployee',[AdminController::class,'addEmployee']);
route::post('show/{id}',[AdminController::class,'show']);
route::post('edit/{id}',[AdminController::class,'update']);
route::post('delete/{id}',[AdminController::class,'delete']);
Route::get('views', function () {
    return view('views');
});

// order
Route::get('tasks', [TaskController::class,'tasks'])->name('tasks');
Route::post('store', [TaskController::class,'store']);
route::post('deleteorder/{id}',[TaskController::class,'destroy']);