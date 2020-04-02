<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'place', 'date', 'latitude', 'longitude', 'objective', 'prepared_by', 'checked_by', 'approved_by'];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

}
