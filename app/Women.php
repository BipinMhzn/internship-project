<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Women extends Model
{
    protected $fillable = ['name', 'date_of_birth', 'contact', 'temporary_address', 'permanent_address', 'survey_date'];

    public function HealthDetail()
    {
        return $this->hasOne(HealthDetail::class);
    }

    public function MarriageDetail()
    {
        return $this->hasOne(MarriageDetail::class);
    }

    public function ChildMarriage()
    {
        return $this->hasOne(ChildMarriage::class);
    }
}
