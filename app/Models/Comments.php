<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = ['comment', 'blog_id', 'author_id'];
    
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    use HasFactory;
}
