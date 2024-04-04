<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'videoable_id',
        'videoable_type',
        'main'
    ];

    public function videoable(): MorphTo
    {
        return $this->morphTo();
    }
}
