<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['school_id', 'grade_name', 'min_percentage', 'max_percentage'];
}
