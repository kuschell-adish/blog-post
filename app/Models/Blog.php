<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Blog extends Model
{
    protected $guarded = []; 

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    
    use HasFactory;
}
