<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Grade;
use App\Models\Section;
use App\Models\SchoolClass; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;

class ResultController extends Controller
{
    public function studentList(Request $request)
{
    $students = [];

    if ($request->has(['class_id', 'exam_id'])) {
        $students = Student::with('section', 'SchoolClass')
            ->where('class_id', $request->class_id)
            ->where('school_id', auth()->user()->school_id) // if school_id is needed
            ->get();
    }

    $classes = SchoolClass::all();
    $exams = Exam::all();

    return view('result.index', compact('students', 'classes', 'exams'));
}

public function calculateResult($student_id, $exam_id)
{
    $student = Student::with('SchoolClass')->findOrFail($student_id);

    $marks = \App\Models\Mark::with('subject')
        ->where('student_id', $student_id)
        ->where('exam_id', $exam_id)
        ->get();

    $total_obtained = 0;
    $total_marks = 0;

    foreach ($marks as $mark) {
        $total_obtained += $mark->marks_obtained;

        // Get total marks from exam_subjects table
        $examSubject = \App\Models\ExamSubject::where('exam_id', $exam_id)
            ->where('school_class_id', $student->class_id)
            ->where('subject_id', $mark->subject_id)
            ->first();

        $total_marks += $examSubject->total_marks ?? 0;
    }

    $percentage = ($total_marks > 0) ? ($total_obtained / $total_marks) * 100 : 0;

    $grade = \App\Models\Grade::where('school_id', $student->school_id)
        ->where('min_percentage', '<=', $percentage)
        ->where('max_percentage', '>=', $percentage)
        ->first();

    return [
        'total_obtained' => $total_obtained,
        'total_marks' => $total_marks,
        'percentage' => round($percentage, 2),
        'grade' => $grade->grade_name ?? 'N/A',
    ];
}


    public function show($student_id, $exam_id)
    {
        $student = Student::findOrFail($student_id);
        $exam = Exam::findOrFail($exam_id);
        

// $marks = DB::table('marks')
//     ->join('exam_subjects', function ($join) use ($student, $exam_id) {
//         $join->on('marks.exam_id', '=', 'exam_subjects.exam_id')
//             ->where('exam_subjects.school_class_id', '=', $student->class_id)
//             ->on('marks.subject_id', '=', 'exam_subjects.subject_id');
//     })
//     ->join('subjects', 'marks.subject_id', '=', 'subjects.id')
//     ->select(
//         'subjects.name as subject_name',
//         'marks.marks_obtained',
//         'exam_subjects.total_marks'
//     )
//     ->where('marks.student_id', $student_id)
//     ->where('marks.exam_id', $exam_id)
//     ->get();


        $student = Student::with('schoolClass')->findOrFail($student_id);

         $marks = Mark::with('subject')
         ->where('student_id', $student_id)
         ->where('exam_id', $exam_id)
         ->get();
 
        
        $result = $this->calculateResult($student_id, $exam_id);
        
        // return view('result.card', compact('student', 'exam', 'marks', 'result'));
        return view('result.card', [
    'marks' => $marks,
    'student' => $student,
    'result' => $result,
    'exam' => $exam, // ✅ add this line
    'exam_id' => $exam_id, // ✅ add this line
]);


    }

    public function downloadPdf($student_id, $exam_id)
    {
        $student = Student::findOrFail($student_id);
        $exam = Exam::findOrFail($exam_id);
        $marks = Mark::with('examSubject.subject')
            ->where('student_id', $student_id)
            ->whereHas('examSubject', fn($q) => $q->where('exam_id', $exam_id))
            ->get();

        $result = $this->calculateResult($student_id, $exam_id);

        $pdf = PDF::loadView('result.card-pdf', compact('student', 'exam', 'marks', 'result'));
        return $pdf->download('report-card-' . $student->name . '.pdf');
    }
}
