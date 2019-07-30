<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    public function proffessor()
    {
        return $this->belongsTo(Proffessor::class);
    }
}
