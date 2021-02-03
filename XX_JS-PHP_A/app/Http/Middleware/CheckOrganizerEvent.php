<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckOrganizerEvent
{
    public function handle($request, Closure $next)
    {
        $event = Auth::user()->events()->find($request->segment(2));

        if ($event) {
            return $next($request);
        }

        return redirect()->route('events.index')->with('danger', 'Invalid Event');
    }
}
