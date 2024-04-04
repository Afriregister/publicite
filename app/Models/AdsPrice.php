<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'ads_type_id',
        'ads_format_id',
        'program_id',
        'package_id',
        'period_id',
        'price',
    ];
}
