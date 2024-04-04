<?php

namespace App\Services;

use App\DTO\AccountDto;
use App\Models\Account;
use App\Services\AccountMovementService;

class AccountService
{
    protected $accountMovementService;

    public function __construct(AccountMovementService $accountMovement)
    {
        $this->accountMovementService = $accountMovement;
    }

    public function all()
    {
        return Account::all()->sortByDesc('id');
    }

    public function findById(Int $id): Account
    {
        return Account::findOrfail($id);
    }

    public function create(AccountDto $dto): Account
    {
        $account = Account::where('user_id', $dto->user_id)->where('currency', $dto->currency)->first();

        if ($account == null) {
            return Account::create([
                "user_id" => $dto->user_id,
                "amount" => '0',
                "currency" => $dto->currency,
                "status" => $dto->status
            ]);
        } else {
            return $account;
        }
    }

    public function update(Account $account, AccountDto $dto)
    {
        return $account->update([
            "user_id" => $dto->user_id,
            "currency" => $dto->currency,
            "status" => $dto->status
        ]);
    }

    public function delete($id)
    {
        $this->accountMovementService->deleteAllAccountMovements($id);

        return Account::destroy($id);
    }
}
