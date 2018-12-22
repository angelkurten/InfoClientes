<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{

    protected $fillable = ['client_id', 'seller_id', 'visit_at', 'value_net', 'value_visit', 'observations'];
    protected $with = ['seller', 'client'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function getVisitAtAttribute() {
        return  (new Carbon($this->attributes['visit_at']))->format('Y-m-d');
    }
}
