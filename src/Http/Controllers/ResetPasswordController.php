<?php

namespace Hlacos\LaraMvcms\Http\Controllers;

use Hlacos\LaraMvcms\Http\Models\User;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Hlacos\LaraMvcms\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends LaraMvcmsController
{
    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('lara-mvcms.guest');
    }

    /*public function create()
    {
        return view('lara-mvcms::reset-password.create');
    }

    public function store()
    {
        $validator = Validator::make(Input::all(), [
            'email' => 'required|email'
        ]);

        $response = Password::sendResetLink(Input::only('email'), function (Message $message) {
            $message->subject(trans('lara-mvcms::reset-password.mail.subject'));
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));

            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('lara-mvcms.sessions.create');
    }*/
}
