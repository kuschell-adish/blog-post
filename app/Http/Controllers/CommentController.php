<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Blog; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class CommentController extends Controller
{

    public function index(Request $request)
    {
    $user = Auth::user();

    $blog_id = $request->blog_id;

    $blog = Blog::findOrFail($blog_id);

    $comments = Comment::join('authors', 'comments.author_id', '=', 'authors.id')
    ->select('comments.id', 'comments.comment', 'comments.updated_at', 'comments.author_id', 'comments.blog_id', DB::raw('CONCAT(authors.first_name, " ", authors.last_name) AS author_name'))
    ->where('comments.blog_id', $blog_id)
    ->get();


    return view('comments.index', [
        'comments' => $comments,
        'user' => $user,
        'blog_id' => $blog_id, 
        'blog' => $blog
    ]);
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            "comment" => ['required'],
            "blog_id" => ['required', 'integer'],
            "author_id" => ['required', 'integer'],
        ]);

        $comment = new Comment;
        $comment->comment = $validated['comment'];
        $comment->blog_id = $validated['blog_id'];
        $comment->author_id = $validated['author_id'];
        $comment->save();

        return redirect()->route('comments.index', ['blog_id' => $comment->blog_id])->with('message', 'Comment has been created successfully!'); 
    }

    public function show ($id) {

        $data = Comment::findOrFail($id); 
        return view('comments.edit', ['comment' => $data]); 
    }

    public function update (Request $request, Comment $comment) {
        $validated = $request->validate([
            "comment" => ['required'], 
        ]);
    
        $author_id = Auth::id();
        $validated['author_id'] = $author_id;

    $comment->update($validated); 

    return redirect()->route('comments.index', ['blog_id' => $comment->blog_id])->with('message', 'Comment has been updated successfully!'); 

    }

    public function destroy (Comment $comment) {
        $comment->delete();
        return redirect()->route('comments.index', ['blog_id' => $comment->blog_id])->with('message', 'Comment has been deleted successfully!'); 
    }
}
