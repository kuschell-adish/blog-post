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

        $comments = Comment::with('user')
                ->where('blog_id', $blog_id)
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
            "comment" => ['required', 'string', 'min:3', 'max:150'], 
            "blog_id" => ['required', 'integer', 'exists:blogs,id'], 
        ]);

        $comment = new Comment;
        $comment->fill($validated);
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('comments.index', ['blog_id' => $comment->blog_id])->with('message', 'Comment has been created successfully!'); 
    }

    public function show ($id) {

        $comment = Comment::findOrFail($id); 
        return view('comments.edit', ['comment' => $comment]); 
    }

    public function update (Request $request, Comment $comment) {
        $validated = $request->validate([
            "comment" => ['required', 'string', 'min:3', 'max:150'], 
        ]);
    
        $comment->user_id = auth()->id();
        $comment->update($validated); 
        
        return redirect()->route('comments.index', ['blog_id' => $comment->blog_id])->with('message', 'Comment has been updated successfully!'); 

    }

    public function destroy (Comment $comment) {
        $comment->delete();
        return redirect()->route('comments.index', ['blog_id' => $comment->blog_id])->with('message', 'Comment has been deleted successfully!'); 
    }
}
