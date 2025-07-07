<?php

namespace App\Http\Controllers;
use App\Models\School;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
{
    $schools = School::all();
    return view('superadmin.dashboard');
}

public function toggleStatus(School $school)
{
    $school->status = $school->status === 'active' ? 'inactive' : 'active';
    $school->save();

    return redirect()->back()->with('message', 'School status updated!');
}
}
