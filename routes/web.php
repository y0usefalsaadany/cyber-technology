<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SessionController;



Route::get('/', [TaskController::class,'index'])->name('home');

// dashboard
route::get('loginAdmin',[SessionController::class,'loginPanel']);
route::post('loginPanel',[AdminController::class,'loginPanel'])->name('loginPanel');
route::get('admin-panel',[SessionController::class,'dashboard'])->name("dashboard");
route::post('dashboard',[AdminController::class,'loginPanel']);
route::get('logout',[SessionController::class,'deleteSession']);

// crud
route::post('addEmployee',[AdminController::class,'addEmployee']);
route::post('show/{id}',[AdminController::class,'show']);
route::post('edit/{id}',[AdminController::class,'update']);
route::post('delete/{id}',[AdminController::class,'delete']);
Route::get('views', function () {
    if (session()->has('loginId')){
        return view('views');
    }else{
        return view("logindashboard");
    }
});

// order
Route::get('tasks', [TaskController::class,'tasks'])->name('tasks');
Route::post('store', [TaskController::class,'store']);
route::post('deleteorder/{id}',[TaskController::class,'destroy']);