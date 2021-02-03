<?php

namespace App\Http\Controllers\Api;

use App\Attendee;
use App\Http\Resources\AttendeeResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendeeController extends Controller
{
    public function login(Request $request)
    {
        $attendee = Attendee::where('lastname', $request->get('lastname'))
            ->where('registration_code', $request->get('registration_code'))
            ->first();

        if ($attendee) {
            $attendee->login_token = md5($attendee->username);
            $attendee->save();
            return response()->json(new AttendeeResource($attendee));
        } else {
            return response()->json(['message' => 'Invalid login'], 401);
        }
    }

    public function logout(Request $request)
    {
        $attendee = Attendee::where('login_token', $request->get('token'))->first();

        if ($attendee) {
            $attendee->login_token = '';
            $attendee->save();
            return response()->json(['message' => 'Logout success']);
        } else {
            return response()->json(['message' => 'Invalid token'], 401);
        }
    }
}
