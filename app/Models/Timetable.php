<?php

namespace App\Models;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;


use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
        protected $fillable = [
        'school_id', 'class_id', 'subject_id', 'teacher_id', 'weekday', 'start_time', 'end_time'
    ];

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
