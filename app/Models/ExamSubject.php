<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
       protected $fillable = [
        
        'exam_id',
        'school_class_id',
        'subject_id',
        'total_marks'
    ];

    // Relationships

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class); // if your class model is named `ClassModel`
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
