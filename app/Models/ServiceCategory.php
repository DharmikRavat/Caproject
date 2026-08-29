<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 'name', 'slug', 'short_description', 'description', 
        'image', 'header_image', 'icon', 'meta_title', 'meta_description', 'meta_keywords', 
        'sort_order', 'status'
    ];

    public function parent()
    {
        return $this->belongsTo(ServiceCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ServiceCategory::class, 'parent_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
