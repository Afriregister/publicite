<?php

namespace App\Services;

use App\DTO\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function all()
    {
        return User::all()->sortByDesc('id');
    }

    public function findById(Int $id): User
    {
        return User::findOrfail($id);
    }

    public function create(UserDto $dto): User
    {
        return User::create([
            "firstname" => $dto->firstname,
            "lastname" => $dto->lastname,
            "role" => $dto->role,
            "parent_id" => $dto->parent_id,
            "email" => $dto->email,
            "password" => Hash::make($dto->password),
            "country" => $dto->country,
            "city" => $dto->city,
            "address" => $dto->address,
            "phonenumber" => $dto->phonenumber,
            "status" => $dto->status
        ]);
    }

    public function update(User $user, UserDto $dto)
    {
        return $user->update([
            "firstname" => $dto->firstname,
            "lastname" => $dto->lastname,
            "role" => $dto->role,
            "parent_id" => $dto->parent_id,
            "email" => $dto->email,
            "country" => $dto->country,
            "city" => $dto->city,
            "address" => $dto->address,
            "phonenumber" => $dto->phonenumber,
            "status" => $dto->status
        ]);
    }

    public function updatePassword(User $user, UserDto $dto)
    {
        return $user->update([
            'password' => Hash::make($dto->password)
        ]);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
}
