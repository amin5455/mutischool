<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
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

    $classes = SchoolClass::where('school_id', auth()->user()->school_id)->get();

    // Render table partial
    $tableHtml = view('classes.table', compact('classes'))->render();

    return response()->json([
        'success' => true,
        'message' => 'Class updated successfully.',
        'table' => $tableHtml
    ]);
}

public function destroy($id)
{
    $class = SchoolClass::where('school_id', auth()->user()->school_id)->findOrFail($id);

    // Check if class is used in related models
    $hasSections = $class->sections()->exists();   // if relationship defined
    $hasStudents = Student::where('class_id', $class->id)->exists();
    $hasSubjects = Subject::where('class_id', $class->id)->exists();

    if ($hasSections || $hasStudents || $hasSubjects) {
        return response()->json([
            'success' => 'Cannot delete this class. It is being used in other records.'
        ]);
    }

    $class->delete();

    return response()->json(['success' => 'Class deleted successfully.']);
}


}
