<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BlogRequest; 
use App\Services\ImageUploadService;



class BlogController extends Controller
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

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

    public function store (BlogRequest $request) {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $blog = new Blog();
        $blog->fill($validated);

        if ($request->hasFile('cover_photo')) {
            $coverPhotoUrl = $this->imageService->upload(
                $request->file('cover_photo'),
                'cover_photos/',
                'cover_'
            );
            $blog->cover_photo = $coverPhotoUrl;
        }
        $blog->save();
        return redirect()->route('blogs.filtered')->with('message', 'Blog has been added successfully!'); 
    }

    public function show (Blog $blog) {
        return view('blogs.edit', ['blog' => $blog]); 
    }

    public function update (BlogRequest $request, Blog $blog) {
        $this->authorize('update', $blog);

        $oldCoverPhoto = $blog->cover_photo;

        $validated = $request->validated();
        $blog->fill($validated);

        if ($request->hasFile('cover_photo')) {
            $coverPhotoUrl = $this->imageService->upload(
                $request->file('cover_photo'),
                'cover_photos/',
                'cover_'
            );

            $blog->cover_photo = $coverPhotoUrl;

            if ($oldCoverPhoto) {
                $this->imageService->delete($oldCoverPhoto); 
            }
        }
        $blog->save();  
        return redirect()->route('blogs.filtered')->with('message', 'Blog has been updated successfully!'); 
    }

    public function destroy (Blog $blog) {
        $this->authorize('delete', $blog);

        if ($blog->cover_photo) {
            $this->imageService->delete($blog->cover_photo);
        }
    
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
