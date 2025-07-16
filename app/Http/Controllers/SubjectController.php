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
            return response()->json(['error' => 'Validation failed'], 422);
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
            return response()->json(['error' => 'Validation failed'], 422);
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
