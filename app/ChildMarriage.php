<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildMarriage extends Model
{
    protected $fillable = ['know_child_marriage', 'child_marriage', 'girl_marry_age', 'boy_marry_age', 'first_child_age', 'know_marriage_laws', 'marriage_laws', 'women_id'];

    public function women()
    {
        return $this->belongsTo(Women::class);
    }
}
