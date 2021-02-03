<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function registrations()
    {
        return $this->hasManyThrough('App\Registration', 'App\Ticket');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function channels()
    {
        return $this->hasMany('App\Channel');
    }

    public function organizer()
    {
        return $this->belongsTo('App\Organizer');
    }
}
