<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'event_tickets';

    public function getValidityAttribute()
    {
        return json_decode($this->special_validity);
    }

    public function getDescriptionAttribute()
    {
        $description = null;
        if ($this->validity) {
            if ($this->validity->type == 'date') {
                $date = Carbon::parse($this->validity->date)->format('F j, Y');
                $description = "Available until ".$date;
            } else {
                $description = $this->validity->amount." tickets available";
            }
        }
        return $description;
    }

    public function getAvailableAttribute()
    {
        $avail = true;
        if ($this->validity) {
            if ($this->validity->type == 'date') {
                if ($this->validity->date < date('Y-m-d')) {
                    $avail = false;
                }
            } else {
                if ($this->validity->amount <= $this->registrations->count()) {
                    $avail = false;
                }
            }
        }
        return $avail;
    }

    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
