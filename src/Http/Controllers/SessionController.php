<?php

namespace Hlacos\LaraMvcms\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;

class SessionController extends LaraMvcmsController
{
    public function __construct()
    {
        $this->middleware('lara-mvcms.admin', ['only' => 'destroy']);
        $this->middleware('lara-mvcms.guest', ['only' => 'create', 'store']);
    }

    public function create(Request $request)
    {
        return view('lara-mvcms::sessions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $userData = array(
            'email'  => $request->input('email'),
            'password'  => $request->input('password'),
            'is_active' => 1
        );

        if (Auth::admin()->attempt($userData, Input::get('remember_me'))) {
            return redirect()->route('lara-mvcms.dashboard');
        }

        $errors = new MessageBag([
            'email' => [trans('lara-mvcms::sessions.login-error')],
            'password' => [trans('lara-mvcms::sessions.login-error')]
        ]);
        return redirect()->back()->withErrors($errors)->withInput($request->except('password'));
    }

    public function destroy(Request $request)
    {
        Auth::admin()->logout();
        return redirect()->route('lara-mvcms.sessions.create');
    }
}
