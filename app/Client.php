<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = ['nit', 'name', 'direction', 'telephone', 'city_id', 'quota', 'balance_quota', 'percentage_visits'];

    protected $with = ['city'];

    public  function city()
    {
        return $this->belongsTo(City::class);
    }
    public function getNitAttribute()
    {
        return decrypt($this->attributes['nit']);
    }

    public function setNitAttribute($value)
    {
        $this->attributes['nit'] = encrypt($value);
    }
}
