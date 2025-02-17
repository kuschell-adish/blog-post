<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function register () {
        $response = Http::get('https://psgc.gitlab.io/api/provinces/');

        if ($response->successful()){
            $provinces = collect($response->json())->sortBy('name');
        }
        else {
            $provinces = [];
        }
        return view('register', compact('provinces')); 

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
            "birthday" =>['required'], 
            "gender" => ['required'], 
            "address" => ['required'], 
            "photo" => 'image|mimes:jpeg,png,bmp,tiff|max:2048', 
        ]); 

        $validated['password'] = Hash::make($validated['password']);
    
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
        else {
            $user->photo = 'photo/default.jpg';
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
            return redirect('/view/blogs')->with('message', "Welcome back, $username!"); 
        }

        return back()->withErrors(['email' => 'The email and password do not match.'])->onlyInput('email'); 
    }

    public function reset () {
        return view('reset'); 
    }

    public function change (Request $request) {
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

        return redirect('/login');  
    }

    public function logout (Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');  
    }

    public function view () {
        $user = Auth::user();

        $response = Http::get('https://psgc.gitlab.io/api/provinces/');

        if ($response->successful()){
            $provinces = collect($response->json())->sortBy('name');
        }
        else {
            $provinces = [];
        }

        return view('profile', ['user' => $user, 'provinces' => $provinces]); 
    }

    public function update (Request $request, User $author, $id) {
        $author = User::findOrFail($id);

        $validated = $request->validate([
           "first_name" => ['required', 'min:4'], 
            "last_name" => ['required', 'min:4'],
            "username" => ['required'],
            "email" => ['required', 'email'],
            "birthday" =>['required'], 
            "gender" => ['required'], 
            "address" => ['required'], 
        ]);

        if ($request->hasFile('photo')) {
            $request->validate([
                "photo" => 'mimes:jpeg,png,bmp,tiff|max:2048'
            ]); 
            $uploadedFile = $request->file('photo');
            $imagePath = $uploadedFile->store('photo', 'public'); 
            $author->photo = $imagePath;
        }

        $author->update($validated); 
        return redirect('/view/blogs')->with('message', 'Details has been updated successfully!'); 

    }


}
