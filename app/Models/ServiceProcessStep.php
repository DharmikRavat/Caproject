<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProcessStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 'title', 'description', 'icon', 'sort_order', 'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
