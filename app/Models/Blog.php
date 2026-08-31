<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $slug
 */
class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'original_url',
        'excerpt',
        'content',
        'image',
        'author',
        'blog_category_id',
        'blog_archive_id',
        'is_published',
        'published_date',
        'sort_order',
        'is_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function archive()
    {
        return $this->belongsTo(BlogArchive::class, 'blog_archive_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class);
    }
}
