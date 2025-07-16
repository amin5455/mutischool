<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\schoolClass;

class Subject extends Model
{
    protected $fillable = ['school_id', 'class_id', 'name'];

    public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class, 'class_id');
}

}
