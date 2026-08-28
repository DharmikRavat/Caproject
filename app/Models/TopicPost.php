<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'title',
        'slug',
        'image',
        'excerpt',
        'content',
        'is_published',
        'published_date',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_date' => 'date',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
