<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Comments; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class BlogController extends Controller
{
    public function index () {
        return view ('index'); 
    }

    public function create (Request $request) {
        $validated = $request->validate([
            "title" => ['required'], 
            "body" => ['required'], 
        ]);
    
        $author_id = Auth::id();
        $validated['author_id'] = $author_id;

        // $blog = new Blogs;
        // $blog->title = $validated['title'];
        // $blog->body = $validated['body'];
        // $blog->author_id = Auth::id();
        // $blog->save();
    

        // dd($validated);
        

        Blogs::create($validated);
        return redirect('/view/blogs')->with('message', 'Blog has been added successfully!'); 
    }

    public function view() {
        $user = Auth::user();
    
        $blogs = DB::table('blogs')
                ->join('authors', 'blogs.author_id', '=', 'authors.id')
                ->select('blogs.id', 'blogs.title', 'blogs.body', 'blogs.updated_at', 'blogs.author_id', DB::raw('CONCAT(authors.first_name, " ", authors.last_name) AS author_name'))
                ->get(); 
    
        return view('blogs', ['blogs' => $blogs, 'user' => $user]);
    }

    public function show ($id) {

        $data = Blogs::findOrFail($id); 
        // dd($data);
        return view('edit-blog', ['blog' => $data]); 
    }

    public function destroy (Blogs $blog) {
        $blog->delete();
        return redirect('/view/blogs')->with('message', 'Blog has been deleted successfully!'); 
    }

    public function update (Request $request, Blogs $blog) {
        $validated = $request->validate([
            "title" => ['required'], 
            "body" => ['required'], 
        ]);
    
        $author_id = Auth::id();
        $validated['author_id'] = $author_id;

    $blog->update($validated); 
    
    // dd(session('message'));

    return redirect('/view/blogs')->with('message', 'Blog has been updated successfully!'); 

    }

    public function filter () {
        $user = Auth::user();


        $filter = DB::table('blogs')
                ->join('authors', 'blogs.author_id', '=', 'authors.id')
                ->where('blogs.author_id', $user->id)
                ->select('blogs.id', 'blogs.title', 'blogs.body', 'blogs.updated_at', 'blogs.author_id', DB::raw('CONCAT(authors.first_name, " ", authors.last_name) AS author_name'))
                ->simplePaginate(10);

    return view('filtered-blogs', ['blogs' => $filter, 'user' => $user]);
    
    }
}
