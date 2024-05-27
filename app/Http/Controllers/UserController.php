<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register () {
        return view('register'); 
    }

    public function store(Request $request, User $user) {
        $validated = $request->validate([
            "first_name" => ['required', 'min:4'], 
            "last_name" => ['required', 'min:4'],
            "username" => ['required', Rule::unique('authors', 'username')],
            "email" => ['required', 'email', Rule::unique('authors', 'email')], 
            'password' => [
                'required',
                'string',
                'min:8',             
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',     
                'regex:/[@$!%*#?&]/', 
            ],
            "birthday" =>['nullable'], 
            "gender" => ['nullable'], 
            "address" => ['nullable'], 
            "photo" => 'image|mimes:jpeg,png,bmp,tiff|max:2048', 
        ]); 

        if($request->hasFile('photo')) {
            $request->validate([
                "photo" => 'mimes:jpeg,png,bmp,tiff |max:4906'
            ]); 

            $imagePath = $request->file('photo')->store('photo', 'public');

            $user->photo = $imagePath;
        }
        
        // dd($validated); 

        $user = User::create($validated);

        return view('login'); 

    }

    public function login () {
        return view('login'); 
    }

    public function process (Request $request) {
        $validated = $request->validate([
            "email" => ['required', 'email'], 
            "password" => 'required'
        ]); 

        if (auth()->attempt($validated)){
            $request->session()->regenerate();

            $username = auth()->user()->username;
            echo "Hello $username";
        }
        
        return view('index'); 

        // return back()->withErrors(['email' => 'The email and password do not match.'])->onlyInput('email'); 
    }

    public function logout (Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');  
    }

    public function view () {
        return view('profile'); 
    }

}
