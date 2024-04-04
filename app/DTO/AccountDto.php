<?php

namespace App\DTO;

use Illuminate\Http\Request;


class AccountDto
{

    public function __construct(
        public readonly int $user_id,
        public readonly ?float $amount = 0,
        public readonly ?string $currency = null,
        public readonly ?int $status = null
    ) {
    }
    
    public static function fromRequest(Request $request): AccountDto
    {
        return new self(
            $request->input('user_id'),
            $request->input('amount'),
            $request->input('currency'),
            $request->input('status'),
        );
    }

    public function toArray()
    {
        return [
            "user_id" => $this->user_id,
            "amount" => $this->amount,
            "currency" => $this->currency,
            "status" => $this->status
        ];
    }
}
