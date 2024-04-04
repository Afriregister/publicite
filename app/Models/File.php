<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'fileable_id',
        'fileable_type',
        'main'
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo();
    }
}
