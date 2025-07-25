<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\schoolClass;
use App\Models\ExamSubject;

class Exam extends Model
{
        protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'school_id',
    ];

    // Optional: relationships
    public function school()
    {
        return $this->belongsTo(schoolClass::class);
    }

    public function subjects()
    {
        return $this->hasMany(ExamSubject::class);
    }
}
