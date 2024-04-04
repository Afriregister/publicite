<?php

namespace App\Http\Controllers\Admin;

use App\DTO\AdminDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $admin)
    {
        $this->adminService = $admin;
    }

    public function index()
    {
        $admins = $this->adminService->all();

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(AdminStoreRequest $request)
    {
        $admin = $this->adminService->create(AdminDto::fromRequest($request));

        $info = __('Admin') . ' ' . __('added');

        return redirect()->route('admin.admins.index')->with('info', $info);
    }

    public function edit($id)
    {
        $admin = $this->adminService->findById($id);

        return view('admin.admins.edit', compact('admin'));
    }

    public function show($id)
    {
        $admin = $this->adminService->findById($id);

        return view('admin.admins.edit', compact('admin'));
    }

    public function update(AdminUpdateRequest $request, $id)
    {
        $admin = $this->adminService->findById($id);

        $this->adminService->update($admin, AdminDto::fromRequest($request));

        $info = __('Admin') . ' ' . __('updated');

        return redirect()->route('admin.admins.index')->with('info', $info);
    }

    public function updatePasswordForm($id)
    {
        $admin = $this->adminService->findById($id);

        return view('admin.admins.updatepassword', compact('admin'));
    }

    public function updatePassword(Request $request, $id)
    {
        $admin = $this->adminService->findById($id);

        $request->validate([
            'password' => 'required|string|max:255',
        ]);

        $this->adminService->updatePassword($admin, AdminDto::fromRequest($request));

        return redirect()->route('admin.admins.index')->with('info', __('Password') . ' ' . __('updated'));
    }

    public function destroy($id)
    {
        $this->adminService->delete($id);

        $info = __('Admin') . ' ' . __('deleted');

        return back()->with('info', $info);
    }
}
