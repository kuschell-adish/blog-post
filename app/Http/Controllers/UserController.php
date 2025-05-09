<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth')->only('update');
    }
    
    public function index () {
        $user = Auth::user();

        return view('users.index', ['user' => $user]);
    }

    public function create () {
        return view('users.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "first_name" => ['required', 'min:2', 'max:50'], 
            "last_name" => ['required', 'min:2', 'max:50'],
            "email" => ['required', 'email', 'unique:users,email'], 
            "password" => ['required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            "photo" => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'] 
        ]); 

        $validated["password"] = Hash::make($validated["password"]);
    
        $user = new User();
        $user->fill($validated);
    
        if ($request->hasFile('photo')) {
            $uploadedFile = $request->file('photo');
            $folder = 'profile_photos/';
            $filename = uniqid('profile_', true) . '.' . $uploadedFile->getClientOriginalExtension();
            $filePath = $folder . $filename;
        
            Storage::disk('supabase')->put($filePath, file_get_contents($uploadedFile));
        
            $publicUrl = 'https://lpzsbfemzduzdbibazdb.supabase.co/storage/v1/object/public/photos/' . $filePath;
    
            $user->photo = $publicUrl;
        }

        $user->save();
    
        return redirect()->route('sessions.index');
    }

    public function update (Request $request, User $user) {
        $validated = $request->validate([
            "first_name" => ['required', 'min:2', 'max:50'], 
            "last_name" => ['required', 'min:2', 'max:50'],
            "email" => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)], 
            "photo" => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'] 
        ]);

        $user->fill($validated);

        if ($request->hasFile('photo')) {
            $uploadedFile = $request->file('photo');
            $folder = 'profile_photos/';
            $filename = uniqid('profile_', true) . '.' . $uploadedFile->getClientOriginalExtension();
            $filePath = $folder . $filename;
        
            Storage::disk('supabase')->put($filePath, file_get_contents($uploadedFile));
        
            $publicUrl = 'https://lpzsbfemzduzdbibazdb.supabase.co/storage/v1/object/public/photos/' . $filePath;
    
            $user->photo = $publicUrl;
        }
        
        $user->save(); 
        return redirect()->route('users.index')->with('message', 'Profile has been updated successfully!');
    }


}
