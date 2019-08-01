<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    const STORE_RULES = [
        'name' => 'required | min:2 | max:255',
        'proffessor_id' => 'required',
    ];

    public function proffessor()
    {
        return $this->belongsTo(Proffessor::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
