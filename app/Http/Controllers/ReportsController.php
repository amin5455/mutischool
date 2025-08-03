<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentFee;
use App\Models\FeeType;

class ReportsController extends Controller
{

public function classWiseCollection()
{
   $school_id = auth()->user()->school_id;

    $classes = SchoolClass::with('sections')->where('school_id', $school_id)->get();
    $fee_types = FeeType::all();
    $report = [];

    foreach ($classes as $class) {
        foreach ($class->sections as $section) {
            $students = Student::where('class_id', $class->id)
                            ->where('section_id', $section->id)
                            ->pluck('id');

            $total_students = $students->count();

            foreach ($fee_types as $fee_type) {
                $fees = StudentFee::whereIn('student_id', $students)
                            ->where('fee_type_id', $fee_type->id);

                // $assigned = $fees->sum('amount_assigned');
                $collected = $fees->sum('amount_paid');
                $paid_students = $fees->where('amount_paid', '>', 0)->distinct('student_id')->count('student_id');

                $report[] = [
                    'class' => $class->name,
                    'section' => $section->name,
                    'total_students' => $total_students,
                    'paid_students' => $paid_students,
                    'fee_type' => $fee_type->name,
                    'fee_amount' => $fee_type->amount,
                    // 'assigned' => $assigned,
                    'collected' => $collected,
                ];
            }
        }
    }

    return view('reports.class_wise_collection', compact('report'));
}

}
