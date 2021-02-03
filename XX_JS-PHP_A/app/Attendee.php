<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }
}
