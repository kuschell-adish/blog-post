<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Blog; 
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest; 

class CommentController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'blog_id' => 'required|integer|exists:blogs,id',
        ]);

        $blog_id = $request->blog_id;
        $blog = Blog::findOrFail($blog_id);

        $comments = Comment::with('user')
                ->where('blog_id', $blog_id)
                ->paginate(10);

        return view('comments.index', [
            'comments' => $comments,
            'user' => $user,
            'blog' => $blog
        ]);
    }
    
    public function store(CommentRequest $request) {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $comment = new Comment;
        $comment->fill($validated);
        $comment->save();

        return redirect()->route('comments.index', ['blog_id' => $comment->blog_id])->with('message', 'Comment has been created successfully!'); 
    }

    public function show (Comment $comment) {
        return view('comments.edit', ['comment' => $comment]); 
    }

    public function update (CommentRequest $request, Comment $comment) {
        $this->authorize('update', $comment);

        $validated = $request->validated();
        $comment->update($validated); 
        
        return redirect()->route('comments.index', ['blog_id' => $comment->blog_id])->with('message', 'Comment has been updated successfully!'); 

    }

    public function destroy (Comment $comment) {
        $this->authorize('delete', $comment);

        $comment->delete();
        return redirect()->route('comments.index', ['blog_id' => $comment->blog_id])->with('message', 'Comment has been deleted successfully!'); 
    }
}
