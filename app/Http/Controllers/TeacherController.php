<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Auth;

class TeacherController extends Controller
{
    public function index()
{
    return view('teachers.index');
}

public function fetch()
{
    $teachers = Teacher::where('school_id', Auth::user()->school_id)->latest()->get();
    return response()->json(['teachers' => $teachers]);
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
    ]);

    // Check if teacher exists in this school (by name)
    $exists = Teacher::where('school_id', Auth::user()->school_id)
        ->where('name', $request->name)
        ->exists();

    if ($exists) {
        return response()->json([
            'error' => 'A teacher with this name already exists in your school.'
        ], 422);
    }

    Teacher::create([
        'school_id' => Auth::user()->school_id,
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
    ]);

    return response()->json(['status' => 'Teacher added successfully']);
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
    ]);

    // Check if another teacher in the same school has the same name
    $exists = Teacher::where('school_id', Auth::user()->school_id)
        ->where('name', $request->name)
        ->where('id', '!=', $id) // exclude current record
        ->exists();

    if ($exists) {
        return response()->json([
            'error' => 'A teacher with this name already exists in your school.'
        ], 422);
    }

    $teacher = Teacher::findOrFail($id);

    $teacher->update([
        'school_id' => Auth::user()->school_id,
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
    ]);

    return response()->json(['status' => 'Teacher updated successfully']);
}


public function destroy($id)
{
    Teacher::findOrFail($id)->delete();
    return response()->json(['status' => 'Teacher deleted successfully']);
}
}
