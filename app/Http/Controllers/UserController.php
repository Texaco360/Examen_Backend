<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    //
    public function index(Request $request){

        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name
                ]),
            'filters' => $request->only(['search']),
            'can' => [
                'createUser' => Auth::user() ? Auth::user()->can('create',User::class) : false,
            ],
        ]);
    }

    public function create(){
        return Inertia::render('Users/Create');
    }

    public function store(){
        $data = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        User::create($data);
        return redirect('/users');
    }
}
