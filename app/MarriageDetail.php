<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarriageDetail extends Model
{
    protected $fillable = ['age_of_marriage', 'number_of_years_of_marriage', 'number_of_sons', 'number_of_daughters', 'number_of_others', 'women_id'];

    public function women()
    {
        return $this->belongsTo(Women::class);
    }

    public function AgeDuringChildBirths()
    {
        return $this->hasMany(AgeDuringChildBirth::class);
    }
}
