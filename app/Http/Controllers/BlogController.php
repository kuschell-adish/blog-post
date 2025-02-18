<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class BlogController extends Controller
{
    public function index () {
        $user = Auth::user();
    
        $blogs = DB::table('blogs')
                ->join('authors', 'blogs.author_id', '=', 'authors.id')
                ->select('blogs.id', 'blogs.title', 'blogs.body', 'blogs.updated_at', 'blogs.author_id', DB::raw('CONCAT(authors.first_name, " ", authors.last_name) AS author_name'), 'authors.photo')
                ->get(); 
    
        return view('blogs.index', ['blogs' => $blogs, 'user' => $user]);
    }

    public function create () {
        $user = Auth::user();

        return view('blogs.create', ['user' => $user]);
    }

    public function store (Request $request) {
        $validated = $request->validate([
            "title" => ['required'], 
            "body" => ['required'], 
            "cover_photo" => 'image|mimes:jpeg,png,bmp,tiff|max:2048', 
        ]);
    
        $author_id = Auth::id();
        $validated['author_id'] = $author_id;

        $blog = new Blog();
        $blog->fill($validated);
    
        if ($request->hasFile('cover_photo')) {
            $request->validate([
                "cover_photo" => 'mimes:jpeg,png,bmp,tiff|max:2048'
            ]); 
            $uploadedFile = $request->file('cover_photo');
            $imagePath = $uploadedFile->store('photo', 'public'); 
            $blog->cover_photo = $imagePath;
        }
        else {
            $blog->cover_photo = 'photo/cover.jpg';
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
            "title" => ['required'], 
            "body" => ['required'], 
        ]);
    
        $author_id = Auth::id();
        $validated['author_id'] = $author_id;

        if ($request->hasFile('cover_photo')) {
            $request->validate([
                "cover_photo" => 'mimes:jpeg,png,bmp,tiff|max:2048'
            ]); 
            $uploadedFile = $request->file('cover_photo');
            $imagePath = $uploadedFile->store('photo', 'public'); 
            $blog->cover_photo = $imagePath;
        }

        $blog->update($validated); 
        return redirect()->route('blogs.filtered')->with('message', 'Blog has been updated successfully!'); 

    }

    public function destroy (Blog $blog) {
        $blog->delete();
        return redirect()->route('blogs.filtered')->with('message', 'Blog has been deleted successfully!'); 
    }

    public function filtered () {
        $user = Auth::user();

        $filter = DB::table('blogs')
                ->join('authors', 'blogs.author_id', '=', 'authors.id')
                ->where('blogs.author_id', $user->id)
                ->select('blogs.id', 'blogs.title', 'blogs.body', 'blogs.updated_at', 'blogs.author_id', DB::raw('CONCAT(authors.first_name, " ", authors.last_name) AS author_name'))
                ->simplePaginate(10);

        return view('blogs.filtered', ['blogs' => $filter, 'user' => $user]);
    
    }
}
