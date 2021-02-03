<?php

namespace App\Http\Controllers;

use App\Event;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
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
        return view('tickets.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $val = [];
        $json = null;

        if ($request->get('special_validity')) {
            if ($request->get('special_validity') == 'amount') {
                $val = ['amount' => 'required'];
                $json = json_encode([
                    'type' => 'amount',
                    'amount' => $request->get('amount'),
                ]);
            } else {
                $val = ['valid_until' => 'required|date_format:Y-m-d H:i'];
                $json = json_encode([
                    'type' => 'date',
                    'date' => $request->get('valid_until'),
                ]);
            }
        }

        $request->validate(array_merge([
            'name' => 'required',
            'cost' => 'required'
        ], $val));

        $input = $request->only(['name', 'cost']);
        $input['special_validity'] = $json;

        $event->tickets()->save(new Ticket($input));
        return redirect()->route('events.show', $event->id)->with('success', 'Ticket successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
