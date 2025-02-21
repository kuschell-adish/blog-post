<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function index () {
        return view ('reset.index'); 
    }

    public function sendEmailReset (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
        ? view('reset.email-sent')->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
    }

    public function password ($token) {
        return view ('reset.change-password', ['token' => $token]); 
    }

    public function change (Request $request) {
        $request->validate([
            "token" => 'required',
            "email" => ['required', 'email'],
            "password" => ['required', 'confirmed', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
        ? redirect()->route('sessions.index')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
    }
}
