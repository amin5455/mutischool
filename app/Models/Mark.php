<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
     protected $fillable = [
        'exam_id',
        'class_id',
        'section_id',
        'subject_id',
        'student_id',
        'exam_subject_id',
        'marks_obtained',
    ];

    // Relationships

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function examSubject()
{
    return $this->belongsTo(ExamSubject::class);
}

}
