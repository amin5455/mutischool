<?php

// app/Models/Student.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolClass;
use App\Models\School;
use App\Models\Section;


class Student extends Model
{
    protected $fillable = ['school_id', 'class_id', 'section_id', 'name', 'gender', 'dob'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}

