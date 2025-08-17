<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;


class TimetableController extends Controller
{
    public function index()
    {
        $school_id = auth()->user()->school_id;

        $classes = SchoolClass::where('school_id', $school_id)->get();
        $subjects = Subject::where('school_id', $school_id)->get();
        $teachers = Teacher::where('school_id', $school_id)->get();

        return view('timetable.index', compact('classes', 'subjects', 'teachers'));
    }

    public function list()
    {
        $school_id = auth()->user()->school_id;

        $routines = Timetable::with('class', 'subject', 'teacher')
            ->where('school_id', $school_id)
            ->latest()
            ->get();

        return response()->json($routines);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'weekday' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);


        $start = Carbon::createFromFormat('H:i', $request->start_time)->format('H:i:s');
        $end = Carbon::createFromFormat('H:i', $request->end_time)->format('H:i:s');

         $conflict = Timetable::where('teacher_id', $request->teacher_id)
             ->where('weekday', $request->weekday)
             ->where(function ($q) use ($start, $end) {
                 $q->where(function ($query) use ($start, $end) {
                     $query->where('start_time', '<', $end)
                           ->where('end_time', '>', $start);
                 });
             })
             ->exists();

if ($conflict) {
    return response()->json(['error' => 'This teacher is already assigned during this time!'], 400);
}


        Timetable::create([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'weekday' => $request->weekday,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'school_id' => auth()->user()->school_id,
        ]);

        return response()->json(['success' => 'Routine added successfully']);
    }

    public function destroy($id)
    {
        Timetable::findOrFail($id)->delete();
        return response()->json(['success' => 'Routine deleted']);
    }
    public function showAllTimetables()
{
    $classes = SchoolClass::with('timetables.subject', 'timetables.teacher')
    ->where('school_id', auth()->user()->school_id)
    ->get();
    return view('timetable.print_all', compact('classes'));
}

public function printClassTimetable($id)
{
    $class = SchoolClass::with('timetables.subject', 'timetables.teacher')
                ->where('id', $id)
                ->where('school_id', auth()->user()->school_id)
                ->firstOrFail();
    return view('timetable.print_single', compact('class'));
}
}
