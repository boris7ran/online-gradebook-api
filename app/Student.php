<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function gradebook()
    {
        return $this->belongsTo(Gradebook::class);
    }
}
