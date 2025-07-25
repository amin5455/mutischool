<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Grade;
use App\Models\Section;
use App\Models\SchoolClass; 
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ResultController extends Controller
{
    public function studentList(Request $request)
{
    $students = [];

    if ($request->has(['class_id', 'exam_id'])) {
        $students = Student::with('section', 'class')
            ->where('class_id', $request->class_id)
            ->where('school_id', auth()->user()->school_id) // if school_id is needed
            ->get();
    }

    $classes = ClassModel::all();
    $exams = Exam::all();

    return view('result.index', compact('students', 'classes', 'exams'));
}

    public function calculateResult($student_id, $exam_id)
    {
        $subjects = Mark::with('examSubject')
            ->where('student_id', $student_id)
            ->whereHas('examSubject', function($q) use ($exam_id) {
                $q->where('exam_id', $exam_id);
            })->get();

        $total_obtained = 0;
        $total_marks = 0;

        foreach ($subjects as $mark) {
            $total_obtained += $mark->obtained_marks;
            $total_marks += $mark->examSubject->total_marks;
        }

        $percentage = ($total_marks > 0) ? ($total_obtained / $total_marks) * 100 : 0;

        $student = Student::find($student_id);

        $grade = Grade::where('school_id', $student->school_id)
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
        $marks = Mark::with('examSubject.subject')
            ->where('student_id', $student_id)
            ->whereHas('examSubject', fn($q) => $q->where('exam_id', $exam_id))
            ->get();

        $result = $this->calculateResult($student_id, $exam_id);

        return view('result.card', compact('student', 'exam', 'marks', 'result'));
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
