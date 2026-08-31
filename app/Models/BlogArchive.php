<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
