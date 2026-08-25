<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $slug
 */
class Career extends Model
{
    use HasFactory;

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'location',
        'type',
        'experience',
        'is_active',
    ];
}
