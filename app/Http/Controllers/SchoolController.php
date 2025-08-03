<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Models\User;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
     public function create()
    {
        $users = User::all(); // Get all users
        return view('schools.create', compact('users'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'user_id' => 'required|exists:users,id', // Make sure user_id is validated
    ]);

    // Step 1: Create the school
    $school = School::create($request->only(['name', 'email', 'phone', 'address']));

    // Step 2: Update user's school_id
    $user = User::find($request->user_id);
    $user->school_id = $school->id;
    $user->save();

    // Step 3: Redirect with message
    return redirect('/dashboard')->with('success', 'School added and user updated successfully!');
}

}
