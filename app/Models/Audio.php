<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audio extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'audioable_id',
        'audioable_type',
        'main'
    ];

    public function audioable(): MorphTo
    {
        return $this->morphTo();
    }
}
