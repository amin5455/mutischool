<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{
    public function index()
    {
        $school_id = auth()->user()->school_id;
        $classes = SchoolClass::where('school_id', $school_id)->get();

        return view('attendance.index', compact('classes'));
    }

    
public function getSectionsByClass($classId)
{
    $school_id = auth()->user()->school_id;

    $sections = Section::where('school_class_id', $classId)
        ->where('school_id', $school_id)
        ->get();

    return response()->json($sections);
}

    public function loadStudents(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'section_id' => 'required|exists:sections,id',
            'date' => 'required|date',
        ]);

        $school_id = auth()->user()->school_id;

        $students = Student::where([
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'school_id' => $school_id,
        ])->get();

        // Check if attendance already exists
        $existing = Attendance::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('school_id', $school_id)
            ->where('date', $request->date)
            ->pluck('status', 'student_id');

        return response()->json([
            'students' => $students,
            'attendance' => $existing,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'date' => 'required|date',
            'attendances' => 'required|array',
        ]);

        $school_id = auth()->user()->school_id;

        foreach ($request->attendances as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'date' => $request->date,
                    'school_id' => $school_id,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                ],
                [
                    'status' => $status
                ]
            );
        }

        return response()->json(['success' => 'Attendance saved successfully']);
    }
}
