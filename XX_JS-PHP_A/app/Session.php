<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $dates = ['start', 'end'];

    public function sessionRegistrations()
    {
        return $this->hasMany('App\SessionRegistration');
    }
}
