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
            'school_class_id' => 'required'
        ]);

        Section::create($request->all());
        return response()->json(['success' => 'Section created successfully.']);
    }

    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|unique:sections,name,' . $section->id . ',id,school_class_id,' . $request->school_class_id,
            'school_class_id' => 'required'
        ]);

        $section->update($request->all());
        return response()->json(['success' => 'Section updated successfully.']);
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return response()->json(['success' => 'Section deleted successfully.']);
    }

    public function show(Section $section)
    {
        return response()->json($section);
    }
}

