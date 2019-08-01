<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proffessor extends Model
{
    const STORE_RULES = [
        'first_name' => 'required | min:2',
        'last_name' => 'required | min:2',
        'image_link' => 'required | ends_with:jpeg,png,jpg',
        'user_id' => 'required'
    ];

    public function gradebook()
    {
        return $this->hasOne(Gradebook::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
