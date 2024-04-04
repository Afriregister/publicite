<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'short_name',
        'country',
        'city',
        'address',
        'phonenumber',
        'email',
        'website',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
