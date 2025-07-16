<?php

namespace App\Models;
use App\Models\School;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
protected $fillable = ['school_id', 'name', 'phone', 'address'];

public function school()
{
    return $this->belongsTo(School::class);
}

}
