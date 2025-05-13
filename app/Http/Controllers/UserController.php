<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest; 
use App\Services\ImageUploadService;


class UserController extends Controller
{   
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->middleware('auth')->only('update');
        $this->imageService = $imageService;
    }
    
    public function index () {
        $user = Auth::user();

        return view('users.index', ['user' => $user]);
    }

    public function create () {
        return view('users.create');
    }

    public function store(UserRequest $request) {
        $validated = $request->validated();
        $validated["password"] = Hash::make($validated["password"]);
        $user = new User();
        $user->fill($validated);
    
        if ($request->hasFile('photo')) {
            $profilePhotoUrl = $this->imageService->upload(
                $request->file('photo'),
                'profile_photos/',
                'profile_'
            );
            $user->photo = $profilePhotoUrl;
        }

        $user->save();
        return redirect()->route('sessions.index')->with('message', 'User has been created successfully. Please log in.');;
    }

    public function update (UserRequest $request, User $user) {
        $this->authorize('update', $user);

        $oldProfilePicture = $user->photo;

        $validated = $request->validated();
        $user->fill($validated);

        $passwordChanged = false;

        if ($request->filled('password')) {
            $user->password = Hash::make($validated["password"]);
            $passwordChanged = true; 
        }

        if ($request->hasFile('photo')) {

            $profilePhotoUrl = $this->imageService->upload(
                $request->file('photo'),
                'profile_photos/',
                'profile_'
            );
            $user->photo = $profilePhotoUrl;

            if ($user->photo) {
                $this->imageService->delete($oldProfilePicture);
            }
        }

        $user->save(); 

        if ($passwordChanged && Auth::id() === $user->id) {
            auth()->logout();
            return redirect()->route('sessions.index')->with('message', 'Password has been changed. Please log in again.');
        }
        return redirect()->route('users.index')->with('message', 'Profile has been updated successfully!');
    }


}
