<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\schoolClass;
use App\Models\Subject;
use App\Models\Teacher;

class ClassSubjectTeacher extends Model
{
    
    protected $fillable = ['class_id', 'subject_id', 'teacher_id', 'school_id'];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
