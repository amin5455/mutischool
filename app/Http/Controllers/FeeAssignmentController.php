<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeAssignment;

class FeeAssignmentController extends Controller
{
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
