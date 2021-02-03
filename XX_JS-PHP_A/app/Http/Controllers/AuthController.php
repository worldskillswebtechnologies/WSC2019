<?php

namespace App\Http\Controllers;

use App\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        Organizer::find(1)->update(['password_hash' => md5('demopass1')]);
        Organizer::find(2)->update(['password_hash' => md5('demopass2')]);
    }

    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $organizer = Organizer::where('email', $request->get('email'))
            ->where('password_hash', md5($request->get('password')))->first();

        if ($organizer) {
            Auth::login($organizer);
            return redirect()->route('events.index')->with('success', 'Login Success');
        } else {
            return back()->withInput()->with('danger', 'Email or password not correct');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Success');
    }
}
