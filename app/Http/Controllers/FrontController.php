<?php

namespace App\Http\Controllers;

use App\Models\ApiKlaviya;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\UserValidate;

class FrontController extends Controller
{
    public function addUser(UserValidate $request, ApiKlaviya $apiKlaviya)
    {
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

    public function updateMembersToList(UserValidate $request, ApiKlaviya $apiKlaviya)
    {
        $user = User::findOrfail($request->id);

        $user->fill($request->all())->saveOrFail();

        $apiKlaviya->processUpdateMembersToList($request->all());

        return redirect(RouteServiceProvider::HOME);
    }

    public function getLists()
    {
        $users = User::all();

        return view('lists', ['users' => $users]);
    }
}
