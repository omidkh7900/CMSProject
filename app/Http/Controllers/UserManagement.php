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

    public function show(User $UserManagement)
    {
        return view('UserManagement.show')->with('user', $UserManagement);
    }

    public function update(Request $request, User $UserManagement)
    {
        $validationR = $request->validate([
            'name' => 'string|max:50',
            'email' => 'bail|email|unique:App\Models\User,email',
            'mobile' => 'integer',
            'password' => 'password',
            'activation' => 'boolean'
        ]);
        $UserManagement->update($validationR);
        return redirect()->route('UserManagement.show', ['UserManagement' => $UserManagement->id])->with('user', $UserManagement);
    }

    public function delete(User $UserManagement)
    {
        $UserManagement->delete();
        return redirect()->route('UserManagement.index')->with('status', "$UserManagement->name deleted");
    }
}
