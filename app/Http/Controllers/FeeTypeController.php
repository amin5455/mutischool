<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeType;

class FeeTypeController extends Controller
{
    public function index()
{
    $feeTypes = FeeType::where('school_id', auth()->user()->school_id)->get();
    return view('fee_types.index', compact('feeTypes'));
}

public function create()
{
    return view('fee_types.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'amount' => 'required|numeric',
    ]);

    FeeType::create([
        'school_id' => auth()->user()->school_id,
        'title' => $request->title,
        'amount' => $request->amount,
    ]);

    return redirect()->route('fee-types.index')->with('success', 'Fee type added successfully.');
}

}
