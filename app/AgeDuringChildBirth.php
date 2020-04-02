<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgeDuringChildBirth extends Model
{
    protected $fillable = ['age_during_child_birth', 'marriage_detail_id'];

    public function MarriageDetail()
    {
        return $this->belongsTo(MarriageDetail::class);
    }
}
