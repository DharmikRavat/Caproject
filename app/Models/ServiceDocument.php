<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 'title', 'description', 'file', 'sort_order', 'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
