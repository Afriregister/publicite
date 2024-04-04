<?php

namespace App\Services;

use App\DTO\AccountMovementDto;
use App\Models\AccountMovement;
use App\Models\Account;

class AccountMovementService
{

    public function all($account_id = null)
    {
        if ($account_id != null) {
            return AccountMovement::all()->where('account_id', $account_id)->sortByDesc('id');
        }
        return AccountMovement::all()->sortByDesc('id');
    }

    public function findById(Int $id): AccountMovement
    {
        return AccountMovement::findOrfail($id);
    }

    public function create(AccountMovementDto $dto): AccountMovement
    {

        $account = Account::findOrfail($dto->account_id);

        $before = ($account) ? $account->amount : 0;

        if ($dto->action == 'Credit account') {
            $after = $before + $dto->amount;
        } else {
            $after = $before - $dto->amount;
        }

        $accountMovement = AccountMovement::create([
            "account_id" => $dto->account_id,
            "action" => $dto->action,
            "amount" => $dto->amount,
            "description" => $dto->description,
            "before" => $before,
            "after" => $after,
            "currency" => $dto->currency
        ]);

        $account->update(['amount' => $after]);

        return $accountMovement;
    }

    public function update(AccountMovement $AccountMovement, AccountMovementDto $dto)
    {
        return $AccountMovement->update([
            "action" => $dto->action,
            "amount" => $dto->amount,
            "description" => $dto->description,
            "before" => $dto->before,
            "after" => $dto->after
        ]);
    }

    public function delete($id)
    {
        return AccountMovement::destroy($id);
    }

    public function deleteAllAccountMovements($account_id)
    {
        return AccountMovement::where('account_id', $account_id)->delete();
    }
}
