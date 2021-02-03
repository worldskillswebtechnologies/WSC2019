<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function sessionRegistrations()
    {
        return $this->hasMany('App\SessionRegistration');
    }
}
