<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeType;
use App\Models\Student;
use App\Models\StudentFee;


class StudentFeeController extends Controller
{

    public function index()
{
    $school_id = auth()->user()->school_id;

    $fees = StudentFee::with(['student', 'feeType'])
                ->whereHas('student', function ($q) use ($school_id) {
                    $q->where('school_id', $school_id);
                })
                ->latest()
                ->get();

    return view('student_fees.index', compact('fees'));
}

    public function create()
{
    $students = Student::where('school_id', auth()->user()->school_id)->get();
    $feeTypes = FeeType::where('school_id', auth()->user()->school_id)->get();
    return view('student_fees.create', compact('students', 'feeTypes'));
}

public function store(Request $request)
{
    $request->validate([
        'student_id' => 'required',
        'fee_type_id' => 'required',
        'amount_paid' => 'required|numeric',
        'payment_date' => 'required|date',
    ]);

    StudentFee::create($request->all());

    return redirect()->route('student-fees.index')->with('success', 'Fee collected successfully.');
}

}
