<?php

namespace App\Http\Controllers\Admin;

use App\DTO\AccountMovementDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountMovementStoreRequest;
use App\Http\Requests\Admin\AccountMovementUpdateRequest;
use App\Services\AccountMovementService;
use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountMovementController extends Controller
{
    protected $accountMovementService;

    protected $accountService;

    public function __construct(AccountMovementService $accountMov, AccountService $account)
    {
        $this->accountMovementService = $accountMov;

        $this->accountService = $account;
    }

    public function index($account_id = '')
    {
        $account = $this->accountService->findById($account_id);

        $accountMovements = $this->accountMovementService->all($account_id);

        return view('admin.accountmovements.index', compact('accountMovements', 'account'));
    }

    public function create($account_id)
    {
        $account = $this->accountService->findById($account_id);

        return view('admin.accountmovements.create', compact('account'));
    }

    public function store(AccountMovementStoreRequest $request)
    {

        $accountMovement = $this->accountMovementService->create(AccountMovementDto::fromRequest($request));

        if ($request->action == 'Credit account') {

            $info = __('Account') . ' ' . __('credited');
        } else {
            $info = __('Account') . ' ' . __('debited');
        }

        return redirect()->route('admin.accountmovements.index', $request->account_id)->with('info', $info);
    }

    public function show($id)
    {
        $accountMovement = $this->accountMovementService->findById($id);

        return view('admin.accountmovements.view', compact('accountmovement'));
    }

    public function edit($id)
    {
        $accountMovement = $this->accountMovementService->findById($id);

        return view('admin.accountmovement.edit', compact('accountmovement'));
    }

    public function update(AccountMovementUpdateRequest $request, $id)
    {
        $accountMovement = $this->accountMovementService->findById($id);

        $this->accountMovementService->update($accountMovement, AccountMovementDto::fromRequest($request));

        $info = __('Movement') . ' ' . __('updated');

        return redirect()->route('admin.accountmovement.index', $accountMovement->account_id)->with('info', $info);
    }

    public function destroy($id)
    {
        $this->accountMovementService->delete($id);

        $info = __('Movement') . ' ' . __('deleted');

        return back()->with('info', $info);
    }
}
