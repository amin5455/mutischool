<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolClass;

class Section extends Model
{
      protected $table = 'sections';

    // ✅ Allow mass assignment
    protected $fillable = [
        'name',
        'school_class_id',
    ];


public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class, 'school_class_id');
}

}
