<?php

namespace App\Http\Controllers\Admin;

use App\DTO\AccountDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountStoreRequest;
use App\Http\Requests\Admin\AccountUpdateRequest;
use App\Services\AccountService;
use App\Services\UserService;

class AccountController extends Controller
{
    protected $accountService;

    protected $userService;

    public function __construct(AccountService $account, UserService $user)
    {
        $this->accountService = $account;

        $this->userService = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = $this->accountService->all();

        return view('admin.accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->userService->all();

        return view('admin.accounts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountStoreRequest $request)
    {
        $account = $this->accountService->create(AccountDto::fromRequest($request));

        $info = __('Account') . ' ' . __('created');

        return redirect()->route('admin.accounts.index')->with('info', $info);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $account = $this->accountService->findById($id);

        $users = $this->userService->all();

        return view('admin.accounts.edit', compact('users', 'account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $account = $this->accountService->findById($id);

        $users = $this->userService->all();

        return view('admin.accounts.edit', compact('users', 'account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountUpdateRequest $request, $id)
    {
        $account = $this->accountService->findById($id);

        $this->accountService->update($account, AccountDto::fromRequest($request));

        $info = __('Account') . ' ' . __('updated');

        return redirect()->route('admin.accounts.index')->with('info', $info);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->accountService->delete($id);

        $info = __('Account') . ' ' . __('deleted');

        return back()->with('info', $info);
    }
}
