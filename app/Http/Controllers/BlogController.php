<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index () {
        $user = Auth::user();

        $blogs = Blog::with(['user:id,first_name,last_name,photo'])
                ->latest()
                ->get();   
    
        return view('blogs.index', ['blogs' => $blogs, 'user' => $user]);
    }

    public function create () {
        $user = Auth::user();

        return view('blogs.create', ['user' => $user]);
    }

    public function store (Request $request) {
        $validated = $request->validate([
            "title" => ['required', 'string', 'min:10', 'max:70'], 
            "body" => ['required', 'string', 'min:10', 'max:1000'], 
            "cover_photo" => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048'] 
        ]);
    
        $user_id = Auth::id();
        $validated['user_id'] = $user_id;

        $blog = new Blog();
        $blog->fill($validated);

        if ($request->hasFile('cover_photo')) {
            $uploadedFile = $request->file('cover_photo');
            $folder = 'cover_photos/';
            $filename = uniqid('cover_', true) . '.' . $uploadedFile->getClientOriginalExtension();
            $filePath = $folder . $filename;
        
            Storage::disk('supabase')->put($filePath, file_get_contents($uploadedFile));
        
            $publicUrl = 'https://lpzsbfemzduzdbibazdb.supabase.co/storage/v1/object/public/photos/' . $filePath;
    
            $blog->cover_photo = $publicUrl;
        }
        
        $blog->save();
        return redirect()->route('blogs.filtered')->with('message', 'Blog has been added successfully!'); 
    }

    public function show ($id) {
        $data = Blog::findOrFail($id); 
        return view('blogs.edit', ['blog' => $data]); 
    }

    public function update (Request $request, Blog $blog) {
        $validated = $request->validate([
            "title" => ['required', 'string', 'min:10', 'max:70'], 
            "body" => ['required', 'string', 'min:10', 'max:1000'],
            "cover_photo" => ['nullable', 'image', 'mimes:jpeg,png', 'max:2048']  
        ]);
    
        $user_id = Auth::id();
        $validated['user_id'] = $user_id;

        $blog->fill($validated);

        if ($request->hasFile('cover_photo')) {
            $uploadedFile = $request->file('cover_photo');
            $folder = 'cover_photos/';
            $filename = uniqid('cover_', true) . '.' . $uploadedFile->getClientOriginalExtension();
            $filePath = $folder . $filename;
        
            Storage::disk('supabase')->put($filePath, file_get_contents($uploadedFile));
        
            $publicUrl = 'https://lpzsbfemzduzdbibazdb.supabase.co/storage/v1/object/public/photos/' . $filePath;
    
            $blog->cover_photo = $publicUrl;
        }
    
        $blog->save();  
        return redirect()->route('blogs.filtered')->with('message', 'Blog has been updated successfully!'); 

    }

    public function destroy (Blog $blog) {
        $blog->delete();
        return redirect()->route('blogs.filtered')->with('message', 'Blog has been deleted successfully!'); 
    }

    public function filtered () {
        $user = Auth::user();

        $blogs = Blog::with('user')
                ->where('user_id', $user->id)
                ->select('id', 'title', 'body', 'updated_at', 'user_id')
                ->paginate(10);

        return view('blogs.filtered', ['blogs' => $blogs, 'user' => $user]);
    
    }
}
