<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TasksController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('login',[LoginController::class,'create'])->name('login');
Route::post('login',[LoginController::class,'store']);
Route::post('logout',[LoginController::class,'destroy'])->middleware('auth');

Route::resource('tasks',TasksController::class);


Route::middleware('auth')->group(function () {

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
                'createUser' => Auth::user()->can('create',User::class)
            ],
        ]);
    });

    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    })->middleware('can:create,App\Models\User');

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

});
