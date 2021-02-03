<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }

    public function sessions()
    {
        return $this->hasManyThrough('App\Session', 'App\Room');
    }
}
