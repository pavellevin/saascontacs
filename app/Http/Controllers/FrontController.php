<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class FrontController extends Controller
{
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(rand(1,10)),
        ]);

//        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
