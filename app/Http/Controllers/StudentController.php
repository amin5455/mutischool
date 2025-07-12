<?php

// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
     $school_id = auth()->user()->school_id;
     
     $classes = SchoolClass::where('school_id', $school_id)->get();
     $sections = Section::where('school_id', $school_id)->get();
     $students = Student::with('school', 'schoolClass', 'section')
    ->where('school_id', $school_id)
    ->latest()->get();


        return view('students.index', compact('classes', 'sections', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'gender'     => 'required|in:Male,Female',
            'dob'        => 'required|date',
            'class_id'   => 'required|exists:school_classes,id',
            'section_id' => 'required|exists:sections,id',
        ]);

       $student = Student::create([
       'name' => $request->name,
       'gender' => $request->gender,
       'dob' => $request->dob,
       'school_id' => auth()->user()->school_id,  // or from session
       'class_id' => $request->class_id,
       'section_id' => $request->section_id,
        ]);

        return response()->json(['success' => 'Student added successfully', 'student' => $student]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'gender'     => 'required|in:Male,Female',
            'dob'        => 'required|date',
            'class_id'   => 'required|exists:school_classes,id',
            'section_id' => 'required|exists:sections,id',
        ]);

            $student = Student::create([
           'name' => $request->name,
           'gender' => $request->gender,
           'dob' => $request->dob,
           'school_id' => auth()->user()->school_id,  // or from session
           'class_id' => $request->class_id,
           'section_id' => $request->section_id,
            ]);
        return response()->json(['success' => 'Student updated successfully']);
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json(['success' => 'Student deleted successfully']);
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function show()
{
    $school_id = auth()->user()->school_id;

    $students = Student::with('school', 'schoolClass', 'section')
        ->where('school_id', $school_id)
        ->latest()->get();

    return response()->json($students);
}

public function getSectionsByClass($class_id)
{
    $sections = Section::where('school_class_id', $class_id)->get();
    return response()->json($sections);
}


}
