<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Event $event)
    {
        $data = [];

        foreach ($event->channels as $channel) {
            foreach ($channel->rooms as $room) {
                foreach ($room->sessions as $session) {
                    $temp = [
                        'session' => $session->title,
                        'capacity' => $room->capacity,
                    ];

                    if ($session->type == 'talk') {
                        $temp['attendee'] = $event->registrations->count();
                    } else {
                        $temp['attendee'] = $session->sessionRegistrations->count();
                    }

                    $data[] = $temp;
                }
            }
        }

        return view('reports.index', compact('event', 'data'));
    }
}
