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
    $request->validate(['name' => 'required']);
    
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
