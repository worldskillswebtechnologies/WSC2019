<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Auth::user()->events()->orderBy('date', 'ASC')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:events,slug,null,null,organizer_id,' . Auth::user()->id . '|regex:/^[0-9a-z-]+$/',
            'date' => 'required|date_format:Y-m-d'
        ], [
            'slug.unique' => 'Slug is already used',
            'slug.regex' => 'Slug must not be empty and only contain a-z, 0-9 and \'-\''
        ]);

        $input = $request->only(['name', 'slug', 'date']);

        $event = Auth::user()->events()->save(new Event($input));
        return redirect()->route('events.show', $event->id)->with('success', 'Event successfully created');
    }

    public function show(Event $event)
    {
        return view('events.detail', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:events,slug,' . $event->id . ',id,organizer_id,' . Auth::user()->id . '|regex:/^[0-9a-z-]+$/',
            'date' => 'required|date_format:Y-m-d'
        ], [
            'slug.unique' => 'Slug is already used',
            'slug.regex' => 'Slug must not be empty and only contain a-z, 0-9 and \'-\''
        ]);

        $input = $request->only(['name', 'slug', 'date']);

        $event->update($input);
        return redirect()->route('events.show', $event->id)->with('success', 'Event successfully updated');
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
