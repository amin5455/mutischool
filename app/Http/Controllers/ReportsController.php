<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\StudentFee;
use App\Models\Student;

class ReportsController extends Controller
{

public function classWiseCollection()
{
    $school_id = auth()->user()->school_id;

    $classes = SchoolClass::where('school_id', $school_id)->get();

    $report = [];

    foreach ($classes as $class) {
        $students = Student::where('class_id', $class->id)->pluck('id');

        $total_collected = StudentFee::whereIn('student_id', $students)->sum('amount_paid');
        $student_count = count($students);

        $report[] = [
            'class_name' => $class->name,
            'student_count' => $student_count,
            'total_collected' => $total_collected,
        ];
    }

    return view('reports.class_wise_collection', compact('report'));
}

}
