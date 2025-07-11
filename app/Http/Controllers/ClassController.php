<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
        public function index()
    {
        $classes = SchoolClass::where('school_id', Auth::user()->school_id)->get();
        return view('classes.index', compact('classes'));
    }

    public function store(Request $request)
    {
        
         $request->validate([
        'name' => 'required|string|max:255|unique:school_classes,name,NULL,id,school_id,' . auth()->user()->school_id,
    ]);


    SchoolClass::create($request->only('name', 'school_id'));

    $classes = SchoolClass::where('school_id', $request->school_id)->get();
    $table = view('classes.table', compact('classes'))->render();

    return response()->json(['success' => true, 'table' => $table]);
    }

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:school_classes,name,' . $id . ',id,school_id,' . auth()->user()->school_id,
    ]);

    $class = SchoolClass::where('school_id', auth()->user()->school_id)->findOrFail($id);
    $class->name = $request->name;
    $class->save();

    return response()->json(['success' => 'Class updated successfully.']);
}

public function destroy($id)
{
    $class = SchoolClass::where('school_id', auth()->user()->school_id)->findOrFail($id);
    $class->delete();

    return response()->json(['success' => 'Class deleted successfully.']);
}

}
