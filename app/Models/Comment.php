<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'blog_id', 'author_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    use HasFactory;
}
