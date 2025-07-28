<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
      protected $fillable = ['school_id', 'title', 'amount'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
