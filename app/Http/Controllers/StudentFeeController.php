<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
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
