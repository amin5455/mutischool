<?php

namespace App\Models;
use App\Models\Student;


use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
      protected $fillable = [
        'student_id', 'school_id', 'class_id', 'section_id', 'date', 'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
