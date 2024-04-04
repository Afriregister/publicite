<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'tin',
        'country',
        'city',
        'address',
        'phonenumber',
        'email',
        'website'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
