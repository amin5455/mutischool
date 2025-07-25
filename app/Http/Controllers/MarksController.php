<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Mark;


class MarksController extends Controller
{
       public function index()
    {
        $exams = \App\Models\Exam::where('school_id', auth()->user()->school_id)->get();
        $classes = \App\Models\SchoolClass::where('school_id', auth()->user()->school_id)->get();
        $sections = \App\Models\Section::where('school_id', auth()->user()->school_id)->get();
        $subjects = \App\Models\Subject::where('school_id', auth()->user()->school_id)->get();

        return view('marks.index', compact('exams', 'classes', 'sections', 'subjects'));
    }

    public function fetchStudents(Request $request)
    {
        try {
        $request->validate([
            'exam_id' => 'required',
            'class_id' => 'required',
            'section_id' => 'required',
            'subject_id' => 'required'
        ]);

        $students = Student::where([
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'school_id' => auth()->user()->school_id
        ])->get();

        $html = view('marks.partials.student_table', compact('students'))->render();

        return response()->json(['html' => $html]);
        }
        catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
    }

    public function store(Request $request)
    {
            try {
        foreach ($request->marks as $markData) {
            Mark::updateOrCreate(
                [
                    'exam_id' => $markData['exam_id'],
                    'student_id' => $markData['student_id'],
                    'subject_id' => $markData['subject_id']
                ],
                [
                    'class_id' => $markData['class_id'],
                    'section_id' => $markData['section_id'],
                    'marks_obtained' => $markData['marks_obtained']
                ]
            );
        }

        return response()->json(['message' => 'Marks stored successfully!']);
    }
        catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
    
    }
}
