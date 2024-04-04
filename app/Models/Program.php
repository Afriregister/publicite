<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        "channel_id",
        "name",
        "description",
        "status"
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function days()
    {
        return $this->belongsToMany(DayProgram::class);
    }
}