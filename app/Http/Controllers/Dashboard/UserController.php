<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(){
        return view('dashboard.user.create');
    }
    public function edit(User $id){
        return view('dashboard.user.edit', [
            'user' => $id
        ]);
    }
    public function store(UserRequest $request)
    {
        User::create($request->validated() + [
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }
    public function update(UserRequest $request, User $id)
    {
        $id->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? Hash::make($request->password) : $id->password,
        ]);

        return redirect()->route('dashboard')->with('success', 'User updated successfully.');
    }
    public function destroy(User $id){
        $id->delete();

        return redirect()->route('dashboard')->with([
            'success' => 'User berhasil dihapus'
        ]);
    }
}
