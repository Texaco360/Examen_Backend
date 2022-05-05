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

//Route::post('register', function () {
//    $data = Request::validate([
//        'name' => 'required',
//        'email' => ['required', 'email'],
//        'password' => 'required',
//    ]);
//    dd($data);
//
//    User::create($data);
//    return redirect('/users');
//
//});

Route::resource('tasks',TasksController::class);




    Route::get('/', function () {
        return Inertia::render('Home');
    });

    Route::get('/users', function () {
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user() ? Auth::user()->can('create',User::class) : false,
            ],
        ]);
    });

    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    })->middleware('admin');

    Route::post('/users', function () {
        $data = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        User::create($data);
        return redirect('/users');

    });

    Route::get('/settings', function () {
        return Inertia::render('Settings');
    });


