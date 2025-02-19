<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth')->only('update');
    }
    
    public function index () {
        $user = Auth::user();

        $response = Http::get('https://psgc.gitlab.io/api/provinces/');

        if ($response->successful()){
            $provinces = collect($response->json())->sortBy('name');
        }
        else {
            $provinces = [];
        }
        return view('users.index', ['user' => $user, 'provinces' => $provinces]);
    }

    public function create () {
        $response = Http::get('https://psgc.gitlab.io/api/provinces/');

        if ($response->successful()){
            $provinces = collect($response->json())->sortBy('name');
        }
        else {
            $provinces = [];
        }
        return view('users.create', ['provinces' => $provinces]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "first_name" => ['required', 'min:2', 'max:50'], 
            "last_name" => ['required', 'min:2', 'max:50'],
            "username" => ['required', 'min:3', 'max:30', 'regex:/^[a-zA-Z0-9_.]+$/', 'unique:authors,username'],
            "email" => ['required', 'email', 'unique:authors,email'], 
            "password" => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            "birthday" => ['required', 'date'], 
            "gender" => 'required',
            "address" => 'required',
            "photo" => ['nullable', 'image', 'mimes:jpeg,png,bmp,tiff', 'max:2048'] 
        ]); 

        $validated["password"] = Hash::make($validated["password"]);
    
        $user = new User();
        $user->fill($validated);
    
        if ($request->hasFile('photo')) {
            $uploadedFile = $request->file('photo');
            $imagePath = $uploadedFile->store('photo', 'public'); 
            $user->photo = $imagePath;
        }

        $user->save();
    
        return redirect()->route('sessions.index');
    }

    public function update (Request $request, User $author, $id) {
        $author = User::findOrFail($id);

        $validated = $request->validate([
            "first_name" => ['required', 'min:2', 'max:50'], 
            "last_name" => ['required', 'min:2', 'max:50'],
            "username" => ['required', 'min:3', 'max:30', 'regex:/^[a-zA-Z0-9_.]+$/', Rule::unique('authors', 'username')->ignore($author->id)],
            "email" => ['required', 'email', Rule::unique('authors', 'email')->ignore($author->id)], 
            "birthday" => ['required', 'date'], 
            "gender" => 'required',
            "address" => 'required',
            "photo" => ['nullable', 'image', 'mimes:jpeg,png,bmp,tiff', 'max:2048'] 
        ]);

        if ($request->hasFile('photo')) {
            $uploadedFile = $request->file('photo');
            $imagePath = $uploadedFile->store('photo', 'public'); 
            $author->photo = $imagePath;
        }

        $author->update($validated); 
        return redirect()->route('users.index')->with('message', 'Profile has been updated successfully!');
    }


}
