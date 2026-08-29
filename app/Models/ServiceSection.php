<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 'section_type', 'title', 'subtitle', 'content', 'image', 'sort_order', 'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
