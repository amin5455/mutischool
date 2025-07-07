<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
{
    // Admins can see all users
    $users = User::with('school')->where('id', '!=', Auth::id())->get();

    return view('users.index', compact('users'));
}

    public function create()
{
    return view('users.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:teacher,student',
        'school_id' => 'required|exists:schools,id',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'school_id' => $request->school_id,
    ]);

    return redirect('/dashboard')->with('success', 'User created!');
}

}
