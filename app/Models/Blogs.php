<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Blogs extends Model
{
    protected $guarded = []; 

    public function author()
    {
        return $this->belongsTo(User::class);
    }
    
    use HasFactory;
}
