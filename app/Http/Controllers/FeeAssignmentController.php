<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeAssignment;
use App\Models\FeeType;
use App\Models\SchoolClass;



class FeeAssignmentController extends Controller
{

    public function index()
{
    $school_id = auth()->user()->school_id;

    $assignedFees = FeeAssignment::with(['feeType', 'class'])
        ->where('school_id', $school_id)
        ->get();

    $feeTypes = FeeType::where('school_id', $school_id)->get();
    $classes = SchoolClass::where('school_id', $school_id)->get(); // adjust if your class model has a different name

    return view('fee_assignments.index', compact('assignedFees', 'feeTypes', 'classes'));
}

    public function store(Request $request)
{
    $request->validate([
        'class_id' => 'required',
        'fee_type_id' => 'required',
        'due_date' => 'required|date',
    ]);

    FeeAssignment::create([
        'school_id' => auth()->user()->school_id,
        'class_id' => $request->class_id,
        'fee_type_id' => $request->fee_type_id,
        'due_date' => $request->due_date,
    ]);

    return redirect()->back()->with('success', 'Fee assigned successfully.');
}

}
