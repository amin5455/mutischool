<?php

namespace App\Http\Controllers;
use App\Models\School;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
     public function create()
    {
        return view('schools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        School::create($request->all());

        return redirect('/dashboard')->with('success', 'School added successfully!');
    }
}
