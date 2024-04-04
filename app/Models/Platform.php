<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function formats()
    {
        return $this->belongsToMany(AdsFormat::class, 'format_platforms');
    }

    public function cycles()
    {
        return $this->belongsToMany(AdsCycle::class, 'cycle_platforms');
    }
}
