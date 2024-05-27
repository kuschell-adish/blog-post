<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function index () {
        return view ('comment'); 
    }
    
    
    public function create(Request $request) {
        $validated = $request->validate([
            "comment" => ['required'],
            "blog_id" => ['required', 'integer'],
            "author_id" => ['required', 'integer'],
        ]);

        // $comment = new Comments;
        // $comment->comment = $validated['comment'];
        // $comment->blog_id = $validated['blog_id'];
        // $comment->author_id = $validated['author_id'];
        // $comment->save();
    
    }
}
