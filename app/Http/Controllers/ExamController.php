<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamSubject;
use App\Models\SchoolClass;
use App\Models\Subject;


class ExamController extends Controller
{
    
    public function index()
    {
        $exams = Exam::where('school_id', auth()->user()->school_id)->get();
        $classes = SchoolClass::where('school_id', auth()->user()->school_id)->get();
        $subjects = Subject::where('school_id', auth()->user()->school_id)->get();

        return view('exams.index', compact('exams', 'classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'school_id' => 'required'
        ]);

        Exam::create($request->only(['name', 'start_date', 'end_date', 'school_id']));

        return redirect()->back()->with('success', 'Exam created successfully!');
    }

    public function storeExamSubjects(Request $request)
    {    try {
        // Optional: Add validation here

        ExamSubject::create([
            'exam_id' => $request->exam_id,
            'school_class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'total_marks' => $request->total_marks
        ]);

        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
    }
}
