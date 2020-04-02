<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthDetail extends Model
{
    protected $fillable = ['used_contraceptive_device', 'type_of_contraceptive_device', 'contraceptive_device', 'age_of_first_mensuration', 'menopause', 'age_of_menopause', 'have_health_problem', 'health_problem', 'women_id'];

    public function women()
    {
        return $this->belongsTo(Women::class);
    }
}
