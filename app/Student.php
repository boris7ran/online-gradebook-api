<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    const STORE_RULES = [
       '*.name' => 'required',
       '*.image_link' => 'required | ends_with:jpeg,png,jpg' 
    ];

    public function gradebook()
    {
        return $this->belongsTo(Gradebook::class);
    }
}
