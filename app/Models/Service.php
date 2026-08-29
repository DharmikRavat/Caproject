<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $slug
 */
class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'parent_service_id',
        'name',
        'slug',
        'short_description',
        'description',
        'featured_image',
        'banner_image',
        'header_image',
        'icon',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(Service::class, 'parent_service_id');
    }

    public function children()
    {
        return $this->hasMany(Service::class, 'parent_service_id');
    }

    public function sections()
    {
        return $this->hasMany(ServiceSection::class)->orderBy('sort_order');
    }

    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class)->orderBy('sort_order');
    }

    public function documents()
    {
        return $this->hasMany(ServiceDocument::class)->orderBy('sort_order');
    }

    public function processSteps()
    {
        return $this->hasMany(ServiceProcessStep::class)->orderBy('sort_order');
    }
}
