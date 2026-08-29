<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'author_role',
        'author_image',
        'rating',
        'content',
        'source',
        'review_date',
        'is_verified',
        'sort_order',
        'is_active',
    ];
}
