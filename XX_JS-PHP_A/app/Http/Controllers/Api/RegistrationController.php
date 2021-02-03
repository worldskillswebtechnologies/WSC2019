<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendee;
use App\Organizer;
use App\Ticket;
use App\Registration;
use App\SessionRegistration;

use App\Http\Resources\RegistrationResource;

class RegistrationController extends Controller
{
    public function register(Request $request, $organizer_slug, $event_slug)
    {
        $attendee = Attendee::where('login_token', $request->get('token'))->first();
        if (!$attendee) {
            return response()->json(['message' => 'User not logged in'], 401);
        }

        $organizer = Organizer::where('slug', $organizer_slug)->first();
        if (!$organizer) {
            return response()->json(['message' => 'Organizer not found'], 404);
        }

        $event = $organizer->events()->where('slug', $event_slug)->first();
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $ticket = Ticket::find($request->get('ticket_id'));
        if (!$ticket || !$ticket->available) {
            return response()->json(['message' => 'Ticket is no longer available'], 401);
        }


        $already = $attendee->registrations()->whereIn('ticket_id', $event->tickets->pluck('id'))->first();
        if ($already) {
            return response()->json(['message' => 'User already registered'], 401);
        }

        $registration = Registration::create([
            'ticket_id' => $ticket->id,
            'attendee_id' => $attendee->id,
            'registration_time' => date('Y-m-d H:i:s'),
        ]);

        $session_ids = $request->get('session_ids');
        if ($session_ids) {
            foreach ($session_ids as $session_id) {
                SessionRegistration::create([
                    'session_id' => $session_id,
                    'registration_id' => $registration->id,
                ]);
            }
        }

        return response()->json(['message' => 'Registration successful']);
    }

    public function registrations(Request $request)
    {
        $attendee = Attendee::where('login_token', $request->get('token'))->first();
        if (!$attendee) {
            return response()->json(['message' => 'User not logged in'], 401);
        }

        return response(['registrations' => RegistrationResource::collection($attendee->registrations)]);
    }
}
