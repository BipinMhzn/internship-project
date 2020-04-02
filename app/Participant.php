<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['name', 'sex', 'contact', 'photo', 'event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
