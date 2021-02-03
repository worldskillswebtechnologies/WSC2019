<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Organizer extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $guarded = [];

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
