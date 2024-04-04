<?php

namespace App\Http\Controllers\Admin;

use App\DTO\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $user)
    {
        $this->userService = $user;
    }

    public function index()
    {
        $users = $this->userService->all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $users = $this->userService->all();

        return view('admin.users.create', compact('users'));
    }

    public function store(UserStoreRequest $request)
    {
        $this->userService->create(UserDto::fromRequest($request));

        $info = __('User') . ' ' . __('added');

        return redirect()->route('admin.users.index')->with('info', $info);
    }

    public function show($id)
    {
        $user = $this->userService->findById($id);

        $users = $this->userService->all();

        return view('admin.users.edit', compact('user', 'users'));
    }

    public function edit($id)
    {
        $user = $this->userService->findById($id);

        $users = $this->userService->all();

        return view('admin.users.edit', compact('user', 'users'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userService->findById($id);

        $this->userService->update($user, UserDto::fromRequest($request));

        $info = __('User') . ' ' . __('updated');

        return redirect()->route('admin.users.edit')->with('info', $info);
    }

    public function updatePasswordForm($id)
    {
        $user = $this->userService->findById($id);

        return view('admin.users.updatepassword', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = $this->userService->findById($id);

        $request->validate([
            "password" => 'required|string|max:255'
        ]);

        $this->userService->updatePassword($user, UserDto::fromRequest($request));

        $info = __('Password') . ' ' . __('updated');

        return redirect()->route('admin.users.index')->with('info', $info);
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        $info = __('User') . ' ' . __('deleted');

        return redirect()->route('admin.users.index')->with('info', $info);
    }
}
