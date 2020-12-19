<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserManagement extends Controller
{

    public function index()
    {
        $users = User::paginate(15);
        return view('UserManagement.index')->with('users', $users);
    }

    public function show(User $user)
    {
        return view('UserManagement.show')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
        $validationR = $request->validate([
            'name' => 'string|max:50',
            'email' => 'bail|email|unique:App\Models\User,email',
            'mobile' => 'integer',
            'password' => 'password',
            'activation' => 'boolean'
        ]);
        $user->update($validationR);
        return redirect()->route('UserManagement.show', ['UserManagement' => $user->id])
            ->with('user', $user);
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('UserManagement.index')->with('status', "$user->name deleted");
    }
}
