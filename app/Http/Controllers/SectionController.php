<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('schoolClass')->get();
        $classes = SchoolClass::all();
        return view('sections.index', compact('sections', 'classes'));
    }

    public function store(Request $request)
    {
            $request->validate([
        'name' => 'required|unique:sections,name,NULL,id,school_class_id,' . $request->school_class_id,
        'school_class_id' => 'required|exists:school_classes,id',
    ]);

        Section::create([
        'name' => $request->name,
        'school_class_id' => $request->school_class_id,
        'school_id' => auth()->user()->school_id,
       ]);


        // Section::create($request->all());
        return response()->json(['success' => 'Section created successfully.']);
    }

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'school_class_id' => 'required|exists:school_classes,id',
    ]);

    $section = Section::findOrFail($id);
      // Check for duplicate section
    $exists = Section::where('name', $request->name)
        ->where('school_class_id', $request->school_class_id)
        ->where('school_id', auth()->user()->school_id) // assuming you have this field
        ->where('id', '!=', $id) // exclude current section
        ->exists();

    if ($exists) {
        return response()->json(['message' => 'This section already exists for the selected class.'], 422);
    }
    $section->update([
    'name' => $request->name,
    'school_class_id' => $request->school_class_id,
]);
    return response()->json(['message' => 'Section updated']);
}


public function destroy($id)
{
    $section = Section::findOrFail($id);
    $section->delete();

    return response()->json(['message' => 'Section deleted successfully']);
}


    public function edit($id)
{
    $section = Section::findOrFail($id);
    return response()->json($section);
}

public function list()
{
    $sections = Section::with('schoolClass')
        ->where('school_id', auth()->user()->school_id)
        ->get();

    return response()->json($sections);
}

}

