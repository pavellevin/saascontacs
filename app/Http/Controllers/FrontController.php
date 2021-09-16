<?php

namespace App\Http\Controllers;

use App\Models\ApiKlaviya;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class FrontController extends Controller
{
    public function addUser(Request $request, ApiKlaviya $apiKlaviya)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'min:11', 'unique:users'],
        ]);

        if ($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make(rand(1, 10)),
        ])
        )
            $apiKlaviya->processAddMembersToList($request->all());

        return redirect(RouteServiceProvider::HOME);
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('edit_user', ['user' => $user]);
    }

    public function updateMembersToList(Request $request, ApiKlaviya $apiKlaviya)
    {
//        $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'phone' => ['required', 'numeric', 'min:11', 'unique:users'],
//        ]);
//
//        $user = User::findOrfail($request->id);
//        $user->fill($request->all())->saveOrFail();

        $apiKlaviya->processUpdateMembersToList($request->all());

        return redirect(RouteServiceProvider::HOME);
    }

    public function getLists()
    {
        $users = User::all();
        return view('lists', ['users' => $users]);
    }
}
