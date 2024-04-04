<?php

namespace App\Servicess;

use App\DTOs\AdminDTO;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function all()
    {
        return Admin::all()->sortByDesc('id');
    }

    public function findById(Int $id): Admin
    {
        return Admin::findOrfail($id);
    }

    public function create(AdminDTO $dto): Admin
    {
        return Admin::create([
            "firstname" => $dto->firstname,
            "lastname" => $dto->lastname,
            "email" => $dto->email,
            "password" => Hash::make($dto->password),
            "status" => $dto->status
        ]);
    }

    public function update(Admin $admin, AdminDTO $dto)
    {
        return $admin->update([
            "firstname" => $dto->firstname,
            "lastname" => $dto->lastname,
            "email" => $dto->email,
            "status" => $dto->status
        ]);
    }

    public function updatePassword(Admin $admin, AdminDTO $dto)
    {
        return $admin->update([
            'password' => Hash::make($dto->password)
        ]);
    }

    public function delete($id)
    {
        return Admin::destroy($id);
    }
}
