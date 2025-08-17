<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
      public function index()
    {
        $school_id = auth()->user()->school_id;
        $classes = SchoolClass::where('school_id', $school_id)->get();

        return view('subjects.index', compact('classes'));
    }

   public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'class_id' => 'required|exists:school_classes,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    // Check if subject already exists in this class for this school
    $exists = Subject::where('school_id', auth()->user()->school_id)
        ->where('class_id', $request->class_id)
        ->where('name', $request->name)
        ->exists();

    if ($exists) {
        return response()->json([
            'error' => 'This subject already exists for the selected class.'
        ], 422);
    }

    Subject::create([
        'name' => $request->name,
        'class_id' => $request->class_id,
        'school_id' => auth()->user()->school_id,
    ]);

    return response()->json(['success' => 'Subject added successfully']);
}


    public function getSubjects()
    {
        $school_id = auth()->user()->school_id;

        $subjects = Subject::with('schoolClass')
            ->where('school_id', $school_id)
            ->latest()
            ->get();

        return response()->json($subjects);
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return response()->json($subject);
    }

public function update(Request $request, $id)
{
    $subject = Subject::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'class_id' => 'required|exists:school_classes,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    // Check if another subject already exists in this class with same name
    $exists = Subject::where('school_id', auth()->user()->school_id)
        ->where('class_id', $request->class_id)
        ->where('name', $request->name)
        ->where('id', '!=', $id) // exclude current record
        ->exists();

    if ($exists) {
        return response()->json([
            'error' => 'This subject already exists for the selected class.'
        ], 422);
    }

    $subject->update([
        'name' => $request->name,
        'class_id' => $request->class_id,
    ]);

    return response()->json(['success' => 'Subject updated successfully']);
}


    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();
        return response()->json(['success' => 'Subject deleted successfully']);
    }
}
