<?php

namespace App\Http\Controllers;

use App\Event;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create(Event $event)
    {
        return view('sessions.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            "type" => 'required',
            "title" => 'required',
            "speaker" => 'required',
            "room_id" => 'required',
            // "cost" => 'required',
            "start" => 'required|date_format:Y-m-d H:i',
            "end" => ['required', 'date_format:Y-m-d H:i', 'after:start', function ($attr, $value, $fail) use ($request) {
                $booked = Session::where('start', '<=', $request->get('end'))
                    ->where('end', '>=', $request->get('start'))
                    ->first();

                if ($booked) {
                    $fail('Room already booked during this time');
                }
            }],
            "description" => 'required',
        ]);

        $input = $request->only(['type', 'title', 'speaker', 'room_id', 'cost', 'start', 'end', 'description']);

        if ($input['type'] == 'talk') {
            $input['cost'] = null;
        }

        $input['start'] = Carbon::createFromFormat('Y-m-d H:i', $input['start']);
        $input['end'] = Carbon::createFromFormat('Y-m-d H:i', $input['end']);

        Session::create($input);

        return redirect()->route('events.show', $event->id)->with('success', 'Session successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Event $event, Session $session)
    {
        return view('sessions.edit', compact('event', 'session'));
    }

    public function update(Request $request, Event $event, Session $session)
    {
        $request->validate([
            "type" => 'required',
            "title" => 'required',
            "speaker" => 'required',
            "room_id" => 'required',
            // "cost" => 'required',
            "start" => 'required|date_format:Y-m-d H:i',
            "end" => ['required', 'date_format:Y-m-d H:i', 'after:start', function ($attr, $value, $fail) use ($request, $session) {
                $booked = Session::where('start', '<=', $request->get('end'))
                    ->where('end', '>=', $request->get('start'))
                    ->where('id', '<>', $session->id)
                    ->first();

                if ($booked) {
                    $fail('Room already booked during this time');
                }
            }],
            "description" => 'required',
        ]);

        $input = $request->only(['type', 'title', 'speaker', 'room_id', 'cost', 'start', 'end', 'description']);

        if ($input['type'] == 'talk') {
            $input['cost'] = null;
        }

        $input['start'] = Carbon::createFromFormat('Y-m-d H:i', $input['start']);
        $input['end'] = Carbon::createFromFormat('Y-m-d H:i', $input['end']);

        $session->update($input);

        return redirect()->route('events.show', $event->id)->with('success', 'Session successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
