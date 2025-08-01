<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\School;
use App\Models\Section;
use App\Models\Timetable;

class SchoolClass extends Model
{
        protected $table = 'school_classes';

    // ✅ Allow mass assignment for name and school_id
    protected $fillable = [
        'name',
        'school_id',
    ];
    public function school()
{
    return $this->belongsTo(School::class);
}

public function sections()
{
    return $this->hasMany(Section::class);
}
public function timetables()
{
    return $this->hasMany(Timetable::class, 'class_id');
}
}
