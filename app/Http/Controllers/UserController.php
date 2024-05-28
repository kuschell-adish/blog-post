<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register () {
        return view('register'); 
    }

    public function store(Request $request) {
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
    
        $user = new User();
        $user->fill($validated);
    
        if ($request->hasFile('photo')) {
            $request->validate([
                "photo" => 'mimes:jpeg,png,bmp,tiff|max:2048'
            ]); 
    
            $uploadedFile = $request->file('photo');
            $imagePath = $uploadedFile->store('photo', 'public'); 
    
            $user->photo = $imagePath;
        }
    
        $user->save();
    
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
        }
        
        return redirect('/view/blogs')->with('message', "Welcome back, $username!"); 

        // return back()->withErrors(['email' => 'The email and password do not match.'])->onlyInput('email'); 
    }

    public function logout (Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');  
    }

    public function view () {
        $user = Auth::user();

        return view('profile', ['user' => $user]); 
    }

}
