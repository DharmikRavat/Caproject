<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'description', 
        'image', 
        'meta_title', 
        'meta_description', 
        'meta_keywords', 
        'is_active', 
        'sort_order'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
}
