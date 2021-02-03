<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Http\Resources\EventResource;
use App\Organizer;
use App\Http\Resources\EventDetailResource;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('date', '>', date('Y-m-d'))->orderBy('date', 'ASC')->get();
        return response()->json(['events' => EventResource::collection($events)]);
    }

    public function detail($organizer_slug, $event_slug)
    {
        $organizer = Organizer::where('slug', $organizer_slug)->first();
        if (!$organizer) {
            return response()->json(['message' => 'Organizer not found'], 404);
        }

        $event = $organizer->events()->where('slug', $event_slug)->first();
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        return response()->json(new EventDetailResource($event));
    }
}
