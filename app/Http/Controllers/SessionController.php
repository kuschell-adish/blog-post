<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public function index () {
        return view('sessions.index');
    }

    public function store (Request $request) {
        $validated = $request->validate([
            "email" => ['required', 'email'], 
            "password" => 'required'
        ]); 

        if (auth()->attempt($validated)){
            $request->session()->regenerate();
            $username = auth()->user()->username;
            return redirect()->route('blogs.index')->with('message', "Welcome back, $username!");
        }

        return back()->withErrors(['email' => 'The email and password do not match.'])->onlyInput('email'); 
    }

    #to add smtp
    public function edit () {
        return view('users.edit');
    }

    #temporary reset password
    public function update (Request $request) {
        $validated = $request->validate([
            "email" => ['required', 'email'], 
            "password" => [
                'required',
                'string',
                'min:8',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',     
                'regex:/[@$!%*#?&]/', 
            ],
        ]); 

        $user = User::where('email', $validated['email'])->firstOrFail();
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('sessions.index');
    }

    public function logout (Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('sessions.index');
    }

}
