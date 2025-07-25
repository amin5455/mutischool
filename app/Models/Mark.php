<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
     protected $fillable = [
        'student_id',
        'exam_id',
        'class_id',
        'section_id',
        'subject_id',
        'marks_obtained',
        'school_id', // only if you're doing multi-school setup
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
}
