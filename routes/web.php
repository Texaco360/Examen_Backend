<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TasksController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('login',[LoginController::class,'create'])->name('login')->middleware('guest');
Route::post('login',[LoginController::class,'store'])->middleware('guest');
Route::post('logout',[LoginController::class,'destroy'])->middleware('auth');
Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register',[RegisterController::class,'store'])->middleware('guest');

//tasks
Route::resource('tasks',TasksController::class)->except('index')->middleware('auth');
Route::get('tasks',[TasksController::class,'index']);

//Home
Route::get('/', function () {return Inertia::render('Home');});

//Admin
Route::resource('users',\App\Http\Controllers\UserController::class)->middleware('admin');





