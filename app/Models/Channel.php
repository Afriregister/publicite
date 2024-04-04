<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "media_id",
        "platform_id",
        "name",
        "status"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function prices()
    {
        return $this->hasMany(AdsPrice::class);
    }

}
