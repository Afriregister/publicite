<?php

namespace App\DTO;

use Illuminate\Http\Request;

class AccountMovementDto
{

    public function __construct(
        public readonly int $account_id,
        public readonly ?string $action = null,
        public readonly ?float $amount = 0,
        public readonly ?string $description = null,
        public readonly ?float $before = 0,
        public readonly ?float $after = 0,
        public readonly ?string $currency = 'BIF',
    ) {
    }

    public static function fromRequest(Request $request): AccountMovementDto
    {
        return new self(
            $request->input('account_id'),
            $request->input('action'),
            $request->input('amount'),
            $request->input('description'),
            $request->input('before'),
            $request->input('after'),
            $request->input('currency'),
        );
    }

    public function toArray()
    {
        return [
            "account_id" => $this->account_id,
            "action" => $this->action,
            "amount" => $this->amount,
            "description" => $this->description,
            "before" => $this->before,
            "after" => $this->after,
            "currency" => $this->currency,
        ];
    }
}
