<?php

namespace App\Http\Controllers;

use App\Models\ClassSubjectTeacher;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassSubjectTeacherController extends Controller
{
    public function index()
    {
        $school_id = auth()->user()->school_id;

        $classes = SchoolClass::where('school_id', $school_id)->get();
        $subjects = Subject::where('school_id', $school_id)->get();
        $teachers = Teacher::where('school_id', $school_id)->get();

        return view('assign-subjects.index', compact('classes', 'subjects', 'teachers'));
    }

    public function list()
    {
        $school_id = auth()->user()->school_id;

        $assignments = ClassSubjectTeacher::with(['class', 'subject', 'teacher'])
            ->where('school_id', $school_id)
            ->latest()
            ->get();

        return response()->json($assignments);
    }

  public function store(Request $request)
{
    $request->validate([
        'class_id'   => 'required|exists:school_classes,id',
        'subject_id' => 'required|exists:subjects,id',
        'teacher_id' => 'required|exists:teachers,id',
    ]);

    $exists = ClassSubjectTeacher::where('school_id', auth()->user()->school_id)
        ->where('class_id', $request->class_id)
        ->where('subject_id', $request->subject_id)
        ->where('teacher_id', $request->teacher_id)
        ->exists();

    if ($exists) {
        return response()->json([
            'error' => 'This teacher is already assigned to this subject in this class.'
        ], 422);
    }

    ClassSubjectTeacher::create([
        'class_id'   => $request->class_id,
        'subject_id' => $request->subject_id,
        'teacher_id' => $request->teacher_id,
        'school_id'  => auth()->user()->school_id,
    ]);

    return response()->json(['success' => 'Assigned successfully']);
}


    public function destroy($id)
    {
        ClassSubjectTeacher::findOrFail($id)->delete();
        return response()->json(['success' => 'Deleted successfully']);
    }
}
