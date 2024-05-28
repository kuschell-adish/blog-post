<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comments;
use App\Models\Blogs; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class CommentsController extends Controller
{

    public function index(Request $request)
    {
    $user = Auth::user();

    $blog_id = $request->blog_id;

    $blog = Blogs::findOrFail($blog_id);

    $comments = Comments::join('authors', 'comments.author_id', '=', 'authors.id')
    ->select('comments.id', 'comments.comment', 'comments.updated_at', 'comments.author_id', 'comments.blog_id', DB::raw('CONCAT(authors.first_name, " ", authors.last_name) AS author_name'))
    ->where('comments.blog_id', $blog_id)
    ->get();


    return view('comment', [
        'comments' => $comments,
        'user' => $user,
        'blog_id' => $blog_id, 
        'blog' => $blog
    ]);
    }
    
    public function create(Request $request) {
        $validated = $request->validate([
            "comment" => ['required'],
            "blog_id" => ['required', 'integer'],
            "author_id" => ['required', 'integer'],
        ]);

        $comment = new Comments;
        $comment->comment = $validated['comment'];
        $comment->blog_id = $validated['blog_id'];
        $comment->author_id = $validated['author_id'];
        $comment->save();

        return redirect('/view/blogs')->with('message', 'Comment has been added successfully!'); 
    
    }

    public function show ($id) {

        $data = Comments::findOrFail($id); 
        // dd($data);
        return view('edit-comment', ['comment' => $data]); 
    }

    public function update (Request $request, Comments $comment) {
        $validated = $request->validate([
            "comment" => ['required'], 
        ]);
    
        $author_id = Auth::id();
        $validated['author_id'] = $author_id;

    $comment->update($validated); 

    return redirect('/view/blogs')->with('message', 'Comment has been updated successfully!'); 

    }

    public function destroy (Comments $comment) {
        $comment->delete();
        return redirect('/view/blogs')->with('message', 'Comment has been deleted successfully!'); 
    }
}
