<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $with = ['state'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
