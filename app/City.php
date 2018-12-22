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

    public function visits()
    {
            return $this->hasManyThrough(Visit::class, Client::class)->addSelect(['visits.id', 'visits.visit_at']);
    }
}
