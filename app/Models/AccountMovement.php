<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountMovement extends Model
{
    use HasFactory;

    protected $fillable = [

        "account_id",
        "action",
        "amount",
        "description",
        "before",
        "after",
        "currency",
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
