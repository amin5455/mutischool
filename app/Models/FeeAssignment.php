<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeAssignment extends Model
{
      protected $fillable = ['school_id', 'class_id', 'fee_type_id', 'due_date'];

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class); // use your actual class model name
    }
}
